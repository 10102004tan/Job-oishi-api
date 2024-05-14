<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBookmark extends Model
{
    use HasFactory;

    protected $table = 'jobs_bookmark';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'company_name',
        'company_logo',
        'sort_addresses',
        'salary_min',
        'salary_max',
        'is_salary_visible',
        'published',
    ];
}
