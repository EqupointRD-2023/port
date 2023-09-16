<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Lease; // Replace with your actual model

class PdfController extends Controller
{
    public function generatePDF($id)
    {
        $leases = Lease::with('master', 'devices', 'customer', 'border', 'tager', 'tag')
            ->where('lease_number', $id)
            ->where('tager_id', auth()
                ->user()->id)->get()->unique('lease_number');
        $pdf = Pdf::loadView('lease.receipt', compact('leases'));
        return $pdf->stream('lease.receipt');
    }
}
