<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Benefit extends Model
{
    use HasFactory;

    protected $fillable = [ 'value', 'icon' ];

    public function companies() : BelongsToMany {
        return $this->belongsToMany(Company::class);
    }

    public function jobs() : BelongsToMany {
        return $this->belongsToMany(Job::class);
    }
}
