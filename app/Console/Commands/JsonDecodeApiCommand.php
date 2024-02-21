<?php

namespace App\Console\Commands;

use App\Jobs\CreatePostsJob;
use App\Jobs\DispatchPostsJob;
use App\Jobs\PullPosts;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class JsonDecodeApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hit:jsonPlaceholderApi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Begin posts and comments fetching';

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
     * @return int
     */
    public function handle()
    {
        // try
        // {
        // }
        // catch(Exception $e){
        //     print($e->getMessage());
        //     $this->fail($e);
        // }
        print("Starting all posts fetching call, ... \n ");

        $postsJob = [];
        $httpClient = new \GuzzleHttp\Client();
        $res = $httpClient->request('GET',"https://jsonplaceholder.typicode.com/posts");

        if($res->getStatusCode() == 200){
            $posts = json_decode($res->getBody(),true);
            foreach($posts as $post){
                $postsJob[] = new PullPosts($post);
            }
        }

        Bus::batch($postsJob)
                ->then(function(){
                    print("All jobs executed successfully..");
                })->onQueue('importer')->dispatch();

        print(count($postsJob). " dispatched successfully");

    }
}
