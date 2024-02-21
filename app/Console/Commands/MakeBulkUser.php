<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class MakeBulkUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create bulk users and put in Xls';

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

        print("Creating dummy data... \n");

            try{
                $users_100K = User::factory()->count(100000)->make();
                // print_r(User::factory()->count(100)->make());
                $filePath = Storage::path('users_100K.csv');
                if(file_exists($filePath))
                    unlink($filePath);

                $file_handler = fopen($filePath,'w');
                fputcsv($file_handler, ['First name', 'Last name', 'email', 'Phone number']);

                foreach($users_100K as $user){
                    fputcsv($file_handler, [$user['first_name'], $user['last_name'], $user['email'], $user['phone_number']]);
                }
                fclose($file_handler);

                print("successfully created data file at \"$filePath\". ");

            }
            catch(Exception $e){
                print("Failed to create data. ");
            }

        return 0;
    }
}
