<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportBulkUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import bulk users from csv in the database.';

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
        print("Import began... \n");
        try{
            $csvPath =  fopen(Storage::path('users_100K.csv'), 'r');
            $isFirst = true;
            $c = 0;
            while(($data = fgetcsv($csvPath)) != NULL){
                if($isFirst == true){
                    $isFirst = false;
                    continue;
                }
                User::firstOrCreate(
                    ['email' => $data[2]],
                    [
                        'first_name' => $data[0],
                        'last_name' => $data[1],
                        'phone_number' => $data[3]
                    ]
                );
            }
        }
        catch(Exception $e){
            print("Failed to db import. ");            
        }
        return 0;
    }
}
