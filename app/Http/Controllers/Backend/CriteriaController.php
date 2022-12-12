<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\Models\Criteria;
use Str;
use Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CriteriaController extends ShareController
{
    public function index()
    {
        $criterias = Criteria::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.criterias.index', compact('criterias'));
    }
    public function create()
    {
        return view('backend.criterias.create');
    }

    public function edit(Request $request, $id)
    {
        $criteria = Criteria::find($id);
        return view('backend.criterias.edit', compact('criteria'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required' => 'Vui lòng nhập tiêu đề !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required|max:120',
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
            'stt' => $request->stt,
            'hide_show' => $request->hide_show,
            'name' => $request->name,
            'content' => $request->content,
            'img'  => $name_save
        ];
        $criterias = Criteria::create($data);
        return redirect()->route('backend.criteria.index')->with('success','Thêm dữ liệu thành công !');
    }
    public function update(Request $request, $id)
    {
        $criterias = Criteria::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập tiêu đề !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500000',
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $criterias->img;
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
        $criterias->hide_show      = $request->hide_show;
        $criterias->stt            = $request->stt;
        $criterias->name           = $request->name;
        $criterias->content        = $request->content;
        $criterias->img            = $name_save;
        $criterias->save();
        return redirect()->route('backend.criteria.index')->with('success','Thêm dữ liệu thành công !');
    }
    public function destroy(Request $request, $id)
    {
        $criterias = Criteria::find($id);
        $criterias->delete();
        return redirect()->route('backend.criteria.index')->with('success','Xóa dữ liệu thành công !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Criteria::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function hideShow(Request $request){
        $criterias = Criteria::find($request->id);
        $criterias->hide_show = $request->hide_show;
        $criterias->save();
        return response()->json(['success'=>'Other Hide Show change successfully.']);
    }
    public function changeStt(Request $request){
        $criterias = Criteria::find($request->id);
        $criterias->stt = $request->stt;
        $criterias->save();
        return response()->json(['success'=>'Data number change successfully.']);
    }
}