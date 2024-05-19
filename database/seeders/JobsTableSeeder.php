<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('jobs')->insert([
            [
                'id' => 3300,
                'title' => 'Project Manager',
                'content' => 'Manage projects at Percas Game Studio',
                'requirements' => 'Relevant project management experience',
                'responsibilities' => 'Oversee project timelines and deliverables',
                'company_id' => 708,
                'experience' => '5+ years',
                'job_type_str' => 'Full-time',
                'job_level' => "Junior, Middle, Senior",
                'recruitment_process' => 'Interview and assessment',
                'is_salary_visible' => false,
                'salary_value' => '1******* - 1******* VND',
                'is_edit' => true,
                'is_applied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3295,
                'title' => 'Sr. Physical Design Engineer _TS030101-PhDesign',
                'content' => 'Senior Physical Design Engineer at Talent Success',
                'requirements' => 'Experience in physical design engineering',
                'responsibilities' => 'Design and implement physical systems',
                'company_id' => 937,
                'experience' => '8+ years',
                'job_type_str' => 'Full-time',
                'job_level' => "Junior, Middle",
                'recruitment_process' => 'Multiple interview stages',
                'is_salary_visible' => false,
                'salary_value' => '',
                'is_edit' => true,
                'is_applied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3294,
                'title' => 'REMOTE HOT JOBS - Business Analyst (ServiceNow)',
                'content' => 'Remote Business Analyst position for Talent Success',
                'requirements' => 'Experience with ServiceNow',
                'responsibilities' => 'Analyze business requirements and implement solutions',
                'company_id' => 937,
                'experience' => '3+ years',
                'job_type_str' => 'Remote',
                'job_level' => "Junior, Middle, Senior",
                'recruitment_process' => 'Online interview',
                'is_salary_visible' => false,
                'salary_value' => '',
                'is_edit' => true,
                'is_applied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3205,
                'title' => 'Senior UI/UX Designer, ZVAS',
                'content' => 'Senior UI/UX Designer at Zalo',
                'requirements' => 'Strong UI/UX design portfolio',
                'responsibilities' => 'Design user interfaces and experiences',
                'company_id' => 848,
                'experience' => '6+ years',
                'job_type_str' => 'Full-time',
                'job_level' => "Middle, Senior",
                'recruitment_process' => 'Portfolio review and interview',
                'is_salary_visible' => true,
                'salary_value' => 'Negotiable',
                'is_edit' => true,
                'is_applied' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
