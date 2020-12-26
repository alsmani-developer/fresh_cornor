<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDrivers(){
        $query = user::orderBy('id', 'DESC')->where('user_type_id',2)->get();
        return  response()->json( $query);
    }
    public function index()
    {
        $user= User::all();
        return view('pages.users.show_users',compact('user'));
    }

    public function user_order($user_id)
    {
        $user_order= Order::where('user_id', $user_id)->get();

        return view('pages.users.user_order',compact('user_order','user_id'));
    }
    public function update(Request $request , User $user){
        try{
            $validator = Validator::make($request->all(), [

                'name' => 'required|string|min:3',
                'phone' => 'required|min:13|max:14',
                'email' => 'required|email',
               
   
            ],
            $messages = [
                'name.required' => ' يجب ادخال اسم المستخدم ',
                'phone.required'=>'يجب ادخال رقم هاتف المستخدم ',
                'phone.min'=>'رقم هاتف غير صحيح ',
                'name.string'=>' هذا الحقل لا يقبل ارقام',    
            ]
        
             );
             if($validator->passes()){

               
               
                $update = $user->update($request->except(['dashbord','code','user_type_id']));
                if( $update ){
    
                    return response()->json(['status'=>'success',
                    'title'=>'تمت اضافه الحقل بنجاح']);
                }
               
             }
              return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
           
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function destroy(User $user)
    {
        $user->delete();
        
        return back();
    }

}
