<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobBookmark;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class JobController extends Controller
{

    public function index(Request $request)
    {
        $jobAPIDBController = new JobAPIDBController();
        $jobs = $jobAPIDBController->index($request);
        $page_size = 15;
        $page = $request->query('page', 1);
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=$page_size&page=$page&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");
        $data = json_decode($response->getBody()->getContents(), true);
        $jobs = collect($data['data']);

        // // // Xử lý dữ liệu tại đây...
        // Xử lý lọc công việc theo tiêu chí của người dùng
        $user = User::find($request->user_id);
        $job_criteria = $user->jobCriteria;

        $jobsArray = $jobs->map(function ($job) use ($job_criteria) {
            $job['similarity'] = $this->calculateSimilarity($job, $job_criteria);
            return $job;
        })->sortByDesc('similarity')->values()->toArray();

        usort($jobsArray, function($a, $b) {
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
            'is_salary_visible'=> $job['is_salary_visible'],
            'published' => $job['published']['since'],
            ];
        });

        //$mergedData = collect($jobs)->merge( $filteredData)->toArray();
        return $jobsArray;
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
            if (strpos(strtolower($job['addresses']['address_region_list']), strtolower($value)) !== false) {
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

    public function bookmark(Request $request){
        //add job to bookmark
        $job = new JobBookmark();
        $job->id = $request->id;
        $job->title = $request->title;
        $job->company_name = $request->company_name;
        $job->company_logo = $request->company_logo;
        $job->sort_addresses = $request->sort_addresses;
        $job->is_salary_visible = $request->is_salary_visible;
        $job->published = $request->published;

        if ($job->save()) {
            return response()->json([
                'message' => 'Job bookmarked successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Job bookmarked failed'
            ]);
        }
    }
    public function getAllJobsBookmark(Request $request){
        $jobs = JobBookmark::where('user_id', 1)->get();
        return $jobs;
    }


    public function destroyJobOnBookmark(Request $request)
    {
        DB::table('jobs_bookmark')->where('id', $request->id)->where('user_id', $request->userId)->delete();
        return "ok";
    }
}
