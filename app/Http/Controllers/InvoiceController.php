<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function download(Booking $booking)
    {
        $booking->load(['item', 'units', 'invoice']);
        $pdf = Pdf::loadView('marketplace.invoice', compact('booking'));
        return $pdf->download('invoice-'. $booking->id .'.pdf');
    }
}
