<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking: ' . $this->booking->tour->name)
                    ->view('emails.booking-submitted', [
                        'booking' => $this->booking
                    ]);
    }
}
