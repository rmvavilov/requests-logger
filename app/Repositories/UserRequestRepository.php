<?php

namespace App\Repositories;

use App\Models\UserRequest;

class UserRequestRepository
{
    public static function log(array $data) : UserRequest
    {
        $userAgent = UserAgentRepository::getModel($data['user_agent_name'] ?? '');

        return UserRequestRepository::create([
            'user_id' => $data['user_id'] ?? null,
            'user_agent_id' => $userAgent->id,
            'ip' => $data['ip'] ?? '',
            'headers' => json_encode($data['headers'] ?? []),
            'created_at' => $data['created_at']
        ]);
    }

    public static function create(array $attributes): UserRequest
    {
        return UserRequest::query()->create($attributes);
    }
}
