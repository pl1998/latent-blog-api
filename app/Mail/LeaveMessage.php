<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LeaveMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $name;
    private $email;
    private $content;

    public function __construct($data)
    {
        //
        $this->email = $data['email'];
        $this->name = $data['name'];

        $this->url = $data['url'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),'latent博客留言邮件')
            ->subject('博客留言邮件')
            ->to($this->email)
            ->markdown('emails.leave.leave_notification')
            ->with([
                'name'=>$this->name,
                'email'=>$this->email,
                'content'=>$this->content,
            ]);
    }
}
