<?php

namespace App\Jobs;

use App\Repositories\UserRequestRepository;
use Carbon\Carbon;
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

    const REAL_IMAGE_PATH = 'img/transparent.gif';

    protected array $data = [];

    //region [GETTERS/SETTERS]

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }
    //endregion [GETTERS/SETTERS]

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        int    $userId,
        string  $userAgentName,
        string $ip,
        array   $headers,
        Carbon  $createdAt
    )
    {
        $this->setData([
            'user_id' => $userId,
            'user_agent_name' => $userAgentName,
            'ip' => $ip,
            'headers' => $headers,
            'created_at' => $createdAt,
        ]);
    }

    public function handle()
    {
        UserRequestRepository::log($this->data);
    }
}
