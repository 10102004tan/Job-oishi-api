<?php

namespace App\Http\Controllers;

use App\Models\JobApplied;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppliedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->id;
        //Query the applied jobs with the required fields
        $appliedJobs = DB::table('applied_job')
        ->join('jobs', 'applied_job.job_id', '=', 'jobs.id')
        ->join('companies', 'jobs.company_id', '=', 'companies.id')
        ->join('addresses', 'companies.id', '=', 'addresses.company_id')
        ->where('applied_job.user_id', $userId)
        ->select(
            'applied_job.job_id as id',
            'applied_job.user_id',
            'jobs.title',
            'companies.display_name as company_name',
            'companies.image_logo as company_logo',
            DB::raw('GROUP_CONCAT(addresses.province ORDER BY addresses.province ASC SEPARATOR ", ") as sort_addresses'),
            'jobs.is_salary_visible',
            'jobs.created_at'
        )
        ->groupBy(
            'applied_job.job_id',
            'applied_job.user_id',
            'jobs.title',
            'companies.display_name',
            'companies.image_logo',
            'jobs.is_salary_visible',
            'jobs.created_at'
        )
        ->get();



        // Truncate fields to 30 characters and append "..." if longer


        //Return the result as a JSON response
        if ($appliedJobs->isEmpty()) {
            return [];
        } else {
            $appliedJobs->transform(function ($job) {
                $job->title = $this->truncateWithEllipsis($job->title, 30);
                $job->company_name = $this->truncateWithEllipsis($job->company_name, 30);
                $job->sort_addresses = $this->truncateWithEllipsis($job->sort_addresses, 30);
                $job->is_salary_visible = (bool) $job->is_salary_visible;
                $job->published = $this->formatTimeDifference($job->created_at);
                return $job;
            });
            return $appliedJobs;
        }
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
        $appliedJob = new JobApplied();
        $appliedJob->job_id = $request['job_id'];
        $appliedJob->user_id = $request['user_id'];

        // Lưu trữ dữ liệu
        if ($appliedJob->save()) {
            // Trả về phản hồi thành công nếu lưu trữ thành công
            return response()->json([
                'message' => 'Applied successfully',
                'title' => $request['title']
            ], 200); // HTTP 200: OK
        } else {
            // Trả về phản hồi lỗi nếu lưu trữ thất bại
            return response()->json([
                'message' => 'Failed to apply for job',
            ], 500); // HTTP 500: Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
    }

    private function truncateWithEllipsis($string, $length)
    {
        if (strlen($string) > $length) {
            return substr($string, 0, $length - 3) . '...';
        }
        return $string;
    }

    // Define the formatTimeDifference function
    private function formatTimeDifference($timestamp)
    {
        $givenDate = Carbon::parse($timestamp);
        $now = Carbon::now();

        if ($givenDate->diffInDays($now) >= 1) {
            return $givenDate->diffForHumans($now, CarbonInterface::DIFF_RELATIVE_TO_NOW); // Ví dụ: "1 ngày trước"
        } else if ($givenDate->diffInHours($now) >= 1) {
            return $givenDate->diffForHumans($now, CarbonInterface::DIFF_RELATIVE_TO_NOW); // Ví dụ: "2 giờ trước"
        } else {
            return "Vừa xong"; // Hoặc một chuỗi khác tùy ý
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
