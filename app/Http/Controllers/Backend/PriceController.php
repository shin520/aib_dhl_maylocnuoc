<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Price;
use Validate;
use Mail;
use App\Models\Setting;
use App\Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class PriceController extends ShareController
{
    public function index(){
        $prices = Price::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.prices.index', compact('prices'));
    }

    public function edit(Request $request, $id)
    {
        $price = Price::find($id);
        return view('backend.prices.edit', compact('price'));
    }

    public function store(Request $request)
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Họ Tên !',
            'phone.required' => 'Vui lòng nhập Số điện thoại !',
            'phone.min' => 'Vui lòng nhập Số điện thoại đủ 10 số !',
            'phone.max' => 'Số điện thoại không hợp lệ !',
            'email.required' => 'Vui lòng nhập Email !',
            'email.email' => 'Địa chỉ Email không hợp lệ !',
            'price.required' => 'Vui lòng nhập nội dung đăng ký báo giá !',
        ];
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10|max:10',
            'email' => 'required|email',
            'price' => 'required',
        ], $lang);
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'price' => $request->price,
            'read' => $request->read,
            'note' => $request->note
        ];

        $price = Price::create($data);
        $setting = Setting::get()->first();
        $web = $setting->website;
        $email_admin = $setting->email;
        $name_admin = $setting->nameindex;
        $hotline_admin = $setting->hotline_1;
        $href_admin = $setting->href_1;
        Mail::send('frontend.email.price',[
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'price' => $request->price
        ], function($mail) use($request,$web,$email_admin){
            $mail->to($email_admin,$request->name);
            $mail->subject('Thư đăng ký báo giá từ Website: '.$web);
        });
        Mail::send('frontend.email.pricecus',[
            'name' => $request->name,
            'phone' => $request->phone,
            'nameadmin' => $name_admin,
            'emailadmin' => $email_admin,
            'hotlineadmin' => $hotline_admin,
            'hrefadmin' => $href_admin,
            'email' => $request->email,
            'price' => $request->price
        ], function($mail) use($request,$name_admin){
            $mail->to($request->email);
            $mail->subject('Thư Cảm Ơn Quý khách từ: '.$name_admin);
        });

        if ($price) {
            return redirect()->route('frontend.price.index')->with('success','Đăng ký nhận Báo giá thành công ! Chúng tôi sẽ liên hệ lại với quý khách trong vòng 24h');
        }
            return redirect()->route('frontend.price.index')->with('error','Có lỗi xảy ra ! Xin vui lòng thử lại !');
    }

    public function update(Request $request, $id)
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Họ và Tên !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
        ], $lang);
        $price           = Price::find($id);
        $price->type     = $request->type;
        $price->stt      = $request->stt;
        $price->name     = $request->name;
        $price->phone    = $request->phone; 
        $price->email    = $request->email;
        $price->subject  = $request->subject;
        $price->price    = $request->price;
        $price->note     = $request->note;
        $price->read     = $request->read;
        $price->save();
        return redirect()->route('backend.price.index')->with('success','Cập nhật thông tin đăng ký báo giá thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $price = Price::find($id);
        if ($price) {
            $price->delete();
            return redirect()->route('backend.price.index')->with('success','Xóa thông tin đăng ký báo giá thành công !');
        }
            return redirect()->route('backend.price.index')->with('success','Thông tin đăng ký báo giá không tồn tại !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Price::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function Read(Request $request){
        $price = Price::find($request->price_id);
        $price->read = $request->read;
        $price->save();
        return response()->json(['success'=>'Price Read change successfully.']);
    }
    public function changeStt(Request $request){
        $price = Price::find($request->price_id);
        $price->stt = $request->stt;
        $price->save();
        return response()->json(['success'=>'Price STT change successfully.']);
    }
}