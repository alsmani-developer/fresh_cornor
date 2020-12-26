<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use DB;
class BaseController extends Controller
{
    public function changeLanguage($val){
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        App::setLocale($val);
        session()->put('locale', $val);
        return redirect()->back();
    }

    public function activate(Request $request){

        $affected = DB::table($request->table_name)
            ->where($request->pk, $request->id)
            ->update(['status_id' => 1]);
        if( $affected){
            return response()->json(['status'=>'success',
                    'title'=>'تمت  تفعيل الحقل بنجاح']);

        }else   return response()->json(['status'=>'error','title'=>'internal server error']);
        
    }
    public function deActivate(Request $request){
      
        $affected = DB::table($request->table_name)
            ->where($request->pk, $request->id)
            ->update(['status_id' => 2]);
            if( $affected){
                return response()->json(['status'=>'success',
                        'title'=>'تمت الغاء تفعيل الحقل بنجاح']);
    
            }else   return response()->json(['status'=>'error','title'=>'internal server error']);
    }
}
