<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebRequest extends Model
{
    use HasFactory;

    protected $fillable = ['requestName'];

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'request_id', 'id');
    }
}
