<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'street', 'ward', 'district', 'province'];
    public function company() : BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function job() : BelongsTo {
        return $this->belongsTo(Job::class);
    }

}
