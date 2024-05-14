<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $page_size = $request->query('page_size', 50);
        $response = Http::get("https://api.topdev.vn/td/v2/jobs?page_size=$page_size&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url");
        $data = json_decode($response->getBody()->getContents(), true);
        $collection = collect($data['data']);
        // // Xử lý dữ liệu tại đây...
        $filteredData = $collection->map(function ($job) {
            return [
                'id' => $job['id'],
                'title' => strlen($job['title']) > 25 ? mb_substr($job['title'], 0, 25) . '...' : $job['title'],
                'company_id' => $job['company']['id'],
                'company_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                'company_logo' => $job['company']['image_logo'],
                'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
                'salary_min' => $job['salary']['min'],
                'salary_max' => $job['salary']['max'],
            ];
        });

        // $data['data'] = $filteredData;
        return response()->json($filteredData);
    }

    public function search(Request $request)
    {
        // Nhận dữ liệu tìm kiếm từ yêu cầu
        $key = $request->query('q');
        $page = $request->query('page', 1); // Lấy số trang, mặc định là 1
        $page_size = $request->query('page_size', 10); // Lấy kích thước trang, mặc định là 10

        // Gửi yêu cầu đến API TopDev với các tham số
        $response = Http::get("https://api.topdev.vn/td/v2/jobs", [
            'page_size' => 1000, // Lấy số lượng lớn để lọc kết quả
            'locale' => 'vi_VN',
            'fields[job]' => 'id,company,title,skills_ids,salary,addresses,published,detail_url'
        ]);

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
                'company_name' => strlen($job['company']['display_name']) > 30 ? mb_substr($job['company']['display_name'], 0, 30) . '...' : $job['company']['display_name'],
                'company_logo' => $job['company']['image_logo'],
                'sort_addresses' => strlen($job['addresses']['sort_addresses']) > 25 ? mb_substr($job['addresses']['sort_addresses'], 0, 25) . '...' : $job['addresses']['sort_addresses'],
                'salary_min' => $job['salary']['min'],
                'salary_max' => $job['salary']['max'],
            ];
        });

        return response()->json($transformedData->values());
    }
}
