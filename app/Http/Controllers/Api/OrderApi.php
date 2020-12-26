<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Meat;
use App\Discount;
use App\OrdersMeat;
use App\OrdersMeatsDiscount;
use App\OrdersTransporter;
use App\Stocks;
use DB;
use DateTime;
use Carbon\Carbon;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use App\UserFavorite;
class OrderApi extends APIController
{
    public function changeOrderStatus(Request $request,Order $order){
       $update = $order->update(['dellivery_status_id'=>$request->status]);
       $this->transactionsResponse( $update );
    }
    public function getAllOrders(){
        $query = Order::orderBy('id', 'DESC')->with('user','orders_transporter.user','ordersMeats.meat')->paginate(10);
        return  response()->json($query);
    }
    public function addOrderToDriver(Request $request){
        try{
            $save = OrdersTransporter::firstOrCreate([
                'order_id' => $request->order_id,
                'user_id' =>  $request->user_id
            ]);
            
            if( $save  ){
                return response()->json(['status'=>'success',
                            'title'=>'تم إسناد الطلب للسائق بنجاح']);
            }else return response()->json(['status'=>'error','title'=>'internal server error']);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
       

    }
    public function editOrderToDriver(Request $request){
       
        try{
            $update = OrdersTransporter::where('order_id',$request->order_id)->update(['transporter_id'=>$request->user_id]);
            if( $update ){
                return response()->json(['status'=>'success',
                            'title'=>'تم إسناد الطلب للسائق بنجاح']);
            }else return response()->json(['status'=>'error','title'=>'internal server error']);
        }catch(\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getUserOrder(User $user){
        if($user->user_type_id ==1){
            $orders = $user->orders;
            return $this->getResponce( $orders );

        }else {
             $orders = DB::table('orders_transporters')->leftjoin('orders', 'orders_transporters.order_id', 'orders.id')->where('orders_transporters.transporter_id', $user->id)->select(['orders.*'])->get();
             
              return $this->getResponce( $orders );
        }
       
    }
    public function getOrder(Order $order){
        if( $order !=null){
            return response()->json([
                'success'   =>  true,
                'data'=>$order
            ], 200);
        }else  return response()->json([
            'success' => false,
            'message' => 'Sorry, the order not found'
        ], 404);
    }
    public function addOrder(Request $request){
        try{
          
         
            // save order
            $order = new Order();
            $order->fill($request->except(['token', 'meats']));
            $save =  $order->save();
            if($save ){
                //save order meats
               $flag = false;
               $meats = $request->meats;
               
              
               
                if( $meats !=null){
            
                  
                    foreach($meats as $meat){
                        
                        // update meat quantity in stock
                         $quantity = Stocks::where("meat_id", $meat['meat_id'])->pluck("quantity")->last();
                          
                         $qty = $quantity-$meat['quantity'];
                        Stocks::where("meat_id",$meat['meat_id'])->update(["quantity"=>$qty]);
                        
                        //get meat price from stock
                        $price = Stocks::where("meat_id",$meat['meat_id'])->pluck("price")->last();
                        
                    //get meat discount from meat discount table
                     $discount = DB::table('discounts_meats')->leftjoin('discounts', 'discounts_meats.discount_id', 'discounts.id')->where('discounts_meats.meat_id', $meat['meat_id'])->select(['discounts.*'])->orderBy('amount', 'desc')->first();
                  
                    if($discount != null && \Carbon\Carbon::now() < $discount->end_date &&  $discount->status_id==1){
                        $flag = true;
                       
                        //save order meats discount
                        $order_meat_discount = new OrdersMeatsDiscount();
                        $order_meat_discount->order_id = $order->id;
                        $order_meat_discount->meat_id = $meat['meat_id'];
                        $order_meat_discount->discounti_id =$discount->id;
                        $order_meat_discount->discount_amount = $discount->amount;
                        $save = $order_meat_discount->save();
                        
                    }
                    $order_meat = new OrdersMeat();
                    $order_meat->order_id=$order->id;
                    $order_meat->meat_id = $meat['meat_id'];
                    $order_meat->quantity =$meat['quantity'];
                    if($flag){
                        $meat_discount = $price*$discount->amount/100;
                        $order_meat->price =$price - $meat_discount;
                        
                    }else  $order_meat->price = $meat->price*$meat['quantity'];
                   
                    $save = $order_meat->save();
                    $flag =false;
                }
            }
                
            }else return response()->json([
                'message' => 'server erorr'
            ], 500);
           
            return $this->transactionsResponse($save);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
    public function cancelOrder(Order $order){
        if( $order !=null){
            $update = $order->update(['active'=>0]);
            $this->transactionsResponse( $update );
        }else  return response()->json([
            'success' => false,
            'message' => 'Sorry, the order not found'
        ], 404);
    }
    public function getDiscounts(Request $request){
        $discounts = Discount::orderBy('id', 'DESC')->paginate($request->limit);
         foreach( $discounts as $discount){
            $datetime1 = new DateTime( $discount->start_date);
            $datetime2 = new DateTime($discount->end_date);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $discount->deuration =$days;
        }
        return response()->json($discounts,200);

    }
      public function getDiscount(Discount $discount){
          $result = Discount::where('id',$discount->id)->with('meats.stock')->get();
            $datetime1 = new DateTime( $discount->start_date);
            $datetime2 = new DateTime($discount->end_date);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
             
         $result[0]->deuration =$days;
        return response()->json(
        $result[0], 200);

    }
    public function getNewMeats(Request $request){
        // \Carbon\Carbon::now() < $offer->end_at;
        $meats = Meat::orderBy('id', 'DESC')->with('stock')->paginate($request->limit);
       
        foreach( $meats as $meat){
          $discount = $meat->discounts()->orderBy('amount', 'desc')->first();
          if(\Carbon\Carbon::now() < $discount->end_date &&  $discount->status_id==1){
               $meat->discount = $discount->amount;
               $meat->discount_type = $discount->discount_type->ar_name;
          }else 
          $meat->discount = -1;
         
            // foreach( $discounts as $discount ){
            //     if(\Carbon\Carbon::now() < $discount->end_date &&  $discount->status_id==1){
            //         $meat
            //     }
            // }
        }
        
        return response()->json($meats,200);
    }
    public function getMeat(Request $request , Meat $meat){
        
        $flag = false;
        $count = UserFavorite::where(["meat_id"=>$meat->id,"user_id"=>$request->user_id])->count();
         $discount = $meat->discounts()->orderBy('amount', 'desc')->first();
          if(\Carbon\Carbon::now() < $discount->end_date &&  $discount->status_id==1){
               $meat->discount = $discount->amount;
               $meat->discount_type = $discount->discount_type->ar_name;
          }else 
          $meat->discount = -1;
       if($count>0)
            $flag = true;
            $stock = $meat->stock;
            $meat->is_fav = $flag;
            $meat->stock = $stock;
            
        return response()->json(
            $meat, 200);
    }
    public function home(Request $request){
        $discounts = Discount::take($request->limit)->get();
        $meats = Meat::orderBy('id', 'DESC')->with('stock')->take( $request->limit)->get();
         foreach( $meats as $meat){
          $discount = $meat->discounts()->orderBy('amount', 'desc')->first();
          if(\Carbon\Carbon::now() < $discount->end_date &&  $discount->status_id==1){
               $meat->discount = $discount->amount;
               $meat->discount_type = $discount->discount_type->ar_name;
          }else 
          $meat->discount = -1;
         
        }
        $orders = Meat::leftjoin('orders_meats', 'meats.id', 'orders_meats.meat_id')
        ->select([DB::raw('Count(orders_meats.id) as order_count'), 'meats.id', 'meats.ar_name', 
        'meats.cattels_types_id', 'meats.pic','meats.en_name','meats.ar_description','meats.en_description'])->
         orderByDesc('order_count')->groupBy('meats.id', 'meats.ar_name', 
        'meats.cattels_types_id', 'meats.pic')->with('stock')->take($request->limit)->get();
       
        $res = [
            
            'dicount'=> $discounts,
            'new_meats'=> $meats ,
            'most_order' => $orders,
    
         ];
         return response()->json(
            $res
        , 200);
    }
   
}
