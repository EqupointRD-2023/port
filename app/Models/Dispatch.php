<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatchNo',
        'deviceId',
        'requestId',
        'dispatcherId',
        'purpose',
        'is_returned',
        'dispatchStatus'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'dispatcherId', 'id');
    }

    public function requisition()
    {
        return $this->belongsTo(requisitions::class, 'requestId', 'id');
    }
    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'deviceId');
    }


    public function returnfromport()
    {
        return $this->hasMany(ReturnedFromPort::class, 'dispatch_id', 'id');
    }
}
