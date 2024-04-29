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
