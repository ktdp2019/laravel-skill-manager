<?php

namespace App\Traits;
use App\Constants\ResStatus;
use App\Constants\StringConstant;
use Illuminate\Support\Facades\App;

trait AppResponseTrait {

    public function appResponse($res) 
    {
        return response()->json([
            'status' => $res["status"] ?? ResStatus::$Status400, 
            'data' => $res["data"] ?? "",
            'msg' => $res["msg"] ?? "",
            'success' => $res["success"] ?? false,
            'error' => $res["error"] ?? "",
        ]);
    }

    public function incompleteRequest()  {
        return $this->appResponse([
            "error" => StringConstant::$incompletePayload,
        ]);
    }

    public function errorRequest($data) 
    {
        return $this->appResponse([
            'error' => App::environment('local', 'staging') ? $data['error'] : StringConstant::$SWW,
            'status' => ResStatus::$Status500,
        ]);
    }
}