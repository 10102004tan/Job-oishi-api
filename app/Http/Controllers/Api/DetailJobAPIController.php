<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailJobAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ("Hello");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {

        $response = Http::get('https://api.topdev.vn/td/v2/jobs/'. $id .'?fields[job]=id,title,content,benefits,contract_types_str,contract_types_ids,requirements,salary,responsibilities,company,skills_arr,skills_ids,experiences_str,experiences_ids,experiences_arr,job_types_str,job_types_arr,job_types_ids,job_levels_str,job_levels_ids,addresses,detail_url,job_url,modified,refreshed,slug,is_applied,is_followed,meta_title,meta_description,meta_keywords,schema_job_posting,features,other_supports,recruiment_process,status_display,image_thumbnail,blog_tags,blog_posts,sidebar_image_banner_url,sidebar_image_link,is_free,is_basic,is_basic_plus,is_distinction&fields[company]=products,news,tagline,website,company_size,social_network,addresses,nationalities_arr,skills_ids,industries_arr,industries_ids,benefits,description,image_galleries,num_job_openings,faqs,slug,recruitment_process&locale=vi_VN');

        if ($response->ok()) {
        $dataAPI = json_decode($response)->data;
        // dd($dataAPI);
        $data = [];
        $data["id"] = $dataAPI->id;
        $data["title"] = strip_tags($dataAPI->title);
        $data["content"] = strip_tags($dataAPI->content);
        $data["requirements"] = strip_tags($dataAPI->requirements);
        $data["responsibilities"] = strip_tags($dataAPI->responsibilities);
        $data["company_id"] = $dataAPI->company->id;
        $data["company_name"] = $dataAPI->company->display_name;
        $data["company_logo"] = $dataAPI->company->image_logo;
        $data["skills"] = array_map('strip_tags', $dataAPI->skills_arr);
        $data["experience"] = $dataAPI->experiences_str;
        $data["is_edit"] = 0;
        $data["is_salary_value"] = $dataAPI->is_salary_visible;
        $data["job_level"] = $dataAPI->job_levels_str;
        $data["is_applied"] = $dataAPI->is_applied;
        // dd($dataAPI->skills_arr);

            return $data;
        }
        else {
        return array(
            "message" => "Job not found !!!",
            "status" => 500
        );
    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
