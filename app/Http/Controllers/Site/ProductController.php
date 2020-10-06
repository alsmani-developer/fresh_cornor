<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Meat;
use App\MeatsRating;
use App\CattlesType;
use Cart;
use Illuminate\Support\Facades\Auth;
class ProductController extends BaseController
{
    public function show($id){
        $get_meat = Meat::findOrFail($id);
        $views = $get_meat->views + 1;
        $updateViews = $get_meat;
        $updateViews->views = $views;
        if(!session()->get($get_meat->en_name)){
            session()->put($get_meat->en_name, 1);
            $updateViews->update();
        }
        $meat_type = $get_meat->cattels_types_id;
        $relatedMeats = Meat::where('cattels_types_id', $meat_type)->take(4)->get();
        return view('site.product.show', compact('get_meat', 'relatedMeats'));
    }
    public function index(){
        $get_meats = Meat::orderByDesc('id')->paginate(16);
        $get_cats = CattlesType::get();
        return view('site.products.index', compact('get_meats', 'get_cats'));
    }
    public function category($type){
        $get_meats = Meat::orderByDesc('id')->
        where('cattels_types_id', $type)->paginate(16);
        $get_cat = CattlesType::findOrFail($type);
        return view('site.category.index', compact('get_meats', 'get_cat'));
    }
    public function addToCart(Request $request)
    {
        // return session()->all();
    if($request->qty  == 0){
        return redirect()->back()->with('error', 'المنتج غير متاح حاليا');
    }else{
    $product = Meat::find($request->input('productId'));
    $product_img = $product->pic;
    if($request->qty > $product->stock->quantity){
        return redirect()->back()->with('error', 'الكمية غير كافية');
    }else {
        $options = $request->except('_token', 'price', 'qty');
        Cart::add($product->id, $product->ar_name, $product->stock->price, $request->input('qty'), $options);
        // return session()->all();
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
    }
    }
    public function fetchRating($id){
        $get_meat = Meat::findOrFail($id);
        return view('site.product.rating', compact('get_meat'));
    }
    public function insertRating(Request $request){
    if(Auth::check()){
    $id  = $request->id;
    $productId = $_GET['productId'];
    $index = $_GET['index'];
    // if the session is set and the user rating is already a member
    $userId = Auth::user()->id;
	$checkRatings = MeatsRating::where('meat_id', $id)->first();
	// check if the user update this game or not
	if (!empty($checkRatings)) {
		$insertRating = MeatsRating::find($checkRatings->id);
		$insertRating->ratting = $index;
		$insertRating->meat_id = $productId;
		$insertRating->user_id = $userId;
        $insertRating->update();
        echo 'تم تعديل تقييمك بنجاح.';
        die();
	}else{
		$insertRating = new MeatsRating();
		$insertRating->ratting = $index;
		$insertRating->user_id = $userId;
		$insertRating->meat_id = $productId;
		$insertRating->save();
        echo 'تم اضافة تقييمك بنجاح';
        die();
	}
    }else{
        echo 'يجب ان تكون مسجلا لكي تتمكن من تقييم المنتج';
        die(1);
    }
    
    }
    public function searchProducts(Request $request){
        $search_text = $request->search_text;
        if($request->search_cate == 0){
            $get_cats = '';
            $get_meats = Meat::where('ar_name', 'LIKE', '%'.$request->search_text.'%')->paginate(15);
            if(!$get_meats){
            $get_meats = Meat::where('en_name', 'LIKE', '%'.$request->search_text.'%')->paginate(15);
            }
        }else{
            $get_cats = CattlesType::find($request->search_cate);
            $get_meats = Meat::where('ar_name', 'LIKE', '%'.$request->search_text.'%')
            ->where('cattels_types_id', $request->search_cate)->paginate(15);
            if(!$get_meats){
            $get_meats = Meat::where('en_name', 'LIKE', '%'.$request->search_text.'%')
            ->where('cattels_types_id', $request->search_cate)->paginate(15);
            }
        }
        return view('site.products.search-results', compact('get_meats', 'get_cats', 'search_text'));
    }
}
