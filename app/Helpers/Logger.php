<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class Logger
{
    public static function logError($e)
    {
        Log::error("[Error encountered in file ] " . $e->getFile());
        Log::error("[Error encountered on line ] " . $e->getLine());
        Log::error("[Exception Message]". $e->getMessage());
    }
}
