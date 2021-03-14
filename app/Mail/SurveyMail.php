<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SurveyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailDetails)
    {
        $this->mailDetails = $mailDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        // for some reason sender email isn't reflecting in my inbox, hence the logic below
        $nameAndEmail = $this->mailDetails['senderName']." "."[".$this->mailDetails['senderEmail']."]";
        return $this->from($this->mailDetails['senderEmail'], $nameAndEmail)->subject('Feedback for app!')->view("emails.viewEmails");
    }
}
