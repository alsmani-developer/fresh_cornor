<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
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
        
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ],
        [
            'phone.required' => 'رقم الهاتف المدخل غير صحيح',
            'password.required' => 'كلمة السر المدخلة غير صحيحة'
        ]);
            $credentials = $request->only('phone', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('/');
            }
            return back()->with('error', 'احد الحقول المدخلة غير صحيح');
    }
    public function registerUserFirstStep(Request $request){
        request()->validate([
        'user' => 'required',
        'email' => 'nullable|email',
        'phone' => 'required|int',
        'password' => 'required|min:6'
        ]);
        session()->put("user", $request->user);
        session()->put("password", $request->password);
        session()->put("email", $request->email);
        session()->put("phone", $request->phone);
        session()->put("validate_code", '1234');
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
