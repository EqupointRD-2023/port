<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch_masters extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function lease()
    {
        return $this->hasMany(Lease::class, 'master_id', 'master_id');
    }

    public function dispatch_slave()
    {
        return $this->hasMany(Dispatch_slaves::class, 'dispatch_master_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'dispatcherId', 'id');
    }

    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'master_id');
    }

    public function requisition()
    {
        return $this->belongsTo(requisitions::class, 'requestId', 'id');
    }
}
