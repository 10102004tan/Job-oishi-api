<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppliedJobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Bảng Job applied
        DB::table('applied_job')->insert([
            [
                'job_id' => 3300,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 3295,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 3294,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 3205,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Bảng skills
        DB::table('skills')->insert([
            [
                'skill_name' => 'JavaScript',
            ],
            [
                'skill_name' => 'Python',
            ],
            [
                'skill_name' => 'Java',
            ],
            [
                'skill_name' => 'C++',
            ],
            [
                'skill_name' => 'PHP',
            ],
            [
                'skill_name' => 'SQL',
            ],
            [
                'skill_name' => 'HTML/CSS',
            ],
            [
                'skill_name' => 'Ruby on Rails',
            ],
            [
                'skill_name' => 'React',
            ],
            [
                'skill_name' => 'Angular',
            ],
            [
                'skill_name' => 'Node.js',
            ],
            [
                'skill_name' => 'Swift',
            ],
            [
                'skill_name' => 'Kotlin',
            ],
            [
                'skill_name' => 'Docker',
            ]
        ]);

        // Bảng skill_job
        DB::table('skill_job')->insert([
            // Project Manager - Percas Game Studio
            ['skill_id' => 1, 'job_id' => 3300], // JavaScript
            ['skill_id' => 2, 'job_id' => 3300], // Python
            ['skill_id' => 3, 'job_id' => 3300], // Java
        
            // Sr. Physical Design Engineer - Talent Success
            ['skill_id' => 4, 'job_id' => 3295], // C++
            ['skill_id' => 5, 'job_id' => 3295], // PHP
        
            // Business Analyst (ServiceNow) - Talent Success
            ['skill_id' => 6, 'job_id' => 3294], // SQL
            ['skill_id' => 7, 'job_id' => 3294], // HTML/CSS
            ['skill_id' => 8, 'job_id' => 3294], // Ruby on Rails
        
            // Senior UI/UX Designer - Zalo
            ['skill_id' => 9, 'job_id' => 3205], // React
            ['skill_id' => 10, 'job_id' => 3205], // Angular
            ['skill_id' => 11, 'job_id' => 3205], // Node.js
        ]);
        
        // Bảng benifist
        DB::table('benefits')->insert([
            [
                'value' => 'Health Insurance',
                'icon' => 'fas fa-heartbeat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'value' => 'Paid Time Off',
                'icon' => 'fas fa-plane',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'value' => 'Work From Home',
                'icon' => 'fas fa-home',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'value' => 'Retirement Plan',
                'icon' => 'fas fa-piggy-bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'value' => 'Gym Membership',
                'icon' => 'fas fa-dumbbell',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Bang job_benefit
        DB::table('benefit_job')->insert([
            // Lợi ích cho Project Manager - Percas Game Studio
            ['job_id' => 3300, 'benefit_id' => 1], // Health Insurance
            ['job_id' => 3300, 'benefit_id' => 2], // Paid Time Off
        
            // Lợi ích cho Sr. Physical Design Engineer - Talent Success
            ['job_id' => 3295, 'benefit_id' => 3], // Work From Home
            ['job_id' => 3295, 'benefit_id' => 4], // Retirement Plan
        
            // Lợi ích cho Business Analyst (ServiceNow) - Talent Success
            ['job_id' => 3294, 'benefit_id' => 1], // Health Insurance
            ['job_id' => 3294, 'benefit_id' => 3], // Work From Home
        
            // Lợi ích cho Senior UI/UX Designer - Zalo
            ['job_id' => 3205, 'benefit_id' => 2], // Paid Time Off
            ['job_id' => 3205, 'benefit_id' => 5], // Gym Membership
        ]);
        
        //Bang Nationanities
        DB::table('nationalities')->insert([
            [
                'national' => 'Vietnam',
                'flag' => 'https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'United States',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'Canada',
                'flag' => 'https://upload.wikimedia.org/wikipedia/commons/c/cf/Flag_of_Canada.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'United Kingdom',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'Japan',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/9/9e/Flag_of_Japan.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'Germany',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/b/ba/Flag_of_Germany.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'France',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/c/c3/Flag_of_France.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'Australia',
                'flag' => 'https://upload.wikimedia.org/wikipedia/commons/b/b9/Flag_of_Australia.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'Brazil',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/0/05/Flag_of_Brazil.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'national' => 'India',
                'flag' => 'https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('job_nationality')->insert([
            [
                'nationality_id' => 1, // ID của quốc gia Vietnam
                'job_id' => 3300, // ID của công việc Project Manager
            ],
            [
                'nationality_id' => 2, // ID của quốc gia United States
                'job_id' => 3300, // ID của công việc Project Manager
            ],

            [
                'nationality_id' => 3, // ID của quốc gia Vietnam
                'job_id' => 3295, // ID của công việc Project Manager
            ],
            [
                'nationality_id' => 4, // ID của quốc gia United States
                'job_id' => 3294, // ID của công việc Project Manager
            ],
        ]);
        
        
    }
}
