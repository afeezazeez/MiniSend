<?php

namespace App\Jobs;

use App\Helpers\Logger;
use Carbon\Carbon;
use App\Models\Email;
use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        try {
            if (Mail::to($this->email->to_email)->send(new SendEmail($this->email))) {
                $this->email->update(['status' => Email::EMAIL_SENT_STATUS]);
            }
        } catch (\Exception $e) {
            $this->email->update(['status' => Email::EMAIL_FAILED_STATUS, 'failed_reason' => $e->getMessage()]);
            Logger::logError($e);
        }

    }
}
