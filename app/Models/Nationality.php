<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nationality extends Model
{
    use HasFactory;

    public function companies() : BelongsToMany {
        return $this->BelongsToMany(Company::class, 'company_nationality');
    }
}
