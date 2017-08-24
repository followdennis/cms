<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use Illuminate\Console\Command;

class MultiThreadText extends Command
{
    private $totalPageCount;
    private $counter        = 1;
    private $concurrency    = 20;  // 同时并发抓取
    private $users = ['CycloneAxe', 'appleboy', 'Aufree', 'lifesign',
        'overtrue', 'zhengjinghua', 'NauxLiu'];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multithread:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '爬虫速度测试';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $start = microtime(true);
        $client = new Client();

        $requests = function ($total) use ($client) {
           for( $i = 0; $i< $total ; $i++){
//                $uri = 'https://api.github.com/users/' . $user;
                $uri = 'https://www.hao123.com/';
                yield function() use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }
        };
        $pool = new Pool($client, $requests(100), [
            'concurrency' => $this->concurrency,
            'fulfilled'   => function ($response, $index){
                $res = $response->getBody()->getContents();
                echo $res;
                $this->countedAndCheckEnded();
            },
            'rejected' => function ($reason, $index){
                $this->error("rejected" );
                $this->error("rejected reason: " . $reason );
                $this->countedAndCheckEnded();
            },
        ]);
        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();
        $end = microtime(true);
        $this->info(round(($end-$start),2)) ;
    }

    public function countedAndCheckEnded()
    {
        if ($this->counter < $this->totalPageCount){
            $this->counter++;
            return;
        }
        $this->info("请求结束！");
    }
}
