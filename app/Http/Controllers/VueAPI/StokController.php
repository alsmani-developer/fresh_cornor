<?php
namespace App\Http\Controllers\VueAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Stocks;
use App\StockOperation;
use Validator;
class StokController extends Controller
{
    public function getOprations(){
        $oprations = StockOperation::orderBy('id', 'DESC')->with('admin')->paginate(10);
        return  response()->json(  $oprations );
    }
    public function index()
    {
        $query = Stocks::orderBy('id', 'DESC')->with('meat')->paginate(10);
        return  response()->json( $query);
    }
    public function increseQnt(Request $request , Stocks $stocks){
    
            try{
                $validator = Validator::make($request->all(), [
                    'increse' => 'required|min:1',
                ],
                $messages = [
                    'increse.required' => ' يجب ادخال الكميه',
                    'increse.min'=>'الكميه غير صحيحه',   
                ]);
            
                
                if($validator->passes()){
                    $number =0;
                    $opration = "";
                    if($request->type =='inc'){
                        $number  =  $request->increse + $stocks->quantity;
                        $opration = " تم إضافه وارد للمخزن";
    
                    } 
                    if($request->type =='dec'){
                        if($request->increse > $stocks->quantity){
                            return response()->json(['status'=>'error','title'=>'الكميه غير متوفره في المخزن']);
                        }
                        $number  =  $stocks->quantity-$request->increse;
                        $opration = " تم سحب تالف من المخزن";
                    }

                    $update = $stocks->update(['quantity'=>$number]);
                    if( $update ){
                    
                        $stock_opration = new StockOperation();
                        $stock_opration->stock_id = $stocks->id;
                        $stock_opration->admin_id = $request->admin;
                        $stock_opration->qty =$request->increse;
                        $stock_opration->meat_id =  $stocks->meat_id;
                        $stock_opration->opration =  $opration;
                    
                        $save = $stock_opration->save();
                        if( $save )
                            return response()->json(['status'=>'success',
                            'title'=>'تمت العمليه بنجاح']);

                    
                    } else  return response()->json(['status'=>'error','title'=>'internal server error']);
                
            
                }
                return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
                   
           
                
            
    }catch(\Exception $e) {
        return $e->getMessage();
    }
    }
    public function editPrice(Request $request , Stocks $stocks){
        try{
            $validator = Validator::make($request->all(), [
                'price' => 'required|min:1', 
            ],

            $messages = [
                'price.required' => ' يجب ادخال السعر',
                'price.min'=>'سعر غير صحيح',
                
            ]
        
            );
            if ($validator->passes()) {
                $opration = "";
                //save property main data into property table
                $update = $stocks->update(['price'=>$request->price]);
                $opration = " تم التعديل في السعر";
                if($update){
                  
                    $stock_opration = new StockOperation();
                    $stock_opration->stock_id = $stocks->id;
                    $stock_opration->admin_id = $request->admin;
                    $stock_opration->meat_id =  $stocks->meat_id;
                    $stock_opration->opration =  $opration;
                
                    $save = $stock_opration->save();
                    if( $save )
                        return response()->json(['status'=>'success',
                        'title'=>'تمت العمليه بنجاح']);

                    }else   return response()->json(['status'=>'error','title'=>'internal server error']);



                }
                return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    
    }
    
}

