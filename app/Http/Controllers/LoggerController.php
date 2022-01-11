<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Jobs\RequestLogger;

class LoggerController extends Controller
{
    public function log()
    {
        RequestLogger::dispatch(new Logger());

        return response()
            ->file(
                public_path(Logger::REAL_IMAGE_PATH),
                ["Cache-Control" => "no-cache, must-revalidate, no-store, max-age=0, private"]
            );
    }
}
