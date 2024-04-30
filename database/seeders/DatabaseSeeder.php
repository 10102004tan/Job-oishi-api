<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('jobs')->insert([
            'title' => 'Công việc 1',
            'content' => 'Nội dung công việc 1',
            'experience' => "2",
            'company_id' => 1,
            'job_type_str' => "111",
            'job_level' => 2,
            'salary_value' => true,
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 2',
            'content' => 'Nội dung công việc 2',
            'experience' => "2",
            'company_id' => 2,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_value' => false,
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 3',
            'content' => 'Nội dung công việc 3',
            'experience' => "2",
            'is_edit' => 0,
            'company_id' => "111",
            'job_level' => 2,
            'salary_value' => false,
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 4',
            'content' => 'Nội dung công việc 4',
            'experience' => "2",
            'company_id' => 3,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_value' => false,
            
        ]);
        
        DB::table('companies')->insert([
            'company_name' => 'Công ty 1',
            'company_logo' => 'logo-1.png',
            'description' => 'Mô tả công ty 1',
            'tagline' => 'Cùng nhau phát triển',
            'website' => 'a.com',
            'company_size' => 3,
            'address_region_id' => '1',
            'benifits_id' => 1,
            'number_job_opening' => 3,
            'nationallity_id' => '10'

            
        ]);
        DB::table('companies')->insert([
            'company_name' => 'Công ty 2',
            'company_logo' => 'logo-2.png',
            'description' => 'Mô tả công ty 2',
            'tagline' => 'Cùng nhau phát triển',
            'website' => 'a.com',
            'company_size' => 3,
            'address_region_id' => '1',
            'benifits_id' => 1,
            'number_job_opening' => 3,
            'nationallity_id' => '10'


        ]);
        DB::table('companies')->insert([
            'company_name' => 'Công ty 3',
            'company_logo' => 'logo-3.png',
            'description' => 'Mô tả công ty 3',
            'tagline' => 'Cùng nhau phát triển',
            'website' => 'a.com',
            'company_size' => 3,
            'address_region_id' => '1',
            'benifits_id' => 1,
            'number_job_opening' => 3,
            'nationallity_id' => '10',

        ]);

        DB::table('benifits')->insert([
            'benifit_name' => 'Lợi ích 1',
            'benifit_icon' => 'icon-1',

        ]);

        DB::table('benifits')->insert([
            'benifit_name' => 'Lợi ích 2',
            'benifit_icon' => 'icon-1',

        ]);

        DB::table('benifits')->insert([
            'benifit_name' => 'Lợi ích 3',
            'benifit_icon' => 'icon-1',

        ]);

        DB::table('benifits')->insert([
            'benifit_name' => 'Lợi ích 4',
            'benifit_icon' => 'icon-1',

        ]);
       
    }
}
