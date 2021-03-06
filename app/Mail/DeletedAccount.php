<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletedAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    private $emailConfig;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData, $emailConfig)
    {
        $this->emailData = $emailData;
        $this->emailConfig = $emailConfig;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      return $this->subject("Transfer account is deleted")
                  ->from($this->emailConfig['emailfromaddress'], $this->emailConfig['emailfrom'])
                  ->view('email.deletedaccount');
    }
}
