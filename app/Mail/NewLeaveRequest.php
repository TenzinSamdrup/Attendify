<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Leave;

class NewLeaveRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;

    /**
     * Create a new message instance.
     *
     * @param Leave $leave
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Leave Request Submitted')
                    ->view('emails.leave-request-notification');
    }
}
