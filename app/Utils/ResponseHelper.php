<?php

namespace App\Utils;

class ResponseHelper 
{
    static function appResponse($res) 
    {
        return response()->json(['status' => $res["status"] ?? "", 'data' => $res["data"] ?? "",  'msg' => $res["msg"] ?? "", 'success' => $res["success"] ?? false, 'error' => $res["error"] ?? ""]);
    }
}