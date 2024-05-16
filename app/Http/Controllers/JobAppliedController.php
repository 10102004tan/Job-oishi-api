<?php

namespace App\Http\Controllers;

use App\Models\JobApplied;
use Illuminate\Http\Request;

class JobAppliedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobApplied = JobApplied::all();
        return $jobApplied;
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
        $jobApplied = new JobApplied();
        $jobApplied->id = $request['id'];
        $jobApplied->user_id = $request['user_id'];
        $jobApplied->title = $request['title'];
        $jobApplied->company_id = $request['company_id'];
        $jobApplied->company_logo = $request['company_logo'];
        $jobApplied->sort_addresses = $request['sort_addresses'];
        $jobApplied->is_applied = $request['is_applied'];
        $jobApplied->is_salary_visible = $request['is_salary_visible'];
        $jobApplied->published = $request['published'];
        

        // $jobApplied->save();

        return response()->json([
            'message' => 'Applied successfully',
            'title' =>  $request['title']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
