<?php

namespace App\Http\Controllers;

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
}
