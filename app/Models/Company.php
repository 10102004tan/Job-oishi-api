<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
    use HasFactory;

    protected $fillable = [ 'company_name',
    'description',
    'company_image',
    'website' ];

    public function jobs() : HasMany {
        return $this->hasMany(Job::class);
    }

    public function benifits() : BelongsToMany {
        return $this->belongsToMany(Benifit::class);
    }
}
