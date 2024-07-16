<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HighWindSpeedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->opsLogData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cindy@test.com', 'Cindy')->subject($this->opsLogData[0]->airport_name . ' airport: Wind Speed > 8 knots!')->view('mail.highWindSpeed', ['mailDataLists'=> $this->opsLogData]);
    }
}
