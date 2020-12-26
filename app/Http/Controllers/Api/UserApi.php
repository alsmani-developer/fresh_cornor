<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Proposal;
use Validator;
use App\Http\Controllers\APIController;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;



class UserApi extends APIController
{
    ///////////////API RESPONSE FUNCTION////////////////////////////////////////////////
   
   
//////////////////////////////////functions for user /////////////////////////////////////////////////////
    public function getDrivers(){
        $query = User::orderBy('id', 'DESC')->where('user_type_id',2)->paginate(10);
        return  response()->json($query);
    }
    public function getUsers(){
        $query = User::orderBy('id', 'DESC')->where('user_type_id',1)->paginate(10);
        return  response()->json($query);
    }
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
   
    //regester user
    public function register(Request $request){
     
        try{
            $validator = Validator::make($request->all(), [

                'name' => 'required|string|min:3',
                'phone' => 'required|min:13|max:14',
                'email' => 'required|email',
                'password' => 'required',
              
   
            ],
            $messages = [
                'name.required' => ' يجب ادخال اسم المستخدم ',
                'phone.required'=>'يجب ادخال رقم هاتف المستخدم ',
                'phone.min'=>'رقم هاتف غير صحيح ',
                'name.string'=>' هذا الحقل لا يقبل ارقام',    
            ]
        
             );
             if($validator->passes()){

                $user = new User();
                $user->name = $request->name;
                $user->user_type_id = $request->user_type_id;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
    
                $save = $user->save();
                if($request->dashbord){
    
                    return response()->json(['status'=>'success',
                    'title'=>'تمت اضافه الحقل بنجاح']);
                }
                return $this->transactionsResponse($save);
             }
              return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
           
        }catch(\Exception $e){
            return $e->getMessage();
        }
      
      
    }
    public function getCode(Request $request){
        if(User::where('phone',$request->phone)->count() > 0){
            return response()->json(['msg'=>'هذا الرقم موجود مسجل'],200);
           
        }else  {
            $username = "Almayzab";		    // اسم المستخدم الخاص بك في الموقع
            $password = "44"; 		// كلمة المرور الخاصة بك
            $destinations =$request->phone; 
            $sender = "Almayzab";//الارقام المرسل لها  ,, يتم وضع فاصلة بين الارقام المراد الارسال لها
            $numbers = '12345678910111236542301236985452315245552012369874563201423698745';
            $number=substr(str_shuffle(str_repeat($numbers , 5)), 0,5);
            $message = "your verification number is".$number;      // محتوى الرسالة
            $response = Curl::to('http://196.202.134.90/SMSbulk/webacc.aspx?user=Almayzab&pwd=44&smstext='.$number.'&Sender=Almayzab&Nums='.$destinations.'')->get();
           
            return response()->json(['code'=>$number],200);
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
