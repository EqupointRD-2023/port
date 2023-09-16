<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;



    public function lease()
    {
        return $this->hasMany(Lease::class, 'customer_id', 'id');
    }
}
