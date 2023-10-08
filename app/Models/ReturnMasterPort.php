<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnMasterPort extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_number',
        'return_user_id',
        'master_id',
    ];
}
