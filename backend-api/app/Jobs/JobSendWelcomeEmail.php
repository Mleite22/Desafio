<?php

namespace App\Jobs;

use App\Mail\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendWelcomeEmail implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $userid)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Recupera o usuário pelo ID
        $user = User::find($this->userid);
        Mail::to($user->email)
            ->later(now()->addMinutes(), new SendWelcomeEmail($user));
    }
}
