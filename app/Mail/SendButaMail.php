<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendButaMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $datam;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($datam)
    {
        $this->datam = $datam;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->from($address='noreply@domain.com',$name=$this->datam['email_name'])
        ->subject($this->datam['subject'])->view('front.Mail.sendbuta')
        ->with('datam',$this->datam);
dd($datam);
    }


}