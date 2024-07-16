<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreFlightLogEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->preFlightData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cindy@test.com', 'Cindy')->subject($this->preFlightData['opsData'][0]->airport_name . ' Pre-flight checklist not completed!')->view('mail.preflightlog', ['mailDataLists'=> $this->preFlightData]);
    }
}
