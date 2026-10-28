<?php

namespace App\Console;

use App\Jobs\SendInvoiceEmail;
use App\Models\Booking;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // Every minute: expire any held bookings that passed their hold_expires_at
        $schedule->call(function () {
            \App\Models\Booking::where('status', 'held')
                ->where('hold_expires_at', '<', now())
                ->update(['status' => 'cancelled']);
        })->everyMinute();

        // After a booking is confirmed (status becomes 'confirmed'), send the invoice email.
        // We'll use an observer for that, but also schedule a fallback every 5 minutes to catch any missing.
        $schedule->command('rentgrid:send-pending-invoices')
            ->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
