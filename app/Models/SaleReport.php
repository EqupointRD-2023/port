<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'acknowledged_by_tagOperator',
        'acknowledged_by_DeviceController',
        'acknowledged_by_Accountant',
        'acknowledged_by_StoreOfficer',
        'acknowledged_by_HeadOperation',
        'acknowledged_by_AssistanceFinanceManger',
        'acknowledged_by_GeneralManager',

    ];
}
