<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class RequestHelper 
{
    static function validateRequest($request, $rules) 
    {
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}