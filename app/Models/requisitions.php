<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requisitions extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisitionNumber', 'request_id', 'team_id', 'purpose', 'quantity', 'status', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'request_id', 'id');
    }

    public function dispatch()
    {
        return $this->hasOne(Dispatch::class, 'requestId', 'id');
    }

    public function dispatch_master()
    {
        return $this->hasOne(Dispatch_masters::class, 'requestId', 'id');
    }
}
