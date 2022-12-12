<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Author;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorController extends ShareController
{
    public function edit(Request $request)
    {
        $author = Author::first();
        return view('backend.author.edit', compact('author'));
    }
    public function update(Request $request)
    {
        $author = Author::first();
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Tác giả !',
            'content.required' => 'Vui lòng nhập mô tả Tác giả !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            'content' => 'required|max:5000',
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
        }elseif(!$author->img){
            $name_save = 'placeholder.png';
        }else {
            $name_save = $author->img;
        } 
        $author->type          = $request->type;
        $author->name          = $request->name;
        $author->content       = $request->content;
        $author->hide_show     = $request->hide_show;
        $author->link_group    = $request->link_group;
        $author->link_author   = $request->link_author;
        $author->namebuttonone = $request->namebuttonone;
        $author->namebuttontwo = $request->namebuttontwo;
        $author->img           = $name_save;
        $author->save();
        if ($author->save()) {
            return redirect()->route('backend.author.edit')->with('success','Cập nhật thông tin Tác giả thành công !');
        }
            return redirect()->route('backend.author.edit')->with('success','Cập nhật thông tin Tác giả lỗi !');
    }
}