<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersMeat;
use Cart;

use PayPal\Api\Payer;
use PayPal\Api\Item;
use Mockery\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
class CheckoutController extends Controller
{
    private $ApiContext;
    private $OAuthTokenCredential;
    public function __construct()
    {
        if(config('paypal.settings.mode') == 'live'){
            $this->clientId = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        }else{
            $this->clientId = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        $this->ApiContext = new ApiContext(new OAuthTokenCredential($this->clientId, $this->secret));
        $this->ApiContext->setConfig(config('paypal.settings'));
    }
    public function saveLatLng(Request $request){
        session()->put('lat', $request->lat);
        session()->put('lng', $request->lng);
        echo 'lat: ' . session()->get('lat') . ' | lng: ' . session()->get('lng');
    }
    public function getCheckout()
    {
        // return session()->all();
        return view('site.checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $order = Order::create([
            'user_id'           => auth()->user()->id,
            'payment_type_id'   =>  $request->cash,
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
            return redirect('/checkout/payment/complete')->withSuccess('تم اجرا الطلب بنجاح');
        }

       
        return redirect()->back()->with('message','Order not placed');
    }
    public function complete(Request $request)
    {
    $order = Order::where('user_id', auth()->user()->id)->first();

    Cart::clear();
    return view('site.checkout.success', compact('order'));
    }
}
