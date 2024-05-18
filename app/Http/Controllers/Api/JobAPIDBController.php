<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Http;

class JobAPIDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $makeHidden = ['skills', 'content', 'experience', 'responsibilities', 'requirements', 'job_type_str', 'recruitment_process', 'job_level', 'is_edit', 'is_applied', 'created_at', 'updated_at', 'benefit_id'];

        $page = $request->input('page', 1);

        $jobs = Job::leftJoin('companies', 'jobs.company_id', '=', 'companies.id')
            ->leftJoin('addresses', 'jobs.company_id', '=', 'addresses.company_id')
            ->select('jobs.*', 'companies.display_name as display_name', 'companies.image_logo as image_logo', 'addresses.address as sort_address')
            ->paginate(10);


        $jobs->getCollection()->transform(function ($job) use ($makeHidden) {
            $job->makeHidden($makeHidden);
            $job->is_applied = (bool) $job->is_applied;
            $job->is_salary_visible = (bool) $job->is_salary_visible;
            $job->published = $this->formatTimeDifference($job->published);
            return $job;
        });

        // Thêm tham số trang vào URL
        $jobs->appends($request->only('page'));

        return response()->json($jobs->values());
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
