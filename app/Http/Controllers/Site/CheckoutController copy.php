<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersMeat;
use App\OrdersMeatsDiscount;
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
        }

        if ($order) {
            if ($request->payment != 1) {
                $items = Cart::getContent();
    // return $items;
            foreach ($items as $item)
            {
                $orderItem = new OrdersMeat([
                    'order_id'      =>  $order->id,
                    'meat_id'       =>  $item->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->getPriceSum()
                ]);
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
                // Create a new instance of Payer class
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");
            // Adding items to the list
            $items = array();
            foreach ($order->ordersMeats as $item)
            {
                $orderItems[$item->id] = new Item();
                $orderItems[$item->id]->setName($item->meat->ar_name)
                    ->setCurrency('USD')
                    ->setDescription('buying ' . $item->meat->en_name)
                    ->setQuantity($item->quantity)
                    ->setPrice($item->price);

                array_push($items, $orderItems[$item->id]);
            }
            $orderItems = new Item();
                $orderItems->setName('hey')
                    ->setCurrency('USD')
                    ->setDescription('buying ')
                    ->setQuantity($order->ordersMeats->sum('quantity'))
                    ->setPrice($item->price);
            $itemList = new ItemList();
            $itemList->setItems([$orderItems]);
            // Create chargeable amount
            $amount = new Amount();
            $amount->setCurrency('USD')
                    ->setTotal($order->ordersMeats->sum('price')*$order->ordersMeats->sum('quantity'));
            // Creating a transaction
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('buying from fresh corner');
            // Setting up redirection urls
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl(route('checkout.payment.complete'))
                        ->setCancelUrl(route('checkout.index'));
            // Creating payment instance
            $payment = new Payment();
            $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));
            try {

                $payment->create($this->ApiContext);
    
            } catch (PayPalConnectionException $exception) {
                echo $exception->getCode(); // Prints the Error Code
                echo $exception->getData(); // Prints the detailed error message
                exit(1);
            } catch (Exception $e) {
                echo $e->getMessage();
                exit(1);
            }
            $approvalUrl = $payment->getApprovalLink();
            return redirect($approvalUrl);
            exit;
            }
            
        }
        return redirect()->back()->with('message','Order not placed');
    }
    public function complete(Request $request)
    {
    $paymentId = $request->input('paymentId');
    $payerId = $request->input('PayerID');

    $status = $this->payPal->completePayment($paymentId, $payerId);

    $order = Order::where('id', $status['invoiceId'])->first();
    $order->status = 1;
    $order->payment_status = 1;
    $order->payment_type_id = 1;
    $order->save();

    Cart::clear();
    return view('site.checkout.success', compact('order'));
    }
}


