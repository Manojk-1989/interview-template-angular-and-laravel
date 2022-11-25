<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\UserMiddleWare;
use App\Traits\ApiResponse;
use App\Traits\Bodmas;



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
    public function calculateWithoutStep(Request $request)
    {
        $count = 0;
    preg_match_all("/\([^\^(\)]*\)/", $request->formula, $matches);
    foreach($matches[0] as $key=>$value){
        $value = str_replace(["(",")"], ["",""], $value);
        $eq = bodmas($value,$count,false);
        $count++;
        eval("\$result = $value;");
        $request->formula = str_replace("($value)", $result, $request->formula);
        $results[$i] = $eq;
        $i++;
    }
    // return $this->errorResponse('Something went wrong.',204);

    $results = $this->bodmas($request->formula,$count,true);
    return $this->successResponse($results,'Data retrieved Succesfully.',200);

    // return ;
        
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
