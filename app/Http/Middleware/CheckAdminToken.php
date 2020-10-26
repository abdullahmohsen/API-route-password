<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use GeneralTrait;

    //Code Form JWT to make Check on status of token
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
                // return response()->json(['success' => false, 'msg' => 'INVALID_TOKEN']);

            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001','EXPIRED_TOKEN');
                // return response()->json(['success' => false, 'msg' => 'EXPIRED_TOKEN']);

            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
                // return response()->json(['success' => false, 'msg' => 'TOKEN_NOTFOUND']);

            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this -> returnError('E3001','INVALID_TOKEN');
                // return response()->json(['success' => false, 'msg' => 'INVALID_TOKEN']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this -> returnError('E3001','EXPIRED_TOKEN');
                // return response()->json(['success' => false, 'msg' => 'EXPIRED_TOKEN']);
            } else {
                return $this -> returnError('E3001','TOKEN_NOTFOUND');
                // return response()->json(['success' => false, 'msg' => 'TOKEN_NOTFOUND']);

            }
        }

        if (!$user)
        {
            // return response()->json(['success' => false, 'msg' => trans('Unauthenticated')]);
            return $this -> returnError('E3001', 'Unauthenticated');
        }
        return $next($request);
    }
}
