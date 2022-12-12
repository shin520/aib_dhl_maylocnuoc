<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Newsletter;
use Validate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class NewsletterController extends ShareController
{
    public function index(){
        $newsletters = Newsletter::orderBy('stt', 'asc')->get();
        return view('backend.newsletters.index', compact('newsletters'));
    }
    public function edit(Request $request, $id){
        $newsletter = Newsletter::find($id);
        return view('backend.newsletters.edit', compact('newsletter'));
    }
    public function store(Request $request){
        $request->validate(
            [
            'email' => 'required|email|unique:newsletters',
            ],
            [
            'email.required' => 'Vui lòng nhập địa chỉ email !',
            'email.email' => 'Email không đúng định dạng !',
            'email.unique' => 'Email đã tồn tại trên hệ thống !',
        ]);
        $data = [
            'stt' => $request->stt,
            'read' => $request->read,
            'email' => $request->email,
        ];
        $newsletter = Newsletter::create($data);
        if ($newsletter) {
            return redirect()->back()->with('Swal.fire','success');
        }
            return redirect()->back();
    }
    public function update(Request $request, $id){
        $newsletter = Newsletter::find($id);
        $request->validate(
            [
            'email' => 'required|email|unique:newsletters,email,'.$id,
            ],
            [
            'email.required' => 'Vui lòng nhập địa chỉ email !',
            'email.email' => 'Email không đúng định dạng !',
            'email.unique' => 'Email đã tồn tại trên hệ thống !',
        ]);
        $newsletter->stt   = $request->stt;
        $newsletter->read  = $request->read;
        $newsletter->email = $request->email;
        $newsletter->note  = $request->note;
        $newsletter->save();
        if ($newsletter->save()) {
            return redirect()->route('newsletter.index')->with('success','Cập nhật Newsletter thành công !');
        }
            return redirect()->route('newsletter.index')->with('success','Cập nhật Newsletter lỗi !');
    }
    public function destroy(Request $request, $id){
        $newsletter = Newsletter::find($id);
        if ($newsletter){
            $newsletter->delete();
            return redirect()->route('newsletter.index')->with('success','Xóa email thành công !');
        }
            return redirect()->route('newsletter.index')->with('success','Xóa email lỗi !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Newsletter::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các email đã chọn !']);
    }
}