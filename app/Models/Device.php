<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'devicetype',
        'deviceNumber',
        'devicebrand',
        'status',
        'created_by'
    ];

    public function portstock()
    {
        return $this->belongsTo(PortStock::class, 'device_id', 'id');
    }


    public function leases()
    {
        return $this->belongsToMany(Lease::class, 'lease_device', 'slave_id', 'lease_id');
    }
}
