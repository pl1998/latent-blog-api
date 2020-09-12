<?php

namespace App\Console\Commands;

use App\Mail\SubscribeEmail;
use App\Models\SubscribeModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SubscribeArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sub:Msg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $subscribe;
    protected $msg;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($subscribe,$msg)
    {
        $this->subscribe = $subscribe;
        $this->msg       = $msg;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = env('REDIS_CLIENT_SUBSCRIBE');
        Redis::connection()->subscribe(["$client"],function ($msg){
            //消费订阅
            $data = json_decode($msg,true);
            //开始消费
            foreach ($this->subscribe as $value) {
                $data['email'] = $value->email;
                Mail::send(new SubscribeEmail($data));
            }
        });
    }
}
