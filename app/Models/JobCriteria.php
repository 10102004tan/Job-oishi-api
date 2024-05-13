<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobCriteria extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'id', 'create_time', 'job_postion', 'job_location', 'job_salary', 'working_form', 'is_remote'];

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
