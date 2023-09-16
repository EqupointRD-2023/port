<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Border extends Model
{
    use HasFactory;


    public function lease()
    {
        return $this->hasMany(Lease::class, 'border_id', 'id');
    }
}
