<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Order;
use Orderdetail;
// use Province;
// use District;
// use Ward;
use Validate;
// use App\Carbon\Carbon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class OrderController extends ShareController
{
    // public function getDistrictList(Request $request){
    //     $districts = District::where("province_id",$request->province_id)
    //     ->pluck("name","id");
    //     return response()->json($districts);
    // }
    // public function getWardList(Request $request){
    //     $wards = Ward::where("district_id",$request->district_id)
    //     ->pluck("name","id");
    //     return response()->json($wards);
    // }
    public function index(){
        $orders = Order::with('orderdetails')->orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.orders.index', compact('orders'));
    }
    public function create(){
        $carts = Payment::all();
        return view('frontend.cart.index', compact('carts'));
    }
    public function edit(Request $request, $id){
        // $item_details = Order::where('id','order_id')->with('orderdetails')->get();
        // dd($item_details)
        $order_detail = Order::find($id);
        $orderdetails = Orderdetail::where('order_id',$id)->get();
        // dd($orderdetails);
        // $order = Order::find($id)->with('orderdetails')->get();
        // dd($order);
        // $jsoncart = $cart->cart;
        // $decodes = json_decode($jsoncart, true);
        // $provinces = Province::get();
        return view('backend.orders.edit', compact('order_detail','orderdetails'));
    }
    public function update(Request $request, $id){
        $order = Order::find($id);
        $order->name        = $request->name;
        $order->phone       = $request->phone; 
        $order->email       = $request->email;
        $order->address     = $request->address;
        $order->transport   = $request->transport;
        $order->payment     = $request->payment;
        $order->order_note  = $request->order_note;
        $order->status      = $request->status;
        $order->save();
        if ($order->save()) {
            return redirect()->route('backend.order.index')->with('success','Cập nhật thông tin Đơn hàng thành công !');
        }
            return redirect()->route('backend.order.index')->with('success','Cập nhật thông tin Đơn hàng lỗi !');
    }
    public function destroyorderdetail(Request $request, $id){
        Orderdetail::find($id)->delete($id);
        return response()->json(['status'=>true,'message'=>'Xoá thành công']);
        // $orderdetail = Orderdetail::find($id);
        // if ($orderdetail){
        //     $orderdetail->delete($id);
        //     return redirect()->route('backend.cart.index')->with('success','Xóa thông tin Đơn hàng thành công !');
        // }
        //     return redirect()->route('backend.cart.index')->with('success','Xóa thông tin Đơn hàng lỗi s!');
    }
    public function destroy(Request $request, $id){
        // Order::find($id)->delete($id);
        // return response()->json(['status'=>true,'message'=>'Xoá thành công']);

        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return redirect()->route('backend.order.index')->with('success','Xóa đơn hàng thành công !');
        }
            return redirect()->route('backend.order.index')->with('success','Thông tin đơn hàng không tồn tại !');

    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Order::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function changeStt(Request $request){
        $order = Order::find($request->order_id);
        $order->stt = $request->stt;
        $order->save();
        return response()->json(['success'=>'Order STT change successfully.']);
    }
    public function postSearchTable(Request $request){
        $lang = [
            'fromday.required' => 'Vui lòng chọn ngày bắt đầu !',
            'today.required' => 'Vui lòng chọn ngày kết thúc !',
            'status.required' => 'Vui lòng chọn tình trạng !',
            'today.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu !',
        ];
        $request->validate([
            'fromday' => 'required|date',
            'today' => 'required|date|after_or_equal:fromday',
            'status' => 'required',
        ], $lang);
        $from = Carbon::parse($request->fromday)->startOfDay(); //2016-09-29 00:00:00.000000
        $to = Carbon::parse($request->today)->endOfDay(); //2016-09-29 23:59:59.000000
        // $from = $request->fromday;
        // $to = $request->today;
        $status = $request->status;
        $orders = Order::whereBetween('created_at', [$from, $to])->where('status',$status)->get();
        // $returnHTML = view('backend.orders.ajax-search')->with('orders', $orders)->render();
        return view('backend.orders.ajax-search', ['orders' => $orders]);
    }
}