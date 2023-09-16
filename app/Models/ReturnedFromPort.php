<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnedFromPort extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_id', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class, 'dispatch_id', 'id');
    }
}
