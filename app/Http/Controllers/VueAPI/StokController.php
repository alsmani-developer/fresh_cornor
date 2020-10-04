
<?php

namespace App\Http\Controllers\VueAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stock;

class StokController extends Controller
{
    public function index()
    {
        $query = Stock::orderBy('id', 'DESC')->paginate(10);
        return  response()->json( $query);
    }
    public function increseQnt(Request $request , Stock $stock){
        if($request->type =='inc')
            $number  =  $request->increse + $stock->quantity;
        if($request->type =='dec')
            $number  =  $request->increse - $stock->quantity;
        $update = $stock->update(['quantity'=>$number]);
        if( $update ){
            return response()->json(['status'=>'success',
            'title'=>'تمت تعديل الكميه بنجاح']);

           
        } else   return response()->json(['status'=>'error','title'=>'internal server error']);
    }
    
}
