<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
use Ixudra\Curl\Facades\Curl;
use App\UserFavorite;

class UserController extends Controller
{
    // show login form
    public function login(){
        return view('site.user.login');
    }
    public function register(){
        return view('site.user.register');
    }
    public function loginUser(Request $request){
        $phone = preg_replace('/\s+/', '', $request->full);
        $request_only =  ['password' => $request->password, 'phone' => $phone];
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ],
        [
            'phone.required' => 'رقم الهاتف المدخل غير صحيح',
            'password.required' => 'كلمة السر المدخلة غير صحيحة'
        ]);
            $credentials = $request_only;

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('/user-profile');
            }
            return back()->with('error', 'احد الحقول المدخلة غير صحيح');
    }
    public function registerUserFirstStep(Request $request){
        $country_code = '+'.$_GET['code'];
        $number = $country_code.$request->phone;
        $number = preg_replace('/\s+/', '', $number);
        $send = $_GET['code'].$request->phone;
        request()->validate([
        'user' => 'required',
        'email' => 'nullable|email',
        'phone' => 'required',
        'password' => 'required|min:6'
        ]);
        $response = $this->verfiyPhoneNumber($send);
        if($response =="OK"){
        session()->put("user", $request->user);
        session()->put("password", $request->password);
        session()->put("email", $request->email);
        session()->put("phone", $number);
        }else{
            return redirect()->back()->withErrors('حدث خطا الرجا المحاولة لاحقا');
        }
    }
    public function registerUserLastStep(Request $request){
        $this->validateSession($request);
             User::create([
                'name' => session('user'),
                'email' => session('email'),
                'phone'=> session('phone'),
                'password' => Hash::make(session('password')),
                'user_type_id' => 1,
                'status_id' => 1,
            ]);
            echo 'registered';
    }
    public function validateSession($request){
        if(session('user') !== null && session('password') !== null  && session('phone') !== null
         && session('validate_code') !== null){
            if($_GET['validation_numb'] != session('validate_code')){
                echo 'رقم التحقق غير صحيح';
                die();
            }
        }else{
            echo 'حدث خطا ما الرجاء المحاولة لاحقا';
            die();
        }
    }
    public function verfiyPhoneNumber($phone){
        $username = "Almayzab";		    // اسم المستخدم الخاص بك في الموقع
        $password = "44"; 		// كلمة المرور الخاصة بك
        $destinations =$phone; 
        $sender = "Almayzab";//الارقام المرسل لها  ,, يتم وضع فاصلة بين الارقام المراد الارسال لها
        $numbers = '12345678910111236542301236985452315245552012369874563201423698745';
        $number=substr(str_shuffle(str_repeat($numbers , 5)), 0,5);
        $message = "your verification number is".$number;      // محتوى الرسالة
        $response = Curl::to('http://196.202.134.90/SMSbulk/webacc.aspx?user=Almayzab&pwd=44&smstext='.$number.'&Sender=Almayzab&Nums='.$destinations.'')->get();
        session()->put("validate_code", $number);
        return $response;
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
      public function getOrders()
      {
          $orders = auth()->user()->orders;
          return view('site.user.orders', compact('orders'));
      }
      public function getUser(){

          $user = Auth::user();
          return view('site.user.show', compact('user'));
      }
      public function addToFav($product_id){
        if(Auth::check()){
            $user = Auth::user()->id;
            $checkFav = UserFavorite::where(['meat_id' => $product_id, 'user_id' => $user])->first();
            if(!$checkFav){
                $save = UserFavorite::create([
                    'user_id' => $user,
                    'meat_id' => $product_id
                ]);
            return redirect()->back()->withSuccess('تم إضافة المنتج الى مفضلتك بنجاح');
            }else{
                return redirect()->back()->withError('المنتج متواجد بالفعل في مفضلتك');
            }
        }else{
            return redirect()->back()->withError('يجب ان تكون مسجلا لكي تتمكن من اضافة منتج للمفضلة');
        }
      }
      public function removeFromFav($product_id){
        $user = Auth::user()->id;
        $checkFav = UserFavorite::where(['meat_id' => $product_id, 'user_id' => $user])->first();
        $checkFav->delete();
        return redirect()->back()->withSuccess('تمت ازالة المنتج من المفضلة بنجاح.');
      }
}
