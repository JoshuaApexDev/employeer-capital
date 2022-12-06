<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class emailLead extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $lead)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->lead = $lead;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('mail.emailLead', [
            'lead' => $this->lead,
            'body' => $this->message,
            'subject' => $this->subject,
        ]);

    }
}
