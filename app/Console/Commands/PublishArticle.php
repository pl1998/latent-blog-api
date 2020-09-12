<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class PublishArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pub:Msg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $push;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($push)
    {
        $this->push = $push;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //推送到订阅的频道
        $client = env('REDIS_CLIENT_SUBSCRIBE');

        Redis::connection()->publish("$client",json_encode($this->push,JSON_UNESCAPED_UNICODE));
    }
}
