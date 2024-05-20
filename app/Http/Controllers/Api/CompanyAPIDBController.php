<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Benefit;
use Illuminate\Support\Facades\Http;

class CompanyAPIDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hiddenBenefitFields = ['id', 'pivot', 'created_at', 'updated_at'];

        $companies = Company::with('benefits', 'address')->get();

        // Xử lý ẩn các trường trong mối quan hệ 'benefits'
        $companies->each(function ($company) use ($hiddenBenefitFields) {
            $company->benefits->transform(function ($benefit) use ($hiddenBenefitFields) {
                return $benefit->makeHidden($hiddenBenefitFields);
            });
        });


        return $companies;
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
    public function show(string $id)
    {
        //
    }

    public function getDetail(string $id)
    {

        $company = Company::with(['benefits', 'address', 'industries'])->find($id);

        if ($company != null) {

            // Hide unnecessary fields
            $company->makeHidden(['benefit_id']);

            // Prepare the response data
            $response = [
                'id' => $company->id,
                'display_name' => $company->display_name,
                'image_logo' => $company->image_logo,
                'description' => $company->description,
                'website' => $company->website,
                'tagline' => $company->tagline,
                'company_size' => $company->company_size,
                'addresses' => $company->address->map(function ($address) {
                    return [
                        'street' => $address->street,
                        'ward' => $address->ward,
                        'district' => $address->district,
                        'province' => $address->province,
                    ];
                }),
                'num_job_openings' => $company->num_job_openings,
                'image_galleries' => $company->image_galleries,
                'benefits' => $company->benefits->map(function ($benefit) {
                    return [
                        'value' => $benefit->value,
                        'icon' => $benefit->icon,
                    ];
                }),
                'nationalities' => $company->nationalities->map(function ($nationality) {
                    return [
                        'national' => $nationality->national,
                        'flag' => $nationality->flag,
                    ];
                }),
                'industries_arr' => $company->industries->pluck('industry_name'),
            ];

            return response()->json($response);
        } else {
            $response = Http::get("https://api.topdev.vn/td/v2/companies/$id?fields[company]=products,news,tagline,website,company_size,social_network,addresses,nationalities_arr,skills_ids,industries_arr,industries_ids,benefits,description,image_galleries,num_job_openings,faqs,slug,recruitment_process&ordering=newest_job&page_size=2&except_ids=2032582&page=1&locale=vi_VN");

            if ($response->ok()) {
                $data_response = json_decode($response)->data;


                // Khởi tạo mảng để lưu thông tin các địa chỉ
                $addresses = [];
                // Lặp qua mỗi địa chỉ trong mảng collection_addresses
                foreach ($data_response->addresses->collection_addresses as $address) {
                    $addressInfo = [
                        'street' => $address->street,
                        'ward' => $address->ward->value,
                        'district' => $address->district->value,
                        'province' => $address->province->value,
                    ];

                    // Thêm thông tin của địa chỉ vào mảng chứa thông tin của tất cả các địa chỉ
                    $addresses[] = $addressInfo;
                }

                // Lấy thông tin benefits của job
                $image_galleries = array_map(function ($image_gallerie) {
                    return $image_gallerie->url;
                }, $data_response->image_galleries);

                $data = array();
                $data["id"] = $data_response->id;
                $data["display_name"] = $data_response->display_name;
                $data["image_logo"] = $data_response->image_logo;
                $data["description"] = html_entity_decode(strip_tags($data_response->description));
                $data["website"] = $data_response->website;
                $data["tagline"] = $data_response->tagline;
                $data["company_size"] = $data_response->company_size;
                $data["addresses"] = $addresses;
                $data["num_job_openings"] = $data_response->num_job_openings;
                $data["image_galleries"] = $image_galleries;
                $data["benefits"] = $data_response->benefits;
                $data["nationalities"] = $data_response->nationalities_arr;
                $data["industries_arr"] = $data_response->industries_arr;
                return $data;
            } else {
                return array(
                    "message" => "No company found !!!",
                    "status" => 500
                );
            }
        }
    }

    /**
     * Display all the job of company
     */

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
