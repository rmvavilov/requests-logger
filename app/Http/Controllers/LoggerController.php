<?php

namespace App\Http\Controllers;

use App\Jobs\RequestLogger;
use Illuminate\Http\Request;

class LoggerController extends Controller
{
    public function log(Request $request)
    {
        RequestLogger::dispatch(
            $request->get('userId'),
            $request->userAgent(),
            $request->ip(),
            $request->headers->all(),
            now(),
        );

        return response()
            ->file(
                public_path(RequestLogger::REAL_IMAGE_PATH),
                ["Cache-Control" => "no-cache, must-revalidate, no-store, max-age=0, private"]
            );
    }
}
