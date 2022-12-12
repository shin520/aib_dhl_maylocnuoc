<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Slider;
use App\User;
use Tag;
use Cache;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class SliderController extends ShareController
{
    public function index()
    {
        $sliders = Slider::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.sliders.index', compact('sliders'));
    }
    public function create()
    {
        return view('backend.sliders.create');
    }

    public function edit(Request $request, $id)
    {
        $slider = Slider::find($id);
        return view('backend.sliders.edit', compact('slider'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'title.required' => 'Vui lòng nhập tiêu đề !',
            'title.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
        ];
        $request->validate([
            'title' => 'required|max:120',
            // 'published' => 'nullable|date',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500000',
        ], $lang);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
        }else{
            $name_save = 'placeholder.png';
        }
        $nowdate = Carbon::now()->toDateTimeString();
        if (!$request->published) {
            $nowdate;
        }
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'hide_show' => $request->hide_show,
            'title' => $request->title,
            'url' => $request->url,
            'icon' => $request->icon,
            'status' => $request->status,
            'published' => $request->published,
            'published' => Carbon::parse($request->published),
            'img'  => $name_save
        ];
        $slider = Slider::create($data);
        if ($slider and $slider->type == 'slider') {
            return redirect()->route('backend.slider.index')->with('success','Thêm Slider thành công !');
        }elseif ($slider and $slider->type == 'social') {
            return redirect()->route('backend.social.index')->with('success','Thêm liên kết Mạng xã hội thành công !');
        }else{
            return redirect()->route('backend.other.index')->with('success','Thêm liên kết Khác thành công !');
        }
    }
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $lang = [
            'title.required' => 'Vui lòng nhập tiêu đề !',
            'title.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'title' => 'required|max:120',
            // 'published' => 'nullable|date',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500000',
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $slider->img; 
        }else{
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
        }
        $slider->type         = $request->type;
        $slider->hide_show    = $request->hide_show;
        $slider->stt          = $request->stt;
        $slider->title        = $request->title;
        $slider->url          = $request->url;
        $slider->icon         = $request->icon;
        $slider->status       = $request->status;
        $slider->published    = $request->published;
        $slider->img          = $name_save;
        $slider->save();
        if ($slider and $slider->type == 'slider'){
           return redirect()->route('backend.slider.index')->with('success','Cập nhật Slider thành công !'); 
       }elseif ($slider and $slider->type == 'social') {
           return redirect()->route('backend.social.index')->with('success','Cập nhật liên kết Mạng xã hội thành công !');
       }elseif ($slider and $slider->type == 'other'){
        return redirect()->route('backend.other.index')->with('success','Cập nhật liên kết Khác thành công !');
       }elseif ($slider and $slider->type == 'slider' and !$slider->id) {
           return redirect()->route('backend.slider.index')->with('success','Slider không tồn tại !');
       }elseif ($slider and $slider->type == 'social' and !$slider->id) {
           return redirect()->route('backend.social.index')->with('success','Liên kết không tồn tại !');
       }else{
           return redirect()->route('backend.other.index')->with('success','Liên kết khác không tồn tại !');
       }
        
    }
    public function destroy(Request $request, $id)
    {
        $slider = Slider::find($id);
        if ($slider and $slider->type == 'slider') {
            $slider->delete();
            return redirect()->route('backend.slider.index')->with('success','Xóa Slider thành công !');
        }elseif ($slider and $slider->type == 'social') {
            $slider->delete();
            return redirect()->route('backend.social.index')->with('success','Xóa liên kết thành công !');
        }elseif ($slider and $slider->type == 'other') {
            $slider->delete();
            return redirect()->route('backend.other.index')->with('success','Xóa liên kết thành công !');
        }elseif ($slider and $slider->type == 'slider' and !$slider->id) {
            return redirect()->route('backend.slider.index')->with('success','Slider không tồn tại !');
        }elseif ($slider and $slider->type == 'social' and !$slider->id) {
            return redirect()->route('backend.social.index')->with('success','Liên kết không tồn tại !');
        }else{
            return redirect()->route('backend.other.index')->with('success','Liên kết khác không tồn tại !');
        }

    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Slider::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function hideShow(Request $request){
        $slider = Slider::find($request->slider_id);
        if ($slider and $slider->type == 'slider') {
            $slider->hide_show = $request->hide_show;
            $slider->save();
            return response()->json(['success'=>'Slider Hide Show change successfully.']);
        }elseif ($slider and $slider->type == 'social') {
            $slider->hide_show = $request->hide_show;
            $slider->save();
            return response()->json(['success'=>'Social Hide Show change successfully.']);
        }else{
            $slider->hide_show = $request->hide_show;
            $slider->save();
            return response()->json(['success'=>'Other Hide Show change successfully.']);
        }
    }
    public function changeStt(Request $request){
        $slider = Slider::find($request->slider_id);
        if ($slider and $slider->type == 'slider') {
            $slider->stt = $request->stt;
            $slider->save();
            return response()->json(['success'=>'Slider STT change successfully.']);
        }elseif ($slider and $slider->type == 'social') {
            $slider->stt = $request->stt;
            $slider->save();
            return response()->json(['success'=>'Social STT change successfully.']);
        }else {
            $slider->stt = $request->stt;
            $slider->save();
            return response()->json(['success'=>'Other STT change successfully.']);
        }
    }
}