<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyVoteReport extends Mailable
{
    use Queueable, SerializesModels;

    public $voteTotals;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($voteTotals)
    {
        $this->voteTotals = $voteTotals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.daily_vote_report')
            ->with('voteTotals', $this->voteTotals);
    }
}
