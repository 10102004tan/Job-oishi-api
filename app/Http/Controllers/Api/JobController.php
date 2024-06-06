<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Job;
use App\Models\JobBookmark;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
class JobController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->query('type',0);
        $city = $request->query('city');
        $page_size = 6;
        $page = $request->query('page', 1);

        if ($type == 0) {
            $response = Http::get("https://api.topdev.vn/td/v2/jobs?ordering=newest_job&page_size=$page_size&page=$page&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");
            $data = json_decode($response->getBody()->getContents(), true);
            $lastPage = $data['meta']['last_page'];
            $jobs = collect($data['data']);

            // Xử lý lọc công việc theo tiêu chí của người dùng
            $user = User::find($request->user_id);
            if ($user) {
                $job_criteria = $user->jobCriteria;
                if ($job_criteria['job_salary'] != null) {
                    $jobsArray = $jobs->map(function ($job) use ($job_criteria) {
                        $job['similarity'] = $this->calculateSimilarity($job, $job_criteria);
                        return $job;
                    })->sortByDesc('similarity')->values()->toArray();

                    usort($jobsArray, function ($a, $b) {
                        return $b['similarity'] - $a['similarity'];
                    });

                    $filteredData = collect($jobsArray)->map(function ($job) {
                        return [
                            'id' => $job['id'],
                            'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                            'company_id' => $job['company']['id'],
                            'company_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                            'company_logo' => $job['company']['image_logo'],
                            'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
                            'salary_min' => $job['salary']['min'],
                            'salary_max' => $job['salary']['max'],
                            'is_salary_visible' => $job['is_salary_visible'],
                            'published' => $job['published']['since'],
                            'provicene' => $job['addresses']['address_region_list']
                        ];
                    });
                    $mergedData = collect($jobs)->merge($filteredData)->toArray();
                    return [
                        'data' => $mergedData,
                        'last_page' => $lastPage
                    ];
                }
            }


            $filteredData = $jobs->map(function ($job) {
                return [
                    'id' => $job['id'],
                    'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                    'company_id' => $job['company']['id'],
                    'company_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                    'company_logo' => $job['company']['image_logo'],
                    'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
                    'salary_min' => $job['salary']['min'],
                    'salary_max' => $job['salary']['max'],
                    'is_salary_visible' => $job['is_salary_visible'],
                    'published' => $job['published']['since'],
                    'provicene' => $job['addresses']['address_region_list']
                ];
            });
            $responseCity = Http::get('https://vietnam-administrative-division-json-server-swart.vercel.app/province');
            $data = $responseCity->json();
            $provinceNames = array_map(function ($province) {
                $name = mb_strtolower($province['name']);
                return $name;
            }, $data);

            // Áp dụng bộ lọc loại công việc (city)
            $city = mb_strtolower($city);
            if ($city && in_array($city, $provinceNames)) {
                $filteredData = $filteredData->filter(function ($job) use ($city) {
                    return stripos($job['provicene'], $city) !== false;
                });
            }

            return [
                'data' => $filteredData->values(),
                'last_page' => $lastPage
            ];
        } else {
            $totalRecords = Job::count();
            $totalPages = ceil($totalRecords / $page_size);
            $makeHidden = ['skills', 'content', 'experience', 'responsibilities', 'requirements', 'job_type_str', 'recruitment_process', 'job_level', 'is_edit', 'is_applied', 'created_at', 'updated_at', 'benefit_id'];
            // User criteria
            $user_id = $request->query('user_id');
            $user = null;
            if ($user_id) {
                $user = User::find($user_id);
            }
            $jobs = Job::leftJoin('companies', 'jobs.company_id', '=', 'companies.id')
                ->leftJoin('addresses', function ($join) {
                    $join->on('jobs.company_id', '=', 'addresses.company_id')
                        ->whereRaw('addresses.id = (select id from addresses where addresses.company_id = jobs.company_id limit 1)');
                })
                ->select('jobs.*', 'companies.display_name as company_name', 'companies.image_logo as company_logo', 'addresses.province as sort_addresses')
                ->paginate($page_size);
            $jobs->getCollection()->transform(function ($job) use ($makeHidden) {
                $job->makeHidden($makeHidden);
                $job->is_applied = (bool) $job->is_applied;
                $job->is_salary_visible = (bool) $job->is_salary_visible;
                $job->published = $this->formatTimeDifference($job->published);
                return $job;
            });

            $jobs = $jobs->forPage($page, $page_size);
            // Lọc theo thành phố nếu có
            if ($city) {
                $city = mb_strtolower($city, 'UTF-8');
                $jobs = $jobs->filter(function ($job) use ($city) {
                    return stripos($job['sort_addresses'], $city) !== false;
                });
            }

            // Nếu không có người dùng, trả về danh sách công việc đã lọc theo thành phố
            if (!$user) {
                return [
                    'data' => $jobs->values(),
                    'last_page' => $totalPages
                ];
            }

            // Nếu có người dùng, tiếp tục xử lý lọc theo tiêu chí công việc của người dùng
            $job_criteria = $user->jobCriteria;
            if ($job_criteria['job_salary'] == null) {
                return [
                    'data' => $jobs->values(),
                    'last_page' => $totalPages
                ];
            }
            $jobsArray = $jobs->map(function ($job) use ($job_criteria) {
                $job['similarity'] = $this->calculateSimilarity($job, $job_criteria);
                return $job;
            })->sortByDesc('similarity')->values()->toArray();

            usort($jobsArray, function ($a, $b) {
                return $b['similarity'] - $a['similarity'];
            });

            return [
                'data' => $jobsArray,
                'last_page' => $totalPages
            ];
        }
    }


    public function storeBookmark(Request $request)
    {
        $user_id = $request->user_id;
        $job_id = $request->job_id;
        $type = $request->type;
        $bookmark = new Bookmark();
        $bookmark->user_id = $user_id;
        $bookmark->job_id = $job_id;
        $bookmark->type = $type;
        $bookmark->save();

        return response()->json([
            'message' => 'Bookmark created successfully'
        ], 200);
    }

    public function destroyBookmark(Request $request)
    {
        $user_id = $request->user_id;
        $job_id = $request->job_id;
        // $type = $request->type;
        $bookmark = Bookmark::where('user_id', $user_id)->where('job_id', $job_id)->first();
        $bookmark->delete();
        return response()->json([
            'message' => 'Bookmark delete successfully'
        ], 200);
    }

    // get all jobs topdev with array id
    public function getJobsByArrIds(Request $request)
    {
        $userId = $request->user_id;
        $page = $request->query('page', 1);
        $perPage = 15;
        $skip = ($page - 1) * $perPage;
        $data = Bookmark::where('user_id', $userId)->skip($skip)->take($perPage)->get(['job_id','type'])->toArray();
        $totalRecords = Bookmark::where('user_id', $userId)->count();
        $totalPages = ceil($totalRecords / $perPage);
        // return count($data);
        // mảng id công việc được lấy từ db và dựa vào user_id được lấy từ request
        $page = 1;
        $jobs = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['type'] == 0) {
                
                $job = Cache::get("job_{$data[$i]['job_id']}");
                if (!$job) {
                    $response = Http::get("https://api.topdev.vn/td/v2/jobs/{$data[$i]['job_id']}?fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");
                    $result = json_decode($response->getBody()->getContents(), true);
                    $job = [
                        'id' => $result['data']['id'],
                        'title' => $result['data']['title'],
                        'company_id' => $result['data']['company']['id'],
                        'company_name' => $result['data']['company']['display_name'],
                        'company_logo' => $result['data']['company']['image_logo'],
                        'sort_addresses' => $result['data']['addresses']['sort_addresses'],
                        'salary_min' => $result['data']['salary']['min'],
                        'salary_max' => $result['data']['salary']['max'],
                        'is_salary_visible' => $result['data']['is_salary_visible'],
                        'published' => $result['data']['published']['since'],
                    ];
                    

                    Cache::put("job_{$data[$i]['job_id']}", $job, 60);
                }
                $jobs[] = $job;
            }else{
                $job = Job::find($data[$i]['job_id']);
                $job->makeHidden(['skills', 'content', 'experience', 'responsibilities', 'requirements', 'job_type_str', 'recruitment_process', 'job_level', 'is_edit', 'is_applied', 'created_at', 'updated_at', 'benefit_id']);
                $job->is_applied = (bool) $job->is_applied;
                $job->is_salary_visible = (bool) $job->is_salary_visible;
                $job->published = $this->formatTimeDifference($job->published);
                $jobs[] = $job;
            }
        }
        return [
            'data' => $jobs,
            'last_page' => $totalPages
        ];
    }

    //get total job bookmark
    public function getTotalJobBookmark(Request $request)
    {
        $userId = $request->user_id;
        $totalRecords = Bookmark::where('user_id', $userId)->count();
        return $totalRecords;
    }

    public function getBookmarksArrJobIds(Request $request)
    {
        $userId = 1;
        $bookmarkIds = Bookmark::where('user_id', $userId)->pluck('job_id')->toArray();
        return $bookmarkIds;
    }

    private function calculateSimilarity($job, $criteria)
    {
        $score = 0;

        // So sánh vị trí công việc
        $positionsArray = explode(",", $criteria['job_position']);
        foreach ($positionsArray as $value) {
            if (strpos($job['title'],  $value) !== false) {
                $score += 2;
            }
        }

        // So sánh địa điểm công việc
        $positionsArray = explode(",", $criteria['job_location']);
        foreach ($positionsArray as $value) {
            if (strpos($job['addresses']['address_region_list'], $value) !== false) {
                $score += 3;
            }
        }


        // So sánh mức lương
        $salaries = explode(',', $criteria['job_salary']);
        $salaryMin = $salaries[0];
        $salaryMax = $salaries[1];
        foreach ($salaries as $salary) {
            if ($job['salary']['value'] >= $salaryMin && $job['salary']['value'] <= $salaryMax) {
                $score += 1;
                break;
            }
        }

        return $score;
    }

    private function formatTimeDifference($timestamp)
    {
        $givenDate = Carbon::parse($timestamp);
        $now = Carbon::now();

        if ($givenDate->diffInDays($now) >= 1) {
            return $givenDate->diffForHumans($now, CarbonInterface::DIFF_RELATIVE_TO_NOW);
        } else if ($givenDate->diffInHours($now) >= 1) {
            return $givenDate->diffForHumans($now, CarbonInterface::DIFF_RELATIVE_TO_NOW);
        } else {
            return "Vừa xong";
        }
    }
}
