<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_email;
    public $reset_code;
    public $user_name;

    public function __construct($user_email, $reset_code, $user_name)
    {
        $this->user_email=$user_email;
        $this->reset_code=$reset_code;
        $this->user_name=$user_name;
    }

    public function build()
    {
        return $this->markdown('emails.forget_password_mail')->with([
            'user_email'=>$this->user_email,
            'reset_code'=>$this->reset_code,
            'user_name'=>$this->user_name
        ]);
    }
}
