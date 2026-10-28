<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Mail\InvoiceMail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendInvoiceEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $bookingId;

    public function __construct(int $bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function handle()
    {
        $booking = Booking::with(['item', 'invoice'])->find($this->bookingId);
        if (! $booking) {
            return; // booking might have been deleted/cancelled
        }

        // Generate PDF content (as string)
        $pdf = Pdf::loadView('marketplace.invoice', compact('booking'));
        $pdfContent = $pdf->output();

        // Send mail (MAIL_MAILER is set to log, so it will appear in the log)
        Mail::to($booking->customer_email)
            ->send(new InvoiceMail($booking, $pdfContent));
    }
}
