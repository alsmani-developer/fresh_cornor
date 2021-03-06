<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;

use DB;

class APIController 
{
///////////////API RESPONSE FUNCTION////////////////////////////////////////////////
   
    public static function getResponce($collection){       
        
                return response()->json([
                    'data'=>$collection
                ], 200);
        
    }
    public static function transactionsResponse($value){
        if($value)
        return response()->json([

            'success'=>true,
            
        ], 200);

        return response()->json([
            'success' => false,
            'message' => 'Sorry, there is not feilds found'
        ], 404);
    }
//////////////////////////////////functions for user /////////////////////////////////////////////////////
}
