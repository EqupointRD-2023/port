<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id', 'receipt_number', 'printed_by', 'client_name', 'master', 'slaves',
        'subT1', 'truck', 'driver_name', 'passport/dl', 'cargo_type', 'agent_name', 'destination',
        'amount', 'payment_method', 'tagged_by', 'tag_area'
    ];




    protected $casts = [
        'customer_name' => 'array',
    ];


    public function webrequest()
    {
        return $this->belongsTo(WebRequest::class, 'request_id', 'id');
    }
}
