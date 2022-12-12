<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Setting;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class SettingController extends ShareController
{
    public function edit(Request $request){
        $setting = Setting::first();
        return view('backend.settings.edit', compact('setting'));
    }
    public function update(Request $request){
        $setting = Setting::first();
        $lang = [
            'nameindex.required' => 'Vui lòng nhập Tên Website !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'title.required' => 'Vui lòng nhập Tiêu đề Website !',
            'title.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'keywords.required' => 'Vui lòng nhập Từ khoá Website !',
            'keywords.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'description.required' => 'Vui lòng nhập Mô tả Website !',
            'description.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'titleadmin.required' => 'Vui lòng nhập Tiêu đề Admin Website !',
            'titleadmin.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'email.required' => 'Vui lòng nhập Email Admin Website !',
            'website.required' => 'Vui lòng nhập URL Website !',
            'copyright.required' => 'Vui lòng nhập Copyright Website !',
            'logoindex.required' => 'Vui lòng chọn Logo Website !',
            'faviconindex.required' => 'Vui lòng chọn Favicon Website !',
            'logoadmin.required' => 'Vui lòng chọn Logo Admin Website !',
            'faviconadmin.required' => 'Vui lòng chọn Favicon Admin Website !',
            'img.required' => 'Vui lòng chọn Hình đại diện chia sẻ Facebook !',
        ];
        $request->validate([
            'nameindex' => 'required|max:120',
            'title' => 'required|max:120',
            'keywords' => 'required|max:400',
            'description' => 'required|max:400',
            'email' => 'required|email',
            'website' => 'required|url',
            'copyright' => 'required',
            'logoindex'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'faviconindex'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'logoadmin'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'faviconadmin'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'img'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'header'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ], $lang);
        if ($request->hasFile('faviconindex')){
                $file = $request->file('faviconindex');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_faviconindex = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_faviconindex);
            }elseif(!$setting->faviconindex){
                $name_save_faviconindex = 'placeholder.png';
            }else{
                $name_save_faviconindex = $setting->faviconindex;
            } 

            if ($request->hasFile('faviconadmin')){
                $file = $request->file('faviconadmin');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_faviconadmin = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_faviconadmin);
            }elseif(!$setting->faviconadmin){
                $name_save_faviconadmin = 'placeholder.png';
            }else{
                $name_save_faviconadmin = $setting->faviconadmin;
            }
            if ($request->hasFile('logoindex')){
                $file = $request->file('logoindex');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_logoindex = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_logoindex);
            }elseif(!$setting->logoindex){
                $name_save_logoindex = 'placeholder.png';
            }else{
                $name_save_logoindex = $setting->logoindex;
            } 
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_img = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_img);
            }elseif(!$setting->img){
                $name_save_img = 'placeholder.png';
            }else{
                $name_save_img = $setting->img;
            } 
            if ($request->hasFile('logoadmin')){
                $file = $request->file('logoadmin');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_logoadmin = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_logoadmin);
            }elseif(!$setting->logoadmin){
                $name_save_logoadmin = 'placeholder.png';
            }else{
                $name_save_logoadmin = $setting->logoadmin;
            }

            if ($request->hasFile('banner_index')){
                $file = $request->file('banner_index');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_banner_index = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_banner_index);
            }elseif(!$setting->banner_index){
                $name_save_banner_index = 'placeholder_1300x350.png';
            }else{
                $name_save_banner_index = $setting->banner_index;
            }

            if ($request->hasFile('header')){
                $file = $request->file('header');
                $full_name_img = $file->getClientOriginalName();
                $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = $file->getClientOriginalExtension();
                $name_save_slug = Str::slug($name_without_ext, '-');
                $name_save_header = $name_save_slug.'.'.$ext;
                $res = $file->storeAs('public/uploads', $name_save_header);
            }elseif(!$setting->header){
                $name_save_header = 'placeholder.png';
            }else{
                $name_save_header = $setting->header;
            }
                $setting->type                    = $request->type;
                $setting->nameindex               = $request->nameindex;
                $setting->title                   = $request->title;
                $setting->keywords                = $request->keywords;
                $setting->description             = $request->description;
                $setting->copyright               = $request->copyright;
                $setting->facebook                = $request->facebook;
                $setting->twitter                 = $request->twitter;
                $setting->youtube                 = $request->youtube;
                $setting->uidfacebookadmin        = $request->uidfacebookadmin;
                $setting->appidfb                 = $request->appidfb;
                $setting->codehead                = $request->codehead;
                $setting->codebody                = $request->codebody;
                $setting->site_key                = $request->site_key;
                $setting->secret_key              = $request->secret_key;
                $setting->idanalytics             = $request->idanalytics;
                $setting->googlesiteverification  = $request->googlesiteverification;
                $setting->latitude                = $request->latitude;
                $setting->longitude               = $request->longitude;
                $setting->titleadmin              = $request->titleadmin;
                $setting->email                   = $request->email;
                $setting->website                 = $request->website;
                $setting->web                     = $request->web;
                $setting->address                 = $request->address;
                $setting->hotline_1               = $request->hotline_1;
                $setting->hotline_2               = $request->hotline_2;
                $setting->hotline_3               = $request->hotline_3;
                $setting->href_1                  = $request->href_1;
                $setting->href_2                  = $request->href_2;
                $setting->href_3                  = $request->href_3;
                $setting->faviconindex            = $name_save_faviconindex;
                $setting->faviconadmin            = $name_save_faviconadmin;
                $setting->img                     = $name_save_img;
                $setting->logoindex               = $name_save_logoindex;
                $setting->header                  = $name_save_header;
                $setting->logoadmin               = $name_save_logoadmin;
                $setting->banner_index               = $name_save_banner_index;
                $setting->lang                    = $request->lang;
                $setting->locale                  = $request->locale;
                $setting->author                  = $request->author;
                $setting->robots                  = $request->robots;
                $setting->maps                    = $request->maps;
                $setting->maps_1                  = $request->maps_1;
                $setting->save();
            if ($setting->save()){
                return redirect()->route('backend.setting.edit')->with('success','Cập nhật Thông tin cài đặt thành công !');
            }
                return redirect()->route('backend.setting.edit')->with('success','Cập nhật Thông tin cài đặt lỗi !');
            // viet rut gon code để update
            // public function update(Request $request)
            // {
            //     $settings = Settings::first()->update($request->all());
            //     return redirect()->route('admin.settings')->with('alert-success', ' Success');
            // }
    }
}