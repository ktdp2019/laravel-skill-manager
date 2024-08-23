<?php

namespace App\Utils;

use Carbon\Carbon;
use DateTime;

class TimeHelper {
    static function getDateFromEpochTime($epochTime) {
        if (strlen($epochTime) > 10) {
            return Carbon::createFromTimestamp((int)$epochTime/1000)->toDateTimeString();
        }
        return Carbon::createFromTimestamp($epochTime)->toDateTimeString();
    }
    
    static function getCurrentDate() {
        return Carbon::createFromTimestamp(time())->toDateTimeString();
    }

    static function getEpochTime($date) {
        $dateTime = new DateTime($date);
        $timestamp = $dateTime->getTimestamp();
        return $timestamp;
    }
}