<?php

namespace App\Http\Controllers\VueAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MeatsShape;
use Validator;

class MeatsShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = MeatsShape::orderBy('id', 'DESC')->paginate(10);
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
        // if (meat_shape::where('meat_shape_name', '=',  $request->meat_shape_name)->count() > 0) {
        //     return response()->json(['status'=>'error',
        //     'title'=>'هذا الحقل موجود لايمكن تكرار الحقل']);
        //  }
        // $number =(int)($request->meat_shape_name);
       
        // if ( $number !=0){

        //     return response()->json(['status'=>'error',
        //     'title'=>'لا يمكن ادخال رقم في هذا الحقل']);
        // }
       
        try{
            $validator = Validator::make($request->all(), [

                'ar_name' => 'required|string|min:3',
                'en_name' => 'required|string|min:3',
            ],

            $messages = [
                'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                'en_name.string'=>' هذا الحقل لا يقبل ارقام',
               
            ]
        
        );
    
            if ($validator->passes()) {
                //save property main data into property table
                $meat_shape = new MeatsShape();
                $meat_shape->fill($request->all());
                $save = $meat_shape->save();
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
     * @param  int  MeatsShape $meat_shape
     * @return \Illuminate\Http\Response
     */
    public function show(MeatsShape $meat_shape)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  MeatsShape $meat_shape
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MeatsShape $meat_shape)
    {
        try{
            $validator = Validator::make($request->all(), [

                'ar_name' => 'required|string|min:3',
                'en_name' => 'required|string|min:3',
            ],

            $messages = [
                
                'ar_name.required' => ' يجب ادخال اسم النوع بالغه العربيه',
                'en_name.required'=>'يجب ادخال اسم النوع بالغه الانجليزيه',
                'ar_name.string'=>' هذا الحقل لا يقبل ارقام',
                'en_name.string'=>' هذا الحقل لا يقبل ارقام',
               
            ]
        
        );
    
            if ($validator->passes()) {
                //save property main data into property table
               $update = $meat_shape->update($request->all());
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
     * @param  int  MeatsShape $meat_shape
     * @return \Illuminate\Http\Response
     */
    public function destroy(MeatsShape $meat_shape)
    {
        //
    }
}
