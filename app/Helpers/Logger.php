<?php

namespace App\Helpers;

use App\Models\UserRequest;

class Logger
{
    const IMAGE_URL = 'logger/pixel.gif';
    const REAL_IMAGE_PATH = 'img/transparent.gif';

    public static function logRequest()
    {
        UserRequest::log();
    }
}
