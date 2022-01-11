<?php

namespace App\Jobs;

use App\Helpers\Logger;
use App\Models\UserRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RequestLogger implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Logger $logger;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        UserRequest::log($this->logger);
    }
}
