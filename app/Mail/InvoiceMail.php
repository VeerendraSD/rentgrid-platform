<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $pdfContent;

    public function __construct(Booking $booking, string $pdfContent)
    {
        $this->booking = $booking;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('Your RentGrid Invoice')
                    ->view('marketplace.invoice_email')
                    ->attachData($this->pdfContent, 'invoice-'. $this->booking->id .'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
