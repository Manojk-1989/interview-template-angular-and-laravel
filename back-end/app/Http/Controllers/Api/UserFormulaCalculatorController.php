<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\UserMiddleWare;
use App\Traits\ApiResponse;
use App\Traits\Bodmas;
use JWTAuth;
use App\Http\Requests\CalculationRequest;




class UserFormulaCalculatorController extends Controller
{
    public function __construct()
   {
       $this->middleware(UserMiddleWare::class);
   }
   use Bodmas;
   use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateWithoutStep(CalculationRequest $request)
    {
        try {
            //code...
            $user = JWTAuth::parseToken()->authenticate();
            // $str = "100*50+300-5";
            $role = $user->role_id;
            $result = $this->evaluate($request->formula);
            $limit = count($result);

            return $this->successResponse($result[$limit-1],'Data retrieved Succesfully.',200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse('Something went wrong.',204);

        }
        

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
