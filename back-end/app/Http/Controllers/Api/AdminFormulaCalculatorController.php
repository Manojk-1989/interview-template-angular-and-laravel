<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleWare;
use App\Models\User;
use App\Traits\ApiResponse;
use JWTAuth;
use App\Traits\Bodmas;
use App\Http\Requests\CalculationRequest;







class AdminFormulaCalculatorController extends Controller
{
    public function __construct()
   {
       $this->middleware(AdminMiddleWare::class);
   }

   use ApiResponse,Bodmas;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsers()
    {

        try {
            //code...
            // 
            $users = User::where('role_id','=',1)->get();
        // dd($user);

            if (count($users) > 0) {
                # code...
                if ($users) {
                    # code...
                    return $this->successResponse($users,'Data retrieved Succesfully.',200);
                } else {
                    # code...
                    return $this->errorResponse('Something went wrong.',204);
                }
            }
            

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
    public function calculateWithStep(CalculationRequest $request)
    {
        try {
            //code...
            $user = JWTAuth::parseToken()->authenticate();
        
            // $str = "100*50+300-5";
            $role = $user->role_id;
            $result = $this->evaluate($request->formula);
            $limit = count($result);
       
            foreach($result as $res => $key){
                     "Step ".$res." :".$key."\n";
                }

            return $this->successResponse($result,'Data retrieved Succesfully.',200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorResponse('Something went wrong.',204);

        }
        
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
