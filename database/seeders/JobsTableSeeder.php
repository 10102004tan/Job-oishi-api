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
                'company_id' => 94708,
                'skills' => json_encode([78, 199, 5334]),
                'experience' => '5+ years',
                'requirements' => 'Relevant project management experience',
                'responsibilities' => 'Oversee project timelines and deliverables',
                'job_type_str' => 'Full-time',
                'job_level' => 3,
                'recruitment_process' => 'Interview and assessment',
                'salary_value' => '1******* - 1******* VND',
                'is_salary_visible' => false,
                'is_applied' => false,
                'benefit_id' => null,
                'is_edit' => true,
            ],
            [
                'id' => 3295,
                'title' => 'Sr. Physical Design Engineer _TS030101-PhDesign',
                'content' => 'Senior Physical Design Engineer at Talent Success',
                'company_id' => 92937,
                'skills' => json_encode([8353]),
                'experience' => '8+ years',
                'requirements' => 'Experience in physical design engineering',
                'responsibilities' => 'Design and implement physical systems',
                'job_type_str' => 'Full-time',
                'job_level' => 4,
                'recruitment_process' => 'Multiple interview stages',
                'salary_value' => '',
                'is_salary_visible' => false,
                'is_applied' => false,
                'benefit_id' => null,
                'is_edit' => true,
            ],
            [
                'id' => 3294,
                'title' => 'REMOTE HOT JOBS - Business Analyst (ServiceNow)',
                'content' => 'Remote Business Analyst position for Talent Success',
                'company_id' => 92937,
                'skills' => json_encode([8001, 8172, 7999]),
                'experience' => '3+ years',
                'requirements' => 'Experience with ServiceNow',
                'responsibilities' => 'Analyze business requirements and implement solutions',
                'job_type_str' => 'Remote',
                'job_level' => 2,
                'recruitment_process' => 'Online interview',
                'salary_value' => '',
                'is_salary_visible' => false,
                'is_applied' => false,
                'benefit_id' => null,
                'is_edit' => true,
            ],
            [
                'id' => 3205,
                'title' => 'Senior UI/UX Designer, ZVAS',
                'content' => 'Senior UI/UX Designer at Zalo',
                'company_id' => 66848,
                'skills' => json_encode([8032, 8275]),
                'experience' => '6+ years',
                'requirements' => 'Strong UI/UX design portfolio',
                'responsibilities' => 'Design user interfaces and experiences',
                'job_type_str' => 'Full-time',
                'job_level' => 4,
                'recruitment_process' => 'Portfolio review and interview',
                'salary_value' => 'Negotiable',
                'is_salary_visible' => true,
                'is_applied' => false,
                'benefit_id' => null,
                'is_edit' => true,
            ],
        ]);
    }
}
