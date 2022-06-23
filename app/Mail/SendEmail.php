<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $email = $this->from($this->email->from_email)
        ->subject($this->email->subject)
        ->markdown('emails.send_email',['email' => $this->email]);

        // Attach email files
        foreach ($this->email->attachments->pluck('filepath') as $attachment) {
            $email->attach($attachment);
        }

        return $email;

    }
}
