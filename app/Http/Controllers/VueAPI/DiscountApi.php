<?php

namespace App\Http\Controllers\VueAPI;
use App\Discount;
use Illuminate\Http\Request;
use File;
use Validator;
use App\DiscountsQuantity;
use App\Meat;
use DB;
use App\Http\Controllers\Controller;


class DiscountApi extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMeats(){
        $query = DB::table('meats')->select('id','ar_name')->get();
        return  response()->json( $query);
    }
    public function index()
    {
        $query = Discount::orderBy('id', 'DESC')->with('meats')->paginate(10);
        return  response()->json( $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try{
            $validator = Validator::make($request->all(), [

                'ar_name' => 'required|string|min:3',
                'en_name' => 'required|string|min:3',
                'ar_description' => 'required|string|min:3',
                'en_description' => 'required|string|min:3',
                'amount'=>'required|Numeric|min:1|max:100',
                'end_date'=>'required',
                'start_date'=>'required',
            ],

            $messages = [
                'amount.required' => ' يجب ادخال كميه المنتج',
                'end_date.required' => ' يجب ادخال تاريخ نهايه التخفيض',
                'start_date.required' => ' يجب ادخال تاريخ بدايه التخفيض',
                'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                'en_name.string'=>' هذا الحقل لا يقبل ارقام',
                'ar_description.required' => ' يجب ادخال الوصف بالغه العربيه',
                'en_description.required'=>'يجب ادخال الوصف بالغه الانجليزيه',
                'ar_description.string'=>' هذا الحقل لا يقبل ارقام',
                'en_description.string'=>' هذا الحقل لا يقبل ارقام',
               
            ] );
    
            if ($validator->passes()) {
                //save discount
               
                $discount = new Discount();
                $discount->fill($request->except(['img_name','pic','qnt','meat_id']));
                //upload discount pic
               
                if($request->pic !=null){
                     
                    $imagepath=  time() . rand(100, 1000).$request->img_name;
                    $localpath = "images/$imagepath";
                    file_put_contents($localpath,base64_decode($request->pic));
                    $discount->pic= $localpath;
                    
                }
                $save = $discount->save();
                //attch to pivto table meats with discount
               
                $save_meats_discounts = $discount->meats()->attach($request->meat_id);
                //save quantity of meats discount
                if($request->qnt !=null){
                    $quantity =new  DiscountsQuantity();
                    $quantity->discount_id = $discount->id;
                    $quantity->cirtical_quantity = $request->qnt;
                    $save_qnt =  $quantity->save();

                }
                if( $save){
                  
                    return response()->json(['status'=>'success',
                    'title'=>'تمت اضافه الحقل بنجاح']);

                    }else   return response()->json(['status'=>'error','title'=>'internal server error']);



                }
                return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        
        
            try{
                $validator = Validator::make($request->all(), [
    
                    'ar_name' => 'required|string|min:3',
                    'en_name' => 'required|string|min:3',
                    'ar_description' => 'required|string|min:3',
                    'en_description' => 'required|string|min:3',
                    'amount'=>'required|Numeric|min:1|max:100',
                    'end_date'=>'required',
                    'start_date'=>'required',
                ],
    
                $messages = [
                    'amount.required' => ' يجب ادخال كميه المنتج',
                    'end_date.required' => ' يجب ادخال تاريخ نهايه التخفيض',
                    'start_date.required' => ' يجب ادخال تاريخ بدايه التخفيض',
                    'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                    'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                    'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                    'en_name.string'=>' هذا الحقل لا يقبل ارقام',
                    'ar_description.required' => ' يجب ادخال الوصف بالغه العربيه',
                    'en_description.required'=>'يجب ادخال الوصف بالغه الانجليزيه',
                    'ar_description.string'=>' هذا الحقل لا يقبل ارقام',
                    'en_description.string'=>' هذا الحقل لا يقبل ارقام',
                   
                ]
            
            );
           
            if ($validator->passes()) {

               if($request->pic !=$discount->pic){
              
                    $image_path = $discount->pic;
                    if(File::exists($image_path)) {
                        File::delete($image_path);  
                       
                    } 
                   
                    $imagepath=  time() . rand(100, 1000).$request->img_name;
                    $localpath = "images/$imagepath";
                    file_put_contents($localpath,base64_decode($request->pic));
                    $discount->pic= $localpath;
                   
               }
               if($request->qnt !=null){
                   
                    DiscountsQuantity::where('discount_id',$discount->id)->update(['cirtical_quantity'=>$request->qnt]);
                }
                if($request->discount_type_id ==2){
                   
                    DiscountsQuantity::where('discount_id',$discount->id)->delete();
                }
               $update = $discount->update($request->except(['pic','img_name','meat_id','qnt']));
                if( $update ){
                  
                    return response()->json(['status'=>'success',
                    'title'=>'تمت تعديل الحقل بنجاح']);

                    }else   return response()->json(['status'=>'error','title'=>'internal server error']);



                }
                return response()->json(['status'=>'error','title'=>$validator->errors()->all()]);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
