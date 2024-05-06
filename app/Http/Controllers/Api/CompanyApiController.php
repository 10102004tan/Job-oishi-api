<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the details of company
     * String id: id of company
     */
    public function show(string $id)
    {
        $response = Http::get("https://api.topdev.vn/td/v2/companies/$id?fields[company]=products,news,tagline,website,company_size,social_network,addresses,nationalities_arr,skills_ids,industries_arr,industries_ids,benefits,description,image_galleries,num_job_openings,faqs,slug,recruitment_process&ordering=newest_job&page_size=2&except_ids=2032582&page=1&locale=vi_VN");

        if ($response->ok()) {
            $data_response = json_decode($response)->data;
            // dd($data_response);
            $data = array();
            $data["id"] = $data_response->id;
            $data["display_name"] = $data_response->display_name;
            $data["image_logo"] = $data_response->image_logo;
            $data["description"] = $data_response->description;
            $data["website"] = $data_response->website;
            $data["tagline"] = $data_response->tagline;
            $data["company_size"] = $data_response->company_size;
            $data["address_region_id"] = $data_response->addresses;
            $data["num_job_openings"] = $data_response->num_job_openings;
            $data["benefits"] = $data_response->benefits;
            $data["nationality_id"] = $data_response->nationalities_arr;

            return $data;

        }else {
            return array(
                "message" => "No company found !!!",
                "status" => 500
            );
        }
    }


        /**
     * Display all the job of company
     */
    public function getJob(Request $request)
    {
        $company_id = $request->query('id');
        $except_ids = $request->query('job');

        $response = Http::get("https://api.topdev.vn/td/v2/companies/$company_id/jobs?fields[job]=id,title,content,benefits,contract_types_str,contract_types_ids,requirements,salary,responsibilities,company,skills_arr,skills_ids,experiences_str,experiences_ids,experiences_arr,job_types_str,job_types_arr,job_types_ids,job_levels_str,job_levels_ids,addresses,detail_url,job_url,modified,refreshed,slug,is_applied,is_followed,meta_title,meta_description,meta_keywords,schema_job_posting,features,other_supports,recruiment_process,status_display,image_thumbnail,blog_tags,blog_posts,sidebar_image_banner_url,sidebar_image_link,is_free,is_basic,is_basic_plus,is_distinction&fields[company]=products,news,tagline,website,company_size,social_network,addresses,nationalities_arr,skills_ids,industries_arr,industries_ids,benefits,description,image_galleries,num_job_openings,faqs,slug,recruitment_process&ordering=newest_job&page_size=2&except_ids=$except_ids&page=1&locale=vi_VN");

        if ($response->ok()) {
            $data_response = json_decode($response)->data;
            // dd($data_response);
            $data = array();

            foreach ($data_response as $key => $detail) {
                $data[$key]["id"] = $detail->id;
                $data[$key]["title"] = $detail->title;
                $data[$key]["content"] = $detail->content;
                $data[$key]["company_id"] = $detail->company;
                $data[$key]["experience"] = $detail->experiences_str;
                $data[$key]["jobs_type_str"] = $detail->job_types_str;
                $data[$key]["is_edit"] = false;
                $data[$key]["salary"] = $detail->salary;
                $data[$key]["job_level"] = $detail->job_levels_str;
                $data[$key]["is_salary_value"] = false;
                $data[$key]["created_at"] = "";
                $data[$key]["is_applied"] = false;
            }

            return $data;

        }else {
            return array(
                "message" => "Job not found !!!",
                "status" => 500
            );
        }
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
