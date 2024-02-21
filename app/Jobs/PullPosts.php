<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use DateTime;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PullPosts implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $user = User::findOrFail(1);
            $httpClient = new \GuzzleHttp\Client();
            $res =  $httpClient->request('GET',"https://jsonplaceholder.typicode.com/posts/{$this->post['id']}/comments");

            $dbPost = $user->posts()->create([
                'title' => $this->post['title'],
                'body' => $this->post['body']
            ]);

            $comments = json_decode($res->getBody(),true);
            foreach($comments as $comment){
                $dbPost->comments()->create(
                    [
                        'name' => $comment['name'],
                        'email' => $comment['email'],
                        'body' => $comment['body']
                    ]
            );}


        }
        catch(Exception $e){
            $this->fail($e);
        }
    }

    public function retryUntil(): \DateTime{
        return now()->addMinutes(5);
    }
}
