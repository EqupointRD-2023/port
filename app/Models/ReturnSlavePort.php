<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnSlavePort extends Model
{
    use HasFactory;

    protected $fillable = [

        'slave_id',
        'master_id',
    ];
}
