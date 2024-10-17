<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait AppRequestTrait {

    use AppResponseTrait;

    public function isInvalidRequest($request, $rules) 
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return false;
    }
}