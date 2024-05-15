<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;


class JobAPIDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $makeHidden = ['skills', 'content', 'experience', 'responsibilities', 'requirements', 'job_type_str', 'recruitment_process', 'job_level', 'is_edit', 'is_applied', 'created_at', 'updated_at'];
    
        // Lấy số trang từ yêu cầu HTTP, mặc định là 1 nếu không được chỉ định
        $page = $request->input('page', 1);
    
        $jobs = Job::leftJoin('companies', 'jobs.company_id', '=', 'companies.id')
                    ->leftJoin('addresses', 'jobs.company_id', '=', 'addresses.company_id')
                    ->select('jobs.*', 'companies.display_name as display_name', 'companies.image_logo as image_logo', 'addresses.address as sort_address')
                    ->paginate(10); // Số lượng mục trên mỗi trang, ở đây là 5
    
        // Ẩn các trường được chỉ định
        $jobs->getCollection()->transform(function ($job) use ($makeHidden) {
            $job->makeHidden($makeHidden);
            $job->is_applied = (bool) $job->is_applied;
            $job->is_salary_visible = (bool) $job->is_salary_visible;
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
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        $job->makeHidden(['company_id']);

        $job->is_applied = $job->is_applied ? true : false;
        $job->is_salary_visible = $job->is_salary_visible ? true : false;
        $job->is_edit = $job->is_edit ? true : false;



        return response()->json($job);
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
