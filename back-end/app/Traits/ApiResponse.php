<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;


trait ApiResponse{
        

    protected function successResponse($data, $message, $code = 200)
	{
        $data = ['status' => true,'status_code'=>$code,'data'=>$data,'message' => $message];
        return response()->json(['results'=> $data]);
	}

	protected function errorResponse($message, $code)
	{
        $data = ['status' => false,'status_code'=>$code,'data'=>NULL,'message' => $message];
        return response()->json(['results'=> $data]); 
	}

}