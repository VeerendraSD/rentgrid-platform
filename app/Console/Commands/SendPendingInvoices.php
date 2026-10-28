<?php

namespace App\Console\Commands;

use App\Jobs\SendInvoiceEmail;
use App\Models\Booking;
use Illuminate\Console\Command;

class SendPendingInvoices extends Command
{
    protected $signature = 'rentgrid:send-pending-invoices';
    protected $description = 'Find confirmed bookings without a sent invoice email and dispatch a job to email the PDF.';

    public function handle()
    {
        $bookings = \App\Models\Booking::where('status', 'confirmed')
            ->whereNull('invoice_sent_at')
            ->with(['invoice', 'item'])
            ->get();

        foreach ($bookings as $booking) {
            // Dispatch the email job
            SendInvoiceEmail::dispatch($booking->id);
            // Mark as sent (we create a temporary attribute; you can later add a column)
            $booking->invoice_sent_at = now();
            $booking->save();
        }

        $this->info('Dispatched '. $bookings->count() .' invoice emails.');
    }
}
