<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\Meat;
use App\Discount;
use App\OrdersMeat;
use App\OrdersMeatsDiscount;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;

class OrderApi extends APIController
{
    public function getAllOrders(){
        $query = Order::orderBy('id', 'DESC')->paginate(10);
        return  response()->json($query);
    }
    public function getUserOrder(User $user){
        if($user !=null){
            
            $orders = $user->orders;
            return $this->getResponce( $orders );

        }else  return response()->json([
            'success' => false,
            'message' => 'Sorry, the user not found'
        ], 404);
       
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
            //save order
            $order = new Order();
            
            $order->fill($request->except(['token','meats']));
            $save =  $order->save();
            if( $save ){
                //save order meats
                $meats = $request->meats;
                foreach($meats as $meat){
                    $order_meat = new OrdersMeat();
                    $order_meat->order_id=$order->id;
                    $order_meat->meat_id = $meat->meat_id;
                    $order_meat->quantity = $meat->quantity;
                    $order_meat->price = $meat->price*$meat->quantity;
                    $save = $order_meat->save();
                    if($meat->discount_id != -1){
                        //save order meats discount
                        $order_meat_discount = new OrdersMeatsDiscount();
                        $order_meat_discount->order_id = $order->id;
                        $order_meat_discount->meat_id = $meat->meat_id;
                        $order_meat_discount->discounti_id = $meat->discounti_id;
                        $order_meat_discount->discount_amount = $meat->discount_amount;
                        $save = $order_meat_discount->save();
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
    public function getDiscount(Request $request){
        $discounts = Discount::take($request->limit)->get();

        return response()->json([
           
            'data'=>$discounts
        ], 200);

    }
    public function getNewMeats(Request $request){
        
        $meats = Meat::orderBy('id', 'DESC')->take( $request->limit)->get();
        return response()->json([
            'success'   =>  true,
            'data'=>$meats
        ], 200);
    }
    public function getMeat(Meat $meat){

        return response()->json([
            'data'=>$meat
        ], 200);
    }
}
