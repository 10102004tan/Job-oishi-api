<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobSearchController extends Controller
{
    public function index(Request $request)
{
    $page_size = $request->query('page_size', 50);
    $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=$page_size&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");

    $data = json_decode($response->getBody()->getContents(), true);
    $jobs = collect($data['data']);

    $filteredData = $jobs->map(function ($job) {
        return [
            'id' => $job['id'],
            'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
            'company_id' => $job['company']['id'],
            'display_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
            'image_logo' => $job['company']['image_logo'],
            'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
            'salary_min' => $job['salary']['min'],
            'salary_max' => $job['salary']['max'],
            'published' => $job['published']['since'],
        ];
    });

    $filteredData = $filteredData->map(function ($job) {
        $companyId = $job['company_id'];
        $response = Http::get("https://api.topdev.vn/td/v2/companies/$companyId/jobs?fields[job]=id,title,content,benefits,contract_types_str,contract_types_ids,requirements,salary,responsibilities,company,skills_arr,skills_ids,experiences_str&fields[company]=products,news,tagline,addresses,benefits&ordering=newest_job&page_size=2&except_ids=2032583&page=1&locale=vi_VN");
        $companyData = json_decode($response->getBody()->getContents(), true);


        // Check if company data contains benefits, experiences_str, and contract_types_str
        if (isset($companyData['data']) && is_array($companyData['data']) && count($companyData['data']) > 0) {
            $company = $companyData['data'][0]; // Lấy job đầu tiên trong danh sách
            $job['experiences_str'] = $company['experiences_str'] ?? '';
            $job['contract_types_str'] = $company['contract_types_str'] ?? '';
            $job['benefits'] = $company['benefits'] ?? [];
        } else {
            $job['experiences_str'] = '';
            $job['contract_types_str'] = '';
            $job['benefits'] = [];
        }

        return $job;
    });

    return response()->json($filteredData);
}

    

    public function search(Request $request)
    {
        // Nhận dữ liệu tìm kiếm từ yêu cầu
        $key = $request->query('q');
        $page = $request->query('page', 1); // Lấy số trang, mặc định là 1
        $page_size = $request->query('page_size', 10); // Lấy kích thước trang, mặc định là 10

        // Gửi yêu cầu đến API TopDev với các tham số
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=1000&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");

        // Xử lý phản hồi từ API TopDev
        $data = json_decode($response->getBody()->getContents(), true);
        $collection = collect($data['data']);

        // Lọc danh sách công việc dựa trên tên công việc
        if ($key) {
            $filteredData = $collection->filter(function ($job) use ($key) {
                return stripos($job['title'], $key) !== false;
            });
        } else {
            $filteredData = $collection;
        }

        // Phân trang kết quả đã lọc
        $paginatedData = $filteredData->forPage($page, $page_size);

        // Xử lý dữ liệu như trước
        $transformedData = $paginatedData->map(function ($job) {
            return [
                'id' => $job['id'],
                'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                'company_id' => $job['company']['id'],
                'display_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                'image_logo' => $job['company']['image_logo'],
                'sort_addresses' => $job['addresses']['sort_addresses'],
                'salary_min' => $job['salary']['min'],
                'salary_max' => $job['salary']['max'],
                'published' => $job['published']['since'],
                ''
            ];
        });

        return response()->json($transformedData->values());
    }

    public function searchRemote(Request $request)
    {
        // Nhận dữ liệu tìm kiếm từ yêu cầu
        $key = $request->query('q');
        $page = $request->query('page', 1); // Lấy số trang, mặc định là 1
        $page_size = $request->query('page_size', 10); // Lấy kích thước trang, mặc định là 10

        // Gửi yêu cầu đến API TopDev với các tham số
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=1000&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");

        // Xử lý phản hồi từ API TopDev
        $data = json_decode($response->getBody()->getContents(), true);
        $collection = collect($data['data']);

        // Lọc danh sách công việc dựa trên tên công việc và loại công việc remote
        $filteredData = $collection->filter(function ($job) use ($key) {
            $isRemote = false;
            $addresses = $job['addresses'];

            // Kiểm tra các key khác nhau để xác định công việc remote
            if (stripos($addresses['sort_addresses'], 'remote') !== false || stripos($job['title'], 'remote') !== false) {
                $isRemote = true;
            }

            // Lọc theo tên công việc và loại công việc remote
            return $isRemote && (!$key || stripos($job['title'], $key) !== false);
        });

        // Phân trang kết quả đã lọc
        $paginatedData = $filteredData->forPage($page, $page_size);

        // Xử lý dữ liệu như trước
        $transformedData = $paginatedData->map(function ($job) {
            return [
                'id' => $job['id'],
                'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                'company_id' => $job['company']['id'],
                'display_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                'image_logo' => $job['company']['image_logo'],
                'addresses' => $job['addresses']['sort_addresses'],
                'salary_min' => $job['salary']['min'],
                'salary_max' => $job['salary']['max'],
                'published' => $job['published']['since'],
            ];
        });

        return response()->json($transformedData->values());
    }
}
