<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use About;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class AboutController extends ShareController
{
    public function edit(Request $request)
    {
        $about = About::first();
        return view('backend.about.edit', compact('about'));
    }
    public function update(Request $request)
    {
        $about = About::first();
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Trang !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res  = $file->storeAs('public/uploads', $name_save);
        }elseif(!$about->img){
            $name_save = 'placeholder.png';
        }else {
            $name_save = $about->img;
        } 
        $about->name            = $request->name;
        $about->name_en         = $request->name_en;
        $about->type            = $request->type;
        $about->descriptions    = $request->descriptions;
        $about->descriptions_en = $request->descriptions_en;
        $about->hide_show       = $request->hide_show;
        $about->content         = $request->content;
        $about->content_en      = $request->content_en;
        $about->title           = $request->title;
        $about->title_en        = $request->title_en;
        $about->keywords        = $request->keywords;
        $about->keywords_en     = $request->keywords_en;
        $about->description     = $request->description;
        $about->description_en  = $request->description_en;
        $about->img             = $name_save;
        $about->save();
        if ($about->save()) {
            return redirect()->route('backend.about.edit')->with('success','Cập nhật thông tin Giới thiệu thành công !');
        }
            return redirect()->route('backend.about.edit')->with('success','Cập nhật thông tin Giới thiệu lỗi !');
        
    }
}