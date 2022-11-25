<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repository\UserRepository;
use App\Traits\ApiResponse;
use App\Http\Requests\LoginRequest;
use JWTAuth;



class AuthController extends Controller
{
    use ApiResponse;
 
    public $user;
    
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            //code...
            $collection = $request->only('name', 'email', 'password');
            $user = $this->user->createUser($collection);
            return $this->successResponse($user,'User created succesfully',200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse('sOMETHING WENT WRONG.',204);

        }
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            //code...
            $credentials = $request->only('email', 'password');
            $token = JWTAuth::attempt($credentials);

            if ($token) {
                # code...
                $token = $this->user->createNewToken($token);
                return response()->json($token);

            } else {
                # code...
                return $this->errorResponse('Login credentials are invalid.',204);

            }
            
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse('Could not create token.',500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUser(LoginRequest $request)
    {
        try {
            //code...
            $collection = $request->only('email', 'password');
            $token = JWTAuth::attempt($collection);

            if ($token) {
                # code...
                return $this->successResponse($token,'User loggedin succesfully',200);

            } else {
                # code...
                return $this->errorResponse('Login credentials are invalid.',204);

            }
            
        } catch (\Throwable $th) {dd($th);
            //throw $th;
            return $this->errorResponse('sOMETHING WENT WRONG.',204);

        }
    }

    
}
