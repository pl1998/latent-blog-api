<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TopicsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $email;
    private $name;
    private $url;
    private $content;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->url = $data['url'];
        $this->content = $data['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_USERNAME'),$this->name.'评论了你的文章~')
            ->subject('你的文章有人评论啦!')
            ->to('2540463097@qq.com')
            ->markdown('emails.topic.topic_send')
            ->with([
                'name'=>$this->name,
                'url'=>$this->url,
                'content'=>$this->content,
                'email'=>$this->email,
            ]);
    }
}
