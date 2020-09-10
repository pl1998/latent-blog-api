<?php
/**
 * Created by PhpStorm
 * User: pl
 * Date: 2020/9/10
 * Time: 17:28
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class SubscribeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $title;
    private $url;
    private $description;

    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->title = $data['title'];
        $this->url = $data['url'];
        $this->description = $data['description'];
    }

    public function build()
    {

        return $this->from(env('MAIL_USERNAME'),'订阅的文章')
            ->subject('订阅的文章')
            ->to($this->email)
            ->markdown('emails.subscribe_article')
            ->with([
                'title'=>$this->title,
                'url'=>$this->url,
                'description'=>$this->description,
                'email'=>'pltruenine@gmail.com',
            ]);


    }
}
