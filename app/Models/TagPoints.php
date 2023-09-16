<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPoints extends Model
{
    use HasFactory;


    public function lease()
    {
        return $this->hasMany(Lease::class, 'tag_id', 'id');
    }
}
