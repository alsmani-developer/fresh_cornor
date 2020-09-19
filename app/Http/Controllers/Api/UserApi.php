<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;
use App\Http\Controllers\APIController;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;



class UserApi extends APIController
{
    ///////////////API RESPONSE FUNCTION////////////////////////////////////////////////
   
   
//////////////////////////////////functions for user /////////////////////////////////////////////////////
    
    //geting user guard
    public function guard()
    {
        return Auth::guard();
    }
    //user login 
    public function login(Request $request)
    {
       
        $input = $request->only('phone', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid phone number or Password',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'customer'=>response()->json(auth()->user()),
            'token' => $token,
        ],200);
    }

    //user logout
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

   
    //user Phone verfycation 
    public function verfyPhoneNumber(Request $request)
    {
        try{

            if(User::where('phone',$request->phone)->count() > 0){
                return response()->json([
                    'success'   =>  false,
                    'msg'=>'this number is exist'
                    ], 200);
            }
            //send phone massage verfiction 
            return $this->sendVerfyNumer($request->phone);
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
      public function verfyPhoneNumberForRestPassword(Request $request)
    {
        try{

            if(User::where('phone',$request->phone)->count() > 0){
                return $this->sendVerfyNumer($request->phone);
            }
            
              return response()->json([
                    'success'   =>  false,
                    'msg'=>'this number is not exist'
                    ], 200);
            //send phone massage verfiction 
          
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
    public function sendVerfyNumer($phone){
         try{

            //send phone massage verfiction 
            $curl = new CurlSMS();
            $username = "Yamamahpress";		    // اسم المستخدم الخاص بك في الموقع 
            $password = "YamPass121"; 		// كلمة المرور الخاصة بك 
            $destinations =$phone; //الارقام المرسل لها  ,, يتم وضع فاصلة بين الارقام المراد الارسال لها 
            $numbers = '12345678910111236542301236985452315245552012369874563201423698745';
            $number=substr(str_shuffle(str_repeat($numbers , 5)), 0,5);
            // dd($number);
            $message = "قم بادخال الكود المرسل ليتم التحقق من رقم الهاتف  ". $number;      // محتوى الرسالة 
            $sender = "Dot-AD";  
            $url = "http://www.jawalbsms.ws/api.php/sendsms?user=$username&pass=$password&to=$destinations&message=$message&sender=$sender";
           
            $urlDiv = explode("?", $url);
            $result = $curl->_simple_call("post", $urlDiv[0], $urlDiv[1], array("TIMEOUT" => 3));
            //  dd($result) ;
            // $result = "MSG_ID: 204346146 | STATUS: Success | Total: 1 | Cost: 1" ;
           
            

            return response()->json([
                'success'   =>  true,
                'number' => $number,
               
            ], 200);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    //regester user
    public function register(Request $request){
     
        try{
           
            $user = new User();
            $user->name = $request->name;
            $user->user_type_id = $request->user_type_id;
            $user->phone = $request->phone;
            $user->status_id = $request->status_id;
            $user->email = $request->status_id;
            $user->password = bcrypt($request->password);

            $save = $user->save();
            return $this->transactionsResponse($save);
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
      
      
    }
     public function resetPassword(Request $request){
        try{
            if($request->code){
               
                $update = User::update(['password' => bcrypt($request->password)])->where('phone',$request->phone);  
                return  $this->transactionsResponse( $update);
            }
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry,the verfication number is incorect'
                     ], 404);
            
        }catch(\Exception $e){
           
             return $e->getMessage();
         }
    }
    //change password
    public function changePassword(User $user ,Request $request)
    {
        try{
            $data = $request->password;
            $update=$user->update(['password' => bcrypt($data)]);
            if($update){
                return response()->json($user,200);
            }else return [
                    'code'=>0,
                    'massage'=>'field'
                ];
        }catch(\Exception $e){
           
             return $e->getMessage();
         }
       
    }
    public function getUser()
    {
        return response()->json(auth()->user());
    }
    public function add_proposal(Request $request){
        try{
            $proposal = new proposal();
            $proposal->user_id = auth()->user()->id;
            $proposal->fill($request->except(['token']));
            $save = $proposal->save();
            return $this->transactionsResponse($save);
        }catch(\Exception $e){
           
             return $e->getMessage();
         }
      
    }
    
}
