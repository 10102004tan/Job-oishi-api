<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Job extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'title', 'company_id', 'job_level', 'is_salary_value', 'is_applied', 'experience', 'is_edit'];

    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
