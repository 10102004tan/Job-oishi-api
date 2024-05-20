<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCriteria;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Http;

class JobAPIDBController extends Controller
{
    /**
     * Display a listing of th e resource.
     */

    public function index(Request $request)
    {
        $makeHidden = ['skills', 'content', 'experience', 'responsibilities', 'requirements', 'job_type_str', 'recruitment_process', 'job_level', 'is_edit', 'is_applied', 'created_at', 'updated_at', 'benefit_id'];

        // User criteria
        // $user_id = 1;
        // $user = User::find($user_id);
        $page = $request->query('page', 1);
        $city = $request->query('city');
        $jobs = Job::leftJoin('companies', 'jobs.company_id', '=', 'companies.id')
            ->leftJoin('addresses', 'jobs.company_id', '=', 'addresses.company_id')
            ->select('jobs.*', 'companies.display_name as company_name', 'companies.image_logo as company_logo', 'addresses.address as sort_addresses')
            ->paginate(10);


        $jobs->getCollection()->transform(function ($job) use ($makeHidden) {
            $job->makeHidden($makeHidden);
            $job->is_applied = (bool) $job->is_applied;
            $job->is_salary_visible = (bool) $job->is_salary_visible;
            $job->published = $this->formatTimeDifference($job->published);
            return $job;
        });

        $cities = ['Hà Nội', 'Hồ Chí Minh', 'Đà Nẵng', 'Nha Trang', 'Quy Nhơn', 'Đồng Nai', 'Hải Phòng', 'Cần Thơ'];
        
        // Áp dụng bộ lọc loại công việc (city)
        if ($city && in_array($city, $cities)) {
            $jobs = $jobs->filter(function ($job) use ($city) {
                $city = strtolower($city);
                return stripos($job['sort_addresses'], $city) !== false;
            });
        }


        $jobsP = $jobs->forPage($page, 10);
        
        

        
        $user = User::find($request->user_id);


        if ($user) {
            $job_criteria = $user->jobCriteria;
            $jobsArray = $jobsP->map(function ($job) use ($job_criteria) {
                $job['similarity'] = $this->calculateSimilarity($job, $job_criteria);
                return $job;
            })->sortByDesc('similarity')->values()->toArray();

            usort($jobsArray, function ($a, $b) {
                return $b['similarity'] - $a['similarity'];
            });

            return response()->json($jobsArray);
        }

        return response()->json($jobs->values());
    }


    private function calculateSimilarity($job, $criteria)
    {
        $score = 0;

        // So sánh vị trí công việc
        $positionsArray = explode(",", $criteria['job_position']);
        foreach ($positionsArray as $value) {
            if (strpos(strtolower($job['title']),  strtolower($value)) !== false) {
                $score += 6;
            }
        }

        // So sánh địa điểm công việc
        $positionsArray = explode(",", $criteria['job_location']);
        foreach ($positionsArray as $value) {
            if (strpos(strtolower($job['sort_addresses']), strtolower($value)) !== false) {
                $score += 3;
            }
        }


        // So sánh mức lương
        if ($job["is_salary_visible"]) {
            $salaries = explode(',', $criteria['job_salary']);
            $salaryMin = (int)$salaries[0];
            $salaryMax = (int)$salaries[1];
            $currentSalary = (int) $job['salary']['value'];
            if ($currentSalary >= $salaryMin && $currentSalary <= $salaryMax) {
                $score += 1;
            }
        }
        return $score;
    }





    public function getDetail(string $id)
    {
        $job = Job::with('company')->find($id);

        if ($job != null) {
            if ($job->is_edit != 0) {
                $job->makeHidden(['company_id']);

                $job->is_applied = $job->is_applied ? true : false;
                $job->is_salary_visible = $job->is_salary_visible ? true : false;
                $job->is_edit = $job->is_edit ? true : false;
                return response()->json($job);
            }
        } else {
            $response = Http::get('https://api.topdev.vn/td/v2/jobs/' . $id . '?fields[job]=id,title,content,benefits,contract_types_str,contract_types_ids,requirements,salary,responsibilities,company,skills_arr,skills_ids,experiences_str,experiences_ids,experiences_arr,job_types_str,job_types_arr,job_types_ids,job_levels_str,job_levels_ids,addresses,detail_url,job_url,modified,refreshed,slug,is_applied,is_followed,meta_title,meta_description,meta_keywords,schema_job_posting,features,other_supports,recruiment_process,status_display,image_thumbnail,blog_tags,blog_posts,sidebar_image_banner_url,sidebar_image_link,is_free,is_basic,is_basic_plus,is_distinction&fields[company]=products,news,tagline,website,company_size,social_network,addresses,nationalities_arr,skills_ids,industries_arr,industries_ids,benefits,description,image_galleries,num_job_openings,faqs,slug,recruitment_process&locale=vi_VN');

            if ($response->ok()) {
                $dataAPI = json_decode($response)->data;
                // dd($dataAPI);

                // Khởi tạo mảng để lưu thông tin các địa chỉ
                $addresses = [];
                // Lặp qua mỗi địa chỉ trong mảng collection_addresses
                foreach ($dataAPI->company->addresses->collection_addresses as $address) {
                    $addressInfo = [
                        'street' => $address->street,
                        'ward' => $address->ward->value,
                        'district' => $address->district->value,
                        'province' => $address->province->value,
                    ];

                    // Thêm thông tin của địa chỉ vào mảng chứa thông tin của tất cả các địa chỉ
                    $addresses[] = $addressInfo;
                }

                // Lấy thông tin companay
                $company = [
                    "id" => $dataAPI->company->id,
                    "display_name" => $dataAPI->company->display_name,
                    "image_logo" => $dataAPI->company->image_logo,
                    "description" => html_entity_decode(strip_tags($dataAPI->company->display_name)),
                    "website" => $dataAPI->company->website,
                    "tagline" => $dataAPI->company->tagline,
                    "company_size" => $dataAPI->company->company_size,
                    "addresses" => $addresses
                ];

                // Lấy thông tin benefits của job
                $benifits = array_map(function ($benifit) {
                    return [
                        'icon' => $benifit->icon,
                        'value' => $benifit->value
                    ];
                }, $dataAPI->benefits);

                $recruitment_process = array_map(function ($recruitment) {
                    return $recruitment->name;
                }, $dataAPI->company->recruitment_process);

                $data = [];
                $data["id"] = $dataAPI->id;
                $data["title"] = strip_tags($dataAPI->title);
                $data["content"] = html_entity_decode(strip_tags($dataAPI->content));
                $data["requirements"] = html_entity_decode(strip_tags($dataAPI->requirements));
                $data["responsibilities"] = html_entity_decode(strip_tags($dataAPI->responsibilities));
                $data["company"] = $company;
                $data["skills"] = array_map('strip_tags', $dataAPI->skills_arr);
                $data["experience"] = $dataAPI->experiences_str;
                $data["job_types_str"] = $dataAPI->job_types_str;
                $data["job_level"] = $dataAPI->job_levels_str;
                $data["recruitment_process"] = $recruitment_process;
                $data["is_salary_visible"] = $dataAPI->is_salary_visible;
                $data["salary_value"] = $dataAPI->salary->value . " " . $dataAPI->salary->currency . " / " . $dataAPI->salary->unit;
                $data["benefits"] = $benifits;
                $data["is_edit"] = false;
                $data["is_applied"] = $dataAPI->is_applied;
                $data["modified"] = $dataAPI->modified;
                // dd($dataAPI->skills_arr);

                return $data;
            } else {
                return array(
                    "message" => "Job not found !!!",
                    "status" => 500
                );
            }
        }
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
