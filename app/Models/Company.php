<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'display_name',
        'description',
        'image_logo',
        'website' 
     ];

    public function jobs() : HasMany {
        return $this->hasMany(Job::class);
    }

    public function benefits() : BelongsToMany {
        return $this->belongsToMany(Benefit::class);
    }

    public function address() : HasMany {
        return $this->hasMany(Address::class);
    }

    public function nationalities() : BelongsToMany {
        return $this->BelongsToMany(Nationality::class);
    }

    public function industries() : BelongsToMany {
        return $this->BelongsToMany(Industry::class, 'industry_company');
    }
}
