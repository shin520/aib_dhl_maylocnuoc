<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;
use CartHelper;
use Product;
use Setting;
use App\Models\Coupon;
use Session,DB;

class CartCustomController extends ShareController
{
	// public function __construct(){
	// 	$this->middleware('account');
	// }
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon',$request->coupon)->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_secssion = Session::get('coupon');
                if ($coupon_secssion == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon' => $coupon->coupon,
                            'condition' => $coupon->condition,
                            'discount' => $coupon->discount,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon' => $coupon->coupon,
                        'condition' => $coupon->condition,
                        'discount' => $coupon->discount,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('success','Thêm mã giảm giá thành công !');
            }
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng hoặc không tồn tại !');
        }
       
    }
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if ($coupon == true) {
            Session::forget('coupon');
            return redirect()->back()->with('error','Xóa mã thành công !');
        }
    }
	public function view(){
        $setting = Setting::get()->first();
        $master = [
                    'title' => "Giỏ hàng",
                    'keywords' => "Giỏ hàng",
                    'description' => "Giỏ hàng",
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
		return view('frontend.checkout.show_order',compact('setting','master'));
	}
    public function add(CartHelper $cart, $id){
    	// echo $id;
    	$product = Product::find($id);
    	$cart->add($product);
    	// dd(session('cart')); //kiểm tra session
    	return redirect()->back();
    }
    public function add_now(CartHelper $cart, $id){
        // echo $id;
        $product = Product::find($id);
        $cart->add($product);
        // dd(session('cart')); //kiểm tra session
        return redirect()->route('order.view');
    }
    public function add_now_quantity (Request $request, CartHelper $cart) {
        // dd($request->product);
        // echo $id;
        if ($request->buy_now == 1) {
            $product = Product::find($request->product);
            $cart->add($product,$request->qty);
            // dd(session('cart')); //kiểm tra session
            return redirect()->route('order.view');
        } else{
            $product = Product::find($request->product);
            $cart->add($product,$request->qty);
            // dd(session('cart')); //kiểm tra session
            // return redirect()->route('order.view');
            return redirect()->back()->with('success','Đã thêm Món vào Giỏ hàng.');
        }
    }
    // public function add_to_cart_quantity (CartHelper $cart, $id) {
    //     // echo $id;
    //     $product = Product::find($id);
    //     $cart->add($product);
    //     return redirect()->back();
    // }
    public function remove(CartHelper $cart, $id){
    	$cart->remove($id);
    	return redirect()->back();
    }
    public function update(CartHelper $cart, $id){
    	$quantity = request()->quantity ? request()->quantity : 1;
    	$cart->update($id,$quantity);
    	return redirect()->back();
    }
    public function clear(CartHelper $cart){
    	$cart->clear();
        Session::forget('coupon');
    	return redirect()->route('frontend.home.index');
    }

    public function update_cart (Request $request,CartHelper $cart) {
        //{quantity: quantity,position_row:position_row,id:id}
        $quantity_product = $request->quantity;
        $position_row = $request->position_row;
        $id = $request->id;

        $product = DB::table('products')->where('id',$id)->first();
        $subtotal = $quantity_product * $product->selling_price;
        $cart->update($id,$quantity_product);
        $cart_total = 0;
        //dd($cart);
        foreach ($cart->items as $item) {
            $subtotalCart = $item["sale_price"] * $item["quantity"];
            $cart_total += $subtotalCart; 
        }

        return response()->json([
            'quantity' => $cart,
            'subtotal' => number_format($subtotal)."₫",
            'total' => number_format($cart_total)."₫"
        ]);
    }
}
