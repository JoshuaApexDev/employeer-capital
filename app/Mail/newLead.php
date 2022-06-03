<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newLead extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($lead, $date, $status)
    {
        $this->lead = $lead;
        $this->date = $date;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = [
            'Lead' => 'New lead has applied!',
            'Not Hired' => 'Lead has been rejected!',
            'Hired' => 'Lead has been hired!',
            'Training' => 'Lead has been sent for training!',
            'On floor' => 'Lead is on the floor!',
        ];

        foreach ($subject as $key => $value) {
            if ($this->status->name == $key) {
                return $this->subject($value . ' | ' . $this->lead->first_name . ' with position of: ' . $this->lead->position->position_name)->view('mail.newLead', [
                    'lead' => $this->lead,
                    'date' => $this->date,
                    'status' => $this->status,
                    'value' => $value,
                ]);

            }
        }

    }
}
