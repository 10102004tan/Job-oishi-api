<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Job extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'title', 'company_id', 'job_level', 'is_salary_value', 'is_applied', 'experience', 'is_edit'];

    protected $casts = [
        'is_salary_visible' => 'boolean',
    ];

    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function benefits() : BelongsToMany {
        return $this->belongsToMany(Benefit::class);
    }

}
