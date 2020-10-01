<?php

namespace App\Http\Controllers\VueApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Meat;
use App\CattlesOrigin;
use App\CattlesType;
use App\MeatsArea;
use App\MeatsShape;
use Validator;
use File;
class MeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function getTypes(){
        $query = CattlesType::orderBy('id', 'DESC')->get();
        return  response()->json( $query);
    }
    public function getOrigins(){
        $query = CattlesOrigin::orderBy('id', 'DESC')->get();
        return  response()->json( $query);
    }
    public function getArea(){
        $query = MeatsArea::orderBy('id', 'DESC')->get();
        return  response()->json( $query);
    }
    public function getShape(){
        $query = MeatsArea::orderBy('id', 'DESC')->get();
        return  response()->json( $query);
    }
   
    public function index()
    {
        $query = Meat::orderBy('id', 'DESC')->paginate(10);
        return  response()->json( $query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (meat::where('meat_name', '=',  $request->meat_name)->count() > 0) {
        //     return response()->json(['status'=>'error',
        //     'title'=>'هذا الحقل موجود لايمكن تكرار الحقل']);
        //  }
        // $number =(int)($request->meat_name);
       
        // if ( $number !=0){

        //     return response()->json(['status'=>'error',
        //     'title'=>'لا يمكن ادخال رقم في هذا الحقل']);
        // }
       
        try{
            $validator = Validator::make($request->all(), [

                'ar_name' => 'required|string|min:3',
                'en_name' => 'required|string|min:3',
                'cattels_types_id' => 'required',
                'cattles_origins_id' => 'required',
                'meats_areas_id' => 'required',
                'meats_shapes_id' => 'required',
                'ar_description' => 'required|string|min:3',
                'en_description' => 'required|string|min:3',
                
            ],

            $messages = [
                'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                'en_name.string'=>' هذا الحقل لا يقبل ارقام',
                'ar_description.required' => ' يجب ادخال الوصف بالغه العربيه',
                'en_description.required'=>'يجب ادخال الوصف بالغه الانجليزيه',
                'ar_description.string'=>' هذا الحقل لا يقبل ارقام',
                'en_description.string'=>' هذا الحقل لا يقبل ارقام',
                'cattels_types_id.required' => ' يجب ادخال نوع الماشيه',
                'cattles_origins_id.required' => ' يجب ادخال اصل الماشيه',
                'meats_areas_id.required' => ' يجب ادخال شكل اللحمه',
                'meats_shapes_id.required' => ' يجب ادخال شكل اللحمه',

               
            ]
        
        );
    
            if ($validator->passes()) {
                //save property main data into property table
                $meat = new Meat();
                $meat->fill($request->except(['img_name','pic']));
                $imagepath=  time() . rand(100, 1000).$request->img_name;
                $localpath = "images/$imagepath";
                file_put_contents($localpath,base64_decode($request->pic));
                $meat->pic= $localpath;

                $save = $meat->save();
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
     * @param  int  Meat $meat
     * @return \Illuminate\Http\Response
     */
    public function show(Meat $meat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  Meat $meat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meat $meat)
    {
        try{
            $validator = Validator::make($request->all(), [

                'ar_name' => 'required|string|min:3',
                'en_name' => 'required|string|min:3',
                'cattels_types_id' => 'required',
                'cattles_origins_id' => 'required',
                'meats_areas_id' => 'required',
                'meats_shapes_id' => 'required',
                'ar_description' => 'required|string|min:3',
                'en_description' => 'required|string|min:3',
                
            ],

            $messages = [
                'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                'en_name.string'=>' هذا الحقل لا يقبل ارقام',
                'ar_description.required' => ' يجب ادخال الوصف بالغه العربيه',
                'en_description.required'=>'يجب ادخال الوصف بالغه الانجليزيه',
                'ar_description.string'=>' هذا الحقل لا يقبل ارقام',
                'en_description.string'=>' هذا الحقل لا يقبل ارقام',
                'cattels_types_id.required' => ' يجب ادخال نوع الماشيه',
                'cattles_origins_id.required' => ' يجب ادخال اصل الماشيه',
                'meats_areas_id.required' => ' يجب ادخال شكل اللحمه',
                'meats_shapes_id.required' => ' يجب ادخال شكل اللحمه',

               
            ]
        
        );
           
            if ($validator->passes()) {
               if($request->pic !=$meat->pic){
              
                    $image_path = $meat->pic;
                    if(File::exists($image_path)) {
                        File::delete($image_path);  
                       
                    } 
                   
                    $imagepath=  time() . rand(100, 1000).$request->img_name;
                    $localpath = "images/$imagepath";
                    file_put_contents($localpath,base64_decode($request->pic));
                    $meat->pic= $localpath;
                   
               }
               
               $update = $meat->update($request->except(['pic','img_name']));
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
     * @param  int  Meat $meat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meat $meat)
    {
        //
    }
}
