<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch_slaves extends Model
{
    use HasFactory;

    public function dispatch_slave()
    {
        return $this->belongsTo(Dispatch_masters::class, 'dispatch_master_id', 'id');
    }

    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'slave_id');
    }
}
