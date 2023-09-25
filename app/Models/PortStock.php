<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortStock extends Model
{
    use HasFactory;

    public $fillable = [
        'device_id', 'user_id', 'status', 'last_status', 'status_updated_at',
    ];

    public function device()
    {
        return $this->hasMany(Device::class, 'id', 'device_id');
    }
}
