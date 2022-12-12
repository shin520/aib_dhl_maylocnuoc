<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Contact;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ContactController extends ShareController
{
    public function edit(Request $request)
    {
        $contact = Contact::first();
        return view('backend.contact.edit', compact('contact'));
    }
    public function update(Request $request)
    {
        $contact = Contact::first();
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Trang !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if ($request->hasFile('img')){
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
        }elseif(!$contact->img){
            $name_save = 'placeholder.png';
        }else {
            $name_save = $contact->img;
        }
        $contact->name         = $request->name;
        $contact->type         = $request->type;
        $contact->descriptions = $request->descriptions;
        $contact->hide_show    = $request->hide_show;
        $contact->content      = $request->content;
        $contact->title        = $request->title;
        $contact->keywords     = $request->keywords;
        $contact->description  = $request->description;
        $contact->img          = $name_save;
        $contact->save();
        if ($contact->save()) {
            return redirect()->route('backend.contact.edit')->with('success','Đã cập nhật thông tin Liên hệ thành công !');
        }
            return redirect()->route('backend.contact.edit')->with('success','Cập nhật thông tin Liên hệ lỗi !');
        
    }
}