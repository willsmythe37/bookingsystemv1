<?php

namespace App\Mail;

use App\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
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

        $day = date("l", strtotime($this->booking->Booking_start));
        $timestart = date("H:i", strtotime($this->booking->Booking_start));
        $timeend = date("H:i", strtotime($this->booking->Booking_end));
        $date = date("d-m-Y", strtotime($this->booking->Booking_start));

        return $this->subject("NEW: " . $timestart . "-" . $timeend . ", on: " . $date)
                    ->view('emails.created');
    }
}
