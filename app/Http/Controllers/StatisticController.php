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

        $browsers = $userAgents->groupBy('browser')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();

        $devices = collect(
            [
                'Mobile' => $userAgents->where('is_mobile')->count(),
                'Tablet' => $userAgents->where('is_tablet')->count(),
                'Desktop' => $userAgents->where('is_desktop')->count(),
            ]
        )->toJsCollection();

        $platforms = $userAgents->groupBy('platform')->map->count()->keyBy(function ($value, $key) {
            return $key === '' || $key === 0 ? 'Other' : $key;
        })->toJsCollection();

        return response()->json([
            'success' => true,
            'browsers' => $browsers,
            'devices' => $devices,
            'platforms' => $platforms,
        ], 200);
    }
}
