<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('job.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('job.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'company_id' => 'required',
            'job_level' => 'required'
        ]);

        $job = new Job();
        $job->fill($validated);
        $job->experience = $request['experience'];
        $job->job_type_str = $request['job_type_str'];
        $job->is_edit = $request['is_edit'];
        $job->is_salary_value = $request['is_salary_value'];
        $job->is_applied = $request['is_applied'];
        $job->save();

        return redirect()->route('jobs.index')
            ->with('success', 'Thêm nghề nghiệp mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::find($id);
        return $job;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::find($id);
        $companies = Company::all();
        return view('job.edit', ['job' => $job, 'companies' => $companies]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'company_id' => 'required',
            'job_level' => 'required'
        ]);

        $job = Job::find($id);
        $job->fill($validated);
        $job->experience = $request['experience'];
        $job->job_type_str = $request['job_type_str'];
        $job->is_edit = $request['is_edit'];
        $job->is_salary_value = $request['is_salary_value'];
        $job->is_applied = $request['is_applied'];
        $job->save();

        return redirect()->route('jobs.index')
            ->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')
            ->with('success', 'Xóa thành công!');
    }
}
