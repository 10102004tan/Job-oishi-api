<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplied extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'company_id',
        'company_name',
        'company_logo',
        'sort_addresses',
        'is_applied',
        'is_salary_visible',
        'published',
    ];
}
