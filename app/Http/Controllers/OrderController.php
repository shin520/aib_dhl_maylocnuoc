<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;
use CartHelper;
use Product;
use Setting;
use Order;
use Orderdetail;
use Auth;
use Mail;
use Session;
use App\Models\Feeship;

class OrderController extends ShareController
{
	// public function __construct(){
 //        parent::__construct();
	// 	$this->middleware('account');
	// }
    public function delete_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if ($data['province_id']) {
            $feeship = Feeship::where('province_id',$data['province_id'])
            ->where('district_id',$data['district_id'])
            ->where('ward_id',$data['ward_id'])
            ->get();
            foreach ($feeship as $key => $fee) {
                Session::put('fee',$fee->fee_ship);
                Session::save();
            }
        }
    }
    public function selecthome(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'province') {
                $select_district = District::where('province_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option>Chọn Quận/Huyện</option>';
                foreach ($select_district as $key => $district){
                    $output.='<option value="'.$district->id.'">'.$district->name.'</option>';
                }
            }else{
                $select_ward = Ward::where('district_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option>Chọn Xã/Phường</option>';
                foreach ($select_ward as $key => $ward){
                    $output.='<option value="'.$ward->id.'">'.$ward->name.'</option>';
                }
            }
        }
        echo $output;
    }
	public function form(){
        $setting = Setting::get()->first();
        // $provinces = Province::get();
        // dd($provinces);
        $master = [
                    'title' => "Thanh toán",
                    'keywords' => "Thanh toán",
                    'description' => "Thanh toán",
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
		return view('frontend.checkout.checkout',compact('setting','master'));
	}
    public function getDistrictList(Request $request)
            {
                $districts = District::where("province_id",$request->province_id)
                ->pluck("name","id");
                return response()->json($districts);
            }

    public function getWardList(Request $request)
            {
                $wards = Ward::where("district_id",$request->district_id)
                ->pluck("name","id");
                return response()->json($wards);
            }
    public function success(){
        return view('frontend.checkout.success');
    }
    public function submit_form(Request $request, CartHelper $cart){

        $lang = [
            'name.required' => 'Vui lòng nhập Họ và Tên !',
            'phone.required' => 'Vui lòng nhập Số điện thoại !',
            'phone.min' => 'Số điện thoại phải đủ 10 số !',
            'phone.numeric' => 'Số điện thoại phải nhập dạng số !',
            'email.required' => 'Vui lòng nhập Email !',
            'email.email' => 'Địa chỉ email không hợp lệ !',
        ];
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10|numeric',
            'email' => 'required|email',
        ], $lang);
        // $account_id = Auth::guard('account')->user()->id;
        
        $cus_name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $email = $request->email;
        $note = $request->order_note;
        // $order_note = $request->note;
        if ($order = Order::create([
            // 'account_id' => $account_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'order_note' => $request->order_note,
        ])) {
            $order_id = $order->id;
            foreach ($cart->items as $product_id => $item) {
                $quantity = $item['quantity'];
                $price = $item['sale_price'];
                $name = $item['name'];
                $img = $item['img'];
                $total_item = $quantity*$price;
                Orderdetail::create([
                    'order_id' => $order_id,
                    'product_id' => $product_id,
                    'name' => $name,
                    'img' => $img,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_item' => $total_item
                ]);
            }
            $setting = Setting::get()->first();
            $web = $setting->website;
            $email_admin = $setting->email;
            Mail::send('frontend.email.success',[
                'cus_name' => $cus_name,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
                'note' => $note,
                'order' => $order,
                'order_id' => $order->id,
                // 'order_date' => $order->order_date,
                'items' => $cart->items,
                'web' => $setting->website
            ], function($mail) use($request,$web,$cus_name,$address,$phone,$email,$note,$email_admin){
                $mail->to($email,$cus_name);
                $mail->cc($email_admin);
                // $mail->from($request->email);
                $mail->subject('Đơn đặt hàng mới từ website: '.$web);
            });
            session(['order' => '']);
            return redirect()->back()->with('success','Quý khách đã đặt hàng thành công ! Chân thành cảm ơn');
        }else{
            return redirect()->back()->with('success','Có lỗi không mong muốn xảy ra, Vui lòng thử lại !');
        }
    }
}
