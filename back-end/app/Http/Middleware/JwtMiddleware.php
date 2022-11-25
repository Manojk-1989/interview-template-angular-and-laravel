<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            //code...
            $user = JWTAuth::parseToken()->authenticate();
            // $user['jwt'] = $request->bearerToken();
            // dd($user);
            // $request['jwtPayload'] = $user;
        } catch (\Throwable $th) {
            //throw $th;
            if ($th instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                # code...
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($th instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                # code...
                return response()->json(['status' => 'Token is Expired']);
            } else {
                # code...
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}
