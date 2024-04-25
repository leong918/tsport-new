<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Container\Container;
use App\Repositories\EmailContentRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriberMail;
use App\Repositories\ProcessedJobRepository;
use Carbon\Carbon;

class ProcessSendSubscriberMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email_content_id;
    public $processed_job_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_content_id, $processed_job_id)
    {
        $this->email_content_id = $email_content_id;
        $this->processed_job_id = $processed_job_id;
    }

    public $tries = 0;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailContentRepository = new EmailContentRepository(new Container());
        $userRepository = new UserRepository(new Container());
        $processedJobRepository = new ProcessedJobRepository(new Container());
        $user_list = $userRepository->getActiveUser();
        $email_content = $emailContentRepository->find($this->email_content_id);
        $processed_job = $processedJobRepository->find($this->processed_job_id);

        foreach($user_list as $user) {
            Mail::to($user->email)->send(new SubscriberMail($user,$email_content));
        }

        // update process job table after running queue
        $processed_job->update(['end_at' => Carbon::now()]);
    }
}
