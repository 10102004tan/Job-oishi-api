<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('keywords')->insert([
            [
                'name' => 'Frontend Developer',
                'keyword' => 'frontend'
            ],
            [
                'name' => 'Backend Developer',
                'keyword' => 'backend'
            ],
            [
                'name' => 'Java Developer',
                'keyword' => 'java'
            ],
            [
                'name' => 'PHP Developer',
                'keyword' => 'php'
            ],
            [
                'name' => 'AI',
                'keyword' => 'ai'
            ],
            [
                'name' => 'CMS',
                'keyword' => 'cms'
            ],
            [
                'name' => 'NextJS Developer',
                'keyword' => 'nextjs'
            ],
            [
                'name' => 'Android Developer',
                'keyword' => 'android'
            ],
            [
                'name' => 'Kotlin Developer',
                'keyword' => 'kotlin'
            ],
            [
                'name' => 'ReactJS Developer',
                'keyword' => 'react'
            ],
            [
                'name' => 'Angula Developer',
                'keyword' => 'angula'
            ],
            [
                'name' => '.NET Developer',
                'keyword' => 'net'
            ],
        ]);
        
    }
}
