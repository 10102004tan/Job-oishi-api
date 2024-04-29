<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class TestController extends Controller
{
    public function handleAPI()
    {
        $client = new Client([
            'verify' => false,
        ]);

        $response = $client->request('GET', 
        'https://api.topdev.vn/td/v2/jobs?ordering=newest_job&page_size=32&packages=basic-plus&locale=vi_VN&fields[job]=id,company,title,skills_ids,salary,addresses,published,detail_url,slug');
        $data = json_decode($response->getBody()->getContents(), true);

        // // Xử lý dữ liệu tại đây...
        // $filteredData = array_map(function ($job) {
        //     return [
        //         'id' => $job['id'],
        //         'title' => $job['title'],
        //         'content' => $job['content'],
        //         'company_id' => $job['company']['id'],
        //     ];
        // }, $data['data']);

        // $data['data'] = $filteredData;

        return response()->json($data);
    }
}
