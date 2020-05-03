<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class leaveMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $params;

    public function __construct($params)
    {
        //
        $this->params = $params;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $params = $this->params;

        return $this->from(env('MAIL_USERNAME'),$params['name'].'@'.$params['email'])
            ->subject('博客留言邮件')
            ->to(env('MAIL_LEAVN'))
            ->markdown('emails.leave.leave_notification')
            ->with([
                'name'=>$params['name'],
                'email'=>$params['email'],
                'content'=>$params['content'],
            ]);


    }
}
