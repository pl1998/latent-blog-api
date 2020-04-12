<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $email;
    private $name;

    private $code;
    private $url;
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->url = $data['url'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'latent博客邮箱注册码')
            ->subject('注册验证邮件')
            ->to($this->email)
            ->markdown('emails.user.registerEmail')
            ->with([
                'code'=>$this->code,
                'name'=>$this->name,
                'url'=>$this->url,
            ]);
    }
}
