<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    use HasFactory;

    protected $casts = [
        'slave_id' => 'array',
    ];

    protected $fillable = [
        'master_id', 'slave_id', 'tager_id', 'tag_id', 'border_id', 'team_id', 'pricetype',
        'master_price', 'slave_price', 'ack_status', 'ack_comment', 'driver_name', 'driver_phone',
        'driver_licence', 'driver_licence', 'lease_number', 'It_number', 'lease_type', 'chasis_number',
        'customer_name', 'brand', 'customer_id', 'truck_number', 'trailer_number', 'cargo_type',
    ];

    public function master()
    {
        return $this->belongsTo(Device::class, 'master_id', 'id');
    }

    public function slave()
    {
        return $this->belongsTo(Device::class, 'slave_id', 'id');
    }

    public function border()
    {
        return $this->belongsTo(Border::class, 'border_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id', 'id');
    }

    public function tager()
    {
        return $this->belongsTo(User::class, 'tager_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(TagPoints::class, 'tag_id', 'id');
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class, 'lease_slaves', 'lease_id', 'slave_id');
    }

    public function lease_master()
    {
        return $this->belongsTo(Dispatch_masters::class, 'master_id', 'master_id');
    }

    public function lease_master2()
    {
        return $this->belongsTo(PortStock_masters::class, 'master_id', 'master_id');
    }
}
