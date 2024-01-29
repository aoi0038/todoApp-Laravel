<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddTimeBot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:add-time-bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '現在時刻を書き出すBot';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
      $file = '/app/app/Console/batch_test/time.txt';
      $current = file_get_contents($file);
      
      date_default_timezone_set('Asia/Tokyo');
      $current .= date("Y-m-d H:i:s")."\n";
      
      file_put_contents($file, $current);
    }
}
