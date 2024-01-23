<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\AddTimeBot;
use App\Console\Commands\SendEmailToNotifyDeadline;
use App\Models\Todo;

class Kernel extends ConsoleKernel
{
    protected $commands = [
      AddTimeBot::class,
      SendEmailToNotifyDeadline::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('batch:add-time-bot')->everyMinute();
        $schedule->command('batch:send-email-to-notify-deadline')->everyMinute()->when(function() {
          $today = date("Y-m-d");
          $todos = Todo::where('deadline', $today)->get();
          if ($todos->isEmpty()) return false;
          return true;
        });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
