<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortStock_masters extends Model
{
    use HasFactory;

    public $fillable = [
        'master_id', 'user_id', 'status',
    ];

    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'master_id');
    }

    public function dispatch_slave()
    {
        return $this->hasMany(PortStock_slaves::class, 'port_master_id', 'id');
    }
}
