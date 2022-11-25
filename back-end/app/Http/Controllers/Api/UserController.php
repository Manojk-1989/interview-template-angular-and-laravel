<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\Traits\ApiResponse;
use App\Http\Requests\TokenValidateRequest;



class UserController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        try {
            //code...
            $user = JWTAuth::authenticate($request->token);
            if ($user) {
                # code...
                return $this->successResponse($user,'Data retrieved Succesfully.',200);
            } else {
                # code...
                return $this->errorResponse('Something went wrong.',204);
            }

        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse($th,204);

        }
 
        return response()->json(['user' => $user]);
    }

    
}
