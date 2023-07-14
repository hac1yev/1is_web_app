<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVac  extends Mailable
{
    use Queueable, SerializesModels;
    protected  $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data= $data;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@domain.com', $this->data['email_name'])
        ->subject($this->data['subject'])
        ->view('front.Mail.sendvac')
        ->with('data', $this->data);
    }
}