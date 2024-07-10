<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait AppRequestTrait {

    use AppResponseTrait;

    public function inValidateRequest($request, $rules) 
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->incompleteRequest($errors);
        }
        return false;
    }
}