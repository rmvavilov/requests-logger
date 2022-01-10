<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class UserAgent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'browser',
        'browser_version',
        'platform',
        'platform_version',
        'device',
        'device_type',
        'robot',
        'is_robot',
        'is_mobile',
        'is_phone',
        'is_tablet',
        'is_desktop',
    ];

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

    public static function generateFields(string $userAgentString): array
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgentString);
        $browser = $agent->browser();
        $browserVersion = $agent->version($browser);
        $platform = $agent->platform();
        $platformVersion = $agent->version($platform);
        $device = $agent->device();

        return [
            'name' => $userAgentString,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'platform' => $platform,
            'platform_version' => $platformVersion,
            'device' => $device,
            'device_type' => $agent->deviceType(),
            'robot' => $agent->robot(),
            'is_robot' => $agent->isRobot(),
            'is_mobile' => $agent->isMobile(),
            'is_phone' => $agent->isPhone(),
            'is_tablet' => $agent->isTablet(),
            'is_desktop' => $agent->isDesktop(),
        ];
    }
}
