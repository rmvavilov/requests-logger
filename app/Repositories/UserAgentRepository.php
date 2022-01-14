<?php

namespace App\Repositories;

use App\Models\UserAgent;

class UserAgentRepository
{
    /**
     * @param string $userAgentString
     * @return UserAgent
     */
    public static function getModel(string $userAgentString): UserAgent
    {
        $userAgentString = trim($userAgentString);
        /* @var UserAgent $userAgent */
        $userAgent = UserAgent::query()->where('name', $userAgentString)->first();

        if ($userAgent) {
            return $userAgent;
        }

        $fields = array_merge(
            ['name' => $userAgentString],
            UserAgent::generateFields($userAgentString)
        );

        return UserAgent::query()->create($fields);
    }
}
