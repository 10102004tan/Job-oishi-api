<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplied extends Model
{
    use HasFactory;
    // Chỉ định tên bảng tùy chỉnh
    protected $table = 'applied_job';
    protected $fillable = [
        'job_id',
        'user_id',
    ];
}
