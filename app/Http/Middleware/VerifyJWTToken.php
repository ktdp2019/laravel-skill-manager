<?php

namespace App\Http\Middleware;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Traits\AppControllerTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class VerifyJWTToken
{
    use AppControllerTrait;


    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken();
            $sub = $token->getClaim('sub');
            if (!$sub) {
                return $this->appResponse(['success' => false, 'msg'  => StringConstant::$NO_USER_FOUND,  'status' => ResStatus::$Status401]);
            }
            $request->merge(['user_id' => $sub]);
        } catch (TokenExpiredException $e) {
            return $this->appResponse(['success' => false, 'msg'  => StringConstant::$TOKEN_EXPIRED,  'status' => ResStatus::$Status401]);
        } catch (TokenInvalidException $e) {
            return $this->appResponse(['success' => false, 'msg'  => StringConstant::$TOKEN_INVALID,  'status' => ResStatus::$Status401]);
        } catch (JWTException $e) {
            return $this->appResponse(['success' => false, 'msg'  => StringConstant::$TOKEN_NOT_FOUND,  'status' => ResStatus::$Status401]);
        }
        
        return $next($request);
    }
}
