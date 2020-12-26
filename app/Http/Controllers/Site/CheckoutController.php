<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersMeat;
use App\OrdersMeatsDiscount;
use Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
class CheckoutController extends Controller
{
    public function getCheckout()
    {
        // return session()->all();
        return view('site.checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment'   =>  'required|int',
            'address'           =>  'required'
        ]);
        $order = Order::create([
            'user_id'           => auth()->user()->id,
            'payment_type_id'   =>  $request->payment,
            'address'               => $request->address,
            'dellivery_status_id'               => 1
        ]);
        if ($order) {
    
            $items = Cart::getContent();
    
            foreach ($items as $item)
            {
                $orderItem = new OrdersMeat([
                    'order_id'      =>  $order->id,
                    'meat_id'       =>  $item->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);
                
                 $orderItem->save();
            }
            if ($request->payment != 1) {
                $items = Cart::getContent();
    // return $items;
            foreach ($items as $item)
            {
                if($item->attributes->discount){
                    $orderItem->save();
                    $discount = new OrdersMeatsDiscount();
                    $discount->order_id = $order->id;
                    $discount->meat_id = $item->id;
                    $discount->discounti_id = $item->attributes->discount_id;
                    $discount->discount_amount = $item->attributes->discount;
                    $discount->save();
                }
                 
            }
            Cart::clear();
            return redirect('/account/orders')->withSuccess('تم اجرا الطلب بنجاح');
            }else{
                // return $request->stripeToken;
                $charge = Stripe::charges()->create([
                    'currency'  => 'SAR',
                    'source'    => $request->stripeToken,
                    'amount'    => $order->ordersMeats->sum('price')*$order->ordersMeats->sum('quantity'),
                    'description'=> 'Buying from fresh corner'
                ]);
                $chargeId = $charge['id'];
                if($chargeId){
                    $order->status_id = 3;
                    $order->update();
                    Cart::clear();
                    return redirect('/account/orders')->withSuccess('تم اجرا الطلب بنجاح');
                }else{
                    $order->status_id = 0;
                    $order->update();
                    return redirect()->back()->with('message','Order not placed');
                }
            }
        }
        return redirect()->back()->with('message','Order not placed');
    }
    public function stripeCheckout(Order $order){
        return view('site.checkout.stripe', compact('order'));
    }
    public function charge(Request $request){
        
    }
}


