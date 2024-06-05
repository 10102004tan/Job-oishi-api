<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobSearchController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->query('page_size', 100);
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=$page_size&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");

        $data = json_decode($response->getBody()->getContents(), true);
        $jobs = collect($data['data']);

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
                'published' => $job['published']['since'],
            ];
        });

        
        return response()->json($filteredData);
    }

    public function search(Request $request)
    {
        // Nhận dữ liệu tìm kiếm từ yêu cầu
        $keyword = $request->query('q'); 
        $remote = $request->query('remote'); 
        $sortBy = $request->query('sortBy');
        $experience = $request->query('experience'); 
        $jobType = $request->query('jobType');
        $page = $request->query('page', 1); 
        $page_size = $request->query('page_size', 10);

        // Gửi yêu cầu đến API TopDev với các tham số
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=1000&locale=vi_VN&fields[job]=id,company,title,salary,addresses,published,contract_types_str,benefits,experiences_str");

       
        $data = json_decode($response->getBody()->getContents(), true);
        $collection = collect($data['data']);

        if ($keyword) {
            $filteredData = $collection->filter(function ($job) use ($keyword) {
                return stripos($job['title'], $keyword) !== false || stripos($job['company']['display_name'], $keyword) !== false;
            });
        } else {
            $filteredData = $collection;
        };

        if ($remote === true || $remote === 'true' || $remote == 1) {
            $filteredData = $filteredData->filter(function ($job) {
                // Kiểm tra xem tiêu đề của công việc có chứa các từ khóa như "remote", "work from home" hay không
                $title = strtolower($job['title']);
                $sort_address = strtolower($job['addresses']['sort_addresses']);
                return strpos($title, 'remote') !== false || strpos($title, 'home') !== false || strpos($title, 'freelance') !== false || strpos($sort_address, 'remote') !== false;
            });
        } 

        $jobTypes = ['fulltime', 'part-time', 'internship', 'freelance'];
        
        // Áp dụng bộ lọc loại công việc (jobType)
        if ($jobType && in_array($jobType, $jobTypes)) {
            $filteredData = $filteredData->filter(function ($job) use ($jobType) {
                $jobType = strtolower($jobType);
                return stripos($job['contract_types_str'], $jobType) !== false;
            });
        }



        if ($sortBy) {
            
        }

        $experiences = ['1 năm', "2 năm", "3 năm", "5 năm", "10 năm"];
        // Áp dụng bộ lọc loại công việc (jobType)
        if ($experience && in_array($experience, $experiences)) {
            $filteredData = $filteredData->filter(function ($job) use ($experience) {
                return stripos($job['experiences_str'], $experience) !== false;
            });
        }

        // Phân trang kết quả đã lọc (nếu cần)
        $paginatedData = $filteredData->forPage($page, $page_size);

        // Xử lý dữ liệu như trước
        $transformedData = $paginatedData->map(function ($job) {
            return [
                'id' => $job['id'],
                'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                'company_id' => $job['company']['id'],
                'company_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                'company_logo' => $job['company']['image_logo'],
                'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
                'salary_min' => $job['salary']['min'],
                'salary_max' => $job['salary']['max'],
                'published' => $job['published']['since'],
                'experiences_str' => $job['experiences_str'],
                'contract_types_str' => $job['contract_types_str'],
            ];
        });

        return $transformedData->values();
        }

}
