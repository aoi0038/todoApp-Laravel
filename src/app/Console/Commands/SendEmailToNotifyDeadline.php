<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Todo;
use App\Models\User;

class SendEmailToNotifyDeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:send-email-to-notify-deadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Todoの完了期限が迫っている人にメールを送信するBot';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $today = date("Y-m-d");
      $todoUserIds = Todo::where('deadline', $today)->get(['user_id'])->toArray();
      $userIds = array_unique($todoUserIds, SORT_REGULAR);
      foreach ($userIds as $userId) {
        $email = User::where('id', $userId['user_id'])->first(['email']);
        Mail::to($email['email'])->send(new TestMail());
      }
    }
}
