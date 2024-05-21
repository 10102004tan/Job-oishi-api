<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {

        DB::table('addresses')->insert([
            [
                'company_id' => 708,
                'street' => null,
                'ward' => null,
                'district' => 'Quận Cầu Giấy',
                'province' => 'Thành phố Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 937,
                'street' => null,
                'ward' => null,
                'district' => null,
                'province' => 'Thành phố Hồ Chí Minh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 937,
                'street' => null,
                'ward' => null,
                'district' => null,
                'province' => 'Thành phố Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 937,
                'street' => null,
                'ward' => null,
                'district' => null,
                'province' => 'Thành phố Đà Nẵng',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 848,
                'street' => null,
                'ward' => null,
                'district' => 'Quận 2',
                'province' => 'Thành Phố Hồ Chí Minh',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        


        DB::table('companies')->insert([
            [
                'id' => 708,
                'display_name' => 'Percas Game Studio',
                'image_logo' => 'https://assets.topdev.vn/images/2024/05/17/TopDev-0398038a96b514bb8c3bceb0f7d9c516-1715919501.jpg',
                'description' => 'Percas Game Studio is a leading game development studio...',
                'website' => 'https://percas.com',
                'tagline' => 'Innovate Your Gaming Experience',
                'company_size' => '50-100 employees',
                'num_job_openings' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 937,
                'display_name' => 'Talent Success',
                'image_logo' => 'https://assets.topdev.vn/images/2022/04/21/TopDev-logoQjyw0fHIO2WnLeDsxyGfYomv5J0yPJcN-1650530733.png',
                'description' => 'Talent Success is dedicated to connecting top talent with leading companies...',
                'website' => 'https://talentsuccess.com',
                'tagline' => 'Your Success, Our Commitment',
                'company_size' => '100-200 employees',
                'num_job_openings' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 848,
                'display_name' => 'Zalo',
                'image_logo' => 'https://assets.topdev.vn/images/2021/06/02/logocgwp0vcMtjvMCqBB95tzmMUqXFt0XwE7-ua6Tb.png',
                'description' => 'Zalo is a leading communication platform in Vietnam...',
                'website' => 'https://zalo.me',
                'tagline' => 'Connect to the Future',
                'company_size' => '500-1000 employees',
                'num_job_openings' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
