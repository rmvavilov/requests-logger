<?php

namespace App\Http\Controllers;

use App\Models\UserAgent;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        return view('statistics.index');
    }

    public function requests(Request $request)
    {
        $requests = UserRequest::query()
            ->with('userAgent')
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json([
            'success' => true,
            'requests' => $requests,
        ], 200);
    }

    public function userAgentStatistics()
    {
        $userAgents = UserAgent::all();
        $todayUserAgents = $userAgents
            ->where('created_at', '>', now()->startOfDay())
            ->where('created_at', '<', now()->endOfDay());

        //browsers
        $browsers = $userAgents->groupBy('browser')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();
        $todayBrowsers = $todayUserAgents->groupBy('browser')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();

        //devices
        $devices = collect([
            'Mobile' => $userAgents->where('is_mobile')->count(),
            'Tablet' => $userAgents->where('is_tablet')->count(),
            'Desktop' => $userAgents->where('is_desktop')->count(),
        ])->toJsCollection();
        $todayDevices = collect([
            'Mobile' => $todayUserAgents->where('is_mobile')->count(),
            'Tablet' => $todayUserAgents->where('is_tablet')->count(),
            'Desktop' => $todayUserAgents->where('is_desktop')->count(),
        ])->toJsCollection();

        //platforms
        $platforms = $userAgents->groupBy('platform')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();
        $todayPlatforms = $todayUserAgents->groupBy('platform')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();

        return response()->json([
            'success' => true,
            'today' => [
                'browsers' => $todayBrowsers,
                'devices' => $todayDevices,
                'platforms' => $todayPlatforms,
            ],
            'all' => [
                'browsers' => $browsers,
                'devices' => $devices,
                'platforms' => $platforms,
            ],
        ], 200);
    }
}
