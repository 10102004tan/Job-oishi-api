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
            'salary_min' => '*',
            'salary_max' => '*'            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 2',
            'content' => 'Nội dung công việc 2',
            'experience' => "2",
            'company_id' => 2,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 3',
            'content' => 'Nội dung công việc 3',
            'experience' => "2",
            'is_edit' => 0,
            'company_id' => 1,
            'job_level' => 2,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 4',
            'content' => 'Nội dung công việc 4',
            'experience' => "2",
            'company_id' => 3,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 5',
            'content' => 'Nội dung công việc 5',
            'experience' => "2",
            'company_id' => 3,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 6',
            'content' => 'Nội dung công việc 6',
            'experience' => "2",
            'company_id' => 2,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);

        DB::table('jobs')->insert([
            'title' => 'Công việc 7',
            'content' => 'Nội dung công việc 7',
            'experience' => "2",
            'company_id' => 1,
            'job_type_str' => "111",
            'job_level' => 2,
            'salary_min' => '*',
            'salary_max' => '*'            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 8',
            'content' => 'Nội dung công việc 8',
            'experience' => "2",
            'company_id' => 2,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 9',
            'content' => 'Nội dung công việc 9',
            'experience' => "2",
            'is_edit' => 0,
            'company_id' => 1,
            'job_level' => 2,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 10',
            'content' => 'Nội dung công việc 10',
            'experience' => "2",
            'company_id' => 3,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 11',
            'content' => 'Nội dung công việc 11',
            'experience' => "2",
            'company_id' => 3,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);
        DB::table('jobs')->insert([
            'title' => 'Công việc 12',
            'content' => 'Nội dung công việc 12',
            'experience' => "2",
            'company_id' => 2,
            'job_type_str' => "111",
            'job_level' => 1,
            'salary_min' => '*',
            'salary_max' => '*'
            
        ]);

        DB::table('companies')->insert([
            'display_name' => 'GEO SYSTEM SOLUTIONS VIETNAM',
            'image_logo' => 'https://assets.topdev.vn/images/2024/04/09/TopDev-b5af9c126cd5f9f13df813192f5a66e6-1712625847.png',
            'description' => '<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">Our Parent Company: GEO HOLDINGS COPORATION (100% Japanese company)&nbsp; </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">About Us: GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. 100% Japanese company Development of internal systems used by GEO Group Contribute in all phases of software development lifecycle.</span></p>',
            'tagline' => 'CHANGE as CHANCE',
            'website' => 'a.com',
            'company_size' => "10-24",
            // 'address_region_id' => '1',
            'num_job_openings' => 3,
            'nationality_id' => '10'

            
        ]);
        DB::table('companies')->insert([
            'display_name' => 'GEO SYSTEM SOLUTIONS VIETNAM',
            'image_logo' => 'https://assets.topdev.vn/images/2024/04/09/TopDev-b5af9c126cd5f9f13df813192f5a66e6-1712625847.png',
            'description' => '<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">Our Parent Company: GEO HOLDINGS COPORATION (100% Japanese company)&nbsp; </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">About Us: GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. 100% Japanese company Development of internal systems used by GEO Group Contribute in all phases of software development lifecycle.</span></p>',
            'tagline' => 'CHANGE as CHANCE',
            'website' => 'a.com',
            'company_size' => '10-24',
            // 'address_region_id' => '1',
            'num_job_openings' => 3,
            'nationality_id' => '10'


        ]);
        DB::table('companies')->insert([
            'display_name' => 'GEO SYSTEM SOLUTIONS VIETNAM',
            'image_logo' => 'https://assets.topdev.vn/images/2024/04/09/TopDev-b5af9c126cd5f9f13df813192f5a66e6-1712625847.png',
            'description' => '<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">Our Parent Company: GEO HOLDINGS COPORATION (100% Japanese company)&nbsp; </span></p>\r\n<p style=\"text-align: justify;\"><span style=\"font-family: Roboto, Helvetica, Verdana, Arial, sans-serif; font-size: 15px;\">About Us: GEO SYSTEM SOLUTIONS VIETNAM CO., LTD. 100% Japanese company Development of internal systems used by GEO Group Contribute in all phases of software development lifecycle.</span></p>',
            'tagline' => 'CHANGE as CHANCE',
            'website' => 'a.com',
            'company_size' => '10-24',
            // 'address_region_id' => '1',
            'num_job_openings' => 3,
            'nationality_id' => '10',

        ]);
        

        DB::table('benefits')->insert([
            'value' => 'Mức lương và thưởng cạnh tranh.',
            'icon' => 'fa-money',

        ]);

        DB::table('benefits')->insert([
            'value' => 'Làm việc trong môi trường quốc tế, năng động, chuyên nghiệp, có nhiều cơ hội để phát triển nghề nghiệp.',
            'icon' => 'fa-globe',

        ]);

        DB::table('benefits')->insert([
            'value' => 'Công ty hỗ trợ toàn bộ chi phí Visa',
            'icon' => 'fa-diamond',

        ]);

        DB::table('benefits')->insert([
            'value' => 'Các khóa đào tạo nội bộ về Kỹ thuật & Kỹ năng mềm',
            'icon' => 'fa-book',

        ]);

        DB::table('addresses')->insert([
            'company_id' => 1,
            'address' => '53 Võ Văn Ngân, TP. Thủ Đức, TP. Hồ Chí Minh',
            // 'district' => 'TP. Thủ Đức',
            // 'province' => 'TP. Hồ Chí Minh'

        ]);

        DB::table('addresses')->insert([
            'company_id' => 2,
            'address' => 'Quận Bình Thạnh, TP. Hồ Chí Minh',
            // 'district' => 'TP. Thủ Đức',
            // 'province' => 'TP. Hồ Chí Minh'

        ]);

        DB::table('addresses')->insert([
            'company_id' => 3,
            'address' => 'Quận 1, TP. Hồ Chí Minh',
            // 'district' => 'TP. Thủ Đức',
            // 'province' => 'TP. Hồ Chí Minh'

        ]);

        DB::table('addresses')->insert([
            'company_id' => 4,
            'address' => 'TP. Thủ Đức, TP. Hồ Chí Minh',
            // 'district' => 'TP. Thủ Đức',
            // 'province' => 'TP. Hồ Chí Minh'

        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 1,
            'benefit_id' => 1
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 1,
            'benefit_id' => 2
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 2,
            'benefit_id' => 2
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 3,
            'benefit_id' => 1
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 3,
            'benefit_id' => 2
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 3,
            'benefit_id' => 3
        ]);

        DB::table('benefit_company')->insert([
            'company_id' => 3,
            'benefit_id' => 4
        ]);
       
    }
}
