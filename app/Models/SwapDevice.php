<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'lease_number', 'master_id', 'master_new_id', 'slave_id', 'slave_new_id'
    ];
}
