<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendForgetMail extends Mailable
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
        return $this->from($address='noreply@domain.com',$name=$this->data['email_name'])
        ->subject($this->data['subject'])->view('front.Mail.sendmail')
        ->with('data',$this->data);
dd($data);
    }
}