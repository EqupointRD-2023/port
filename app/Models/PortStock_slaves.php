<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortStock_slaves extends Model
{
    use HasFactory;

    public $fillable = [
        'slave_id', 'port_master_id',
    ];

    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'slave_id');
    }

    public function dispatch_master()
    {
        return $this->belongsTo(PortStock_masters::class, 'port_master_id', 'id');
    }
}
