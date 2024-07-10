<?php

namespace App\Traits;

use App\Constants\AppString;
use Illuminate\Support\Facades\Validator;

trait AppResponseTrait {
    public function appResponse($res) 
    {
        return response()->json(['status' => $res["status"] ?? "", 'data' => $res["data"] ?? "",  'msg' => $res["msg"] ?? "", 'success' => $res["success"] ?? false, 'error' => $res["error"] ?? "",]);
    }

    public function incompleteRequest($errors)  {
        return $this->appResponse([
            "status" => 400,
            "error" => $errors,
            "msg" => AppString::$incompletePayload,
        ]);
    }
}