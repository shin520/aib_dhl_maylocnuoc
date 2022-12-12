<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Contactform;
use Validate;
use Mail;
use App\Models\Setting;
use App\Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ContactformController extends ShareController
{
    public function index(){
        $contactforms = Contactform::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.contactforms.index', compact('contactforms'));
    }
    public function edit(Request $request, $id)
    {
        $contactform = Contactform::find($id);
        return view('backend.contactforms.edit', compact('contactform'));
    }

    public function store(Request $request)
    {
        $secret_key = Setting::first()->secret_key;
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $data = [
                'secret' => $secret_key,
                'response' => $request->recaptcha,
                'remoteip' => $remoteip
            ];
        $options = [
                'http' => [
                  'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                  'method' => 'POST',
                  'content' => http_build_query($data)
                ]
            ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);


        if ($resultJson->success != true) {
                return back()->withErrors(['captcha' => 'Captcha đã hết hạn']);
        }

        if ($resultJson->score >= 0.3) {

            $data_info = [
                'type' => $request->type,
                'stt' => $request->stt,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                // 'subject' => $request->subject,
                'contactcontent' => $request->contactcontent,
                'read' => $request->read,
                'note' => $request->note
            ];

            $contact = Contactform::create($data_info);

            return back()->with('success','Đã gửi thư, chúng tôi sẽ phản hồi lại cho bạn ngay');
        } else {
                alert()->success('Lỗi','Đã có lỗi xảy ra !');
                return back()->withErrors(['captcha' => 'Captcha đã hết hạn']);
        }
        $setting = Setting::get()->first();
        $web = $setting->website;
        $email_admin = $setting->email;
        Mail::send('frontend.email.contact',[
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            // 'subject' => $request->subject,
            'contactcontent' => $request->contactcontent
        ], function($mail) use($request,$web,$email_admin){
            $mail->to($email_admin);
            // $mail->cc('trinhcongtriqn@gmail.com');
            $mail->from($request->email);
            $mail->subject('Thư liên hệ từ Website: '.$web);
        });


        if ($contactform) {
            return redirect()->route('frontend.contact.index')->with('success','Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ trả lời bạn sớm nhất có thể.');
        }
            return redirect()->route('frontend.contact.index')->with('success','error');
        
    }

    public function update(Request $request, $id)
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
        ], $lang);
        $contactform          = Contactform::find($id);
        $contactform->type    = $request->type;
        $contactform->stt     = $request->stt;
        $contactform->name    = $request->name;
        $contactform->address = $request->address;
        $contactform->phone   = $request->phone; 
        $contactform->email   = $request->email;
        $contactform->subject = $request->subject;
        $contactform->contactcontent = $request->contactcontent;
        $contactform->note    = $request->note;
        $contactform->read    = $request->read;
        $contactform->save();
        return redirect()->route('backend.contactform.index')->with('success','Cập nhật thông tin liên hệ thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $contactform = Contactform::find($id);
        if ($contactform) {
            $contactform->delete();
            return redirect()->route('backend.contactform.index')->with('success','Xóa thông tin liên hệ thành công !');
        }
            return redirect()->route('backend.contactform.index')->with('success','Thông tin liên hệ không tồn tại !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Contactform::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function Read(Request $request){
        $contactform = Contactform::find($request->contactform_id);
        $contactform->read = $request->read;
        $contactform->save();
        return response()->json(['success'=>'Contactform Read change successfully.']);
    }
    public function changeStt(Request $request){
        $contactform = Contactform::find($request->contactform_id);
        $contactform->stt = $request->stt;
        $contactform->save();
        return response()->json(['success'=>'Contactform STT change successfully.']);
    }
}