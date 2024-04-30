<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Benifit extends Model
{
    use HasFactory;

    protected $fillable = [ 'benifit_name', 'benifit_icon' ];

    public function companies() : BelongsToMany {
        return $this->belongsToMany(Company::class);
    }
}
