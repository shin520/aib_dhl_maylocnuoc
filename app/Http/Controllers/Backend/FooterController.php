<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Footer;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class FooterController extends ShareController
{
    public function edit(Request $request)
    {
        $footer = Footer::first();
        return view('backend.footer.edit', compact('footer'));
    }
    public function update(Request $request)
    {
        $footer = Footer::first();
        $lang = [
            'content.required' => 'Vui lòng nhập Nội dung Footer !'
        ];
        $request->validate([
            'content' => 'required',
        ], $lang);
        $footer->type         = $request->type;
        $footer->hide_show    = $request->hide_show;
        $footer->content      = $request->content;
        $footer->save();
        if ($footer->save()) {
            return redirect()->route('backend.footer.edit')->with('success','Cập nhật thông tin Footer thành công !');
        }
            return redirect()->route('backend.footer.edit')->with('success','Cập nhật thông tin Footer lỗi !');
        
    }
}