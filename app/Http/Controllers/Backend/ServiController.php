<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\User;
use App\Models\Servi;
// use Tag;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class ServiController extends ShareController
{
    public function index()
    {
        $servis = Servi::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.servis.index', compact('servis'));
    }
    public function create()
    {
        return view('backend.servis.create');
    }

    public function edit(Request $request, $id)
    {
        $servi = Servi::find($id);
        return view('backend.servis.edit', compact('servi'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên bài viết !',
            'slug.required'   => 'Vui lòng nhập URL bài viết !',
            'slug.unique'   => 'URL bài viết đã tồn tại !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required',
            'slug'  => 'required|unique:servis',
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
            $name_resize = $name_save_slug.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
            $path_resize = public_path('/uploads/thumbnail');
            $img_resize = Image::make($file)->resize(370, null, function ($constraint){
            $constraint->aspectRatio();})->save($path_resize.'/'.$name_resize);
        }else {
            $name_save = 'placeholder.png';
            $name_resize = 'placeholder.png';
        }
        if ($request->slug){
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $nowdate = Carbon::now()->toDateTimeString();
        if (!$request->published) {
            $nowdate;
        }
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'name' => $request->name,
            'descriptions' => $request->descriptions,
            'is_featured' => $request->is_featured,
            'is_new' => $request->is_new,
            'hide_show' => $request->hide_show,
            'content' => $request->content,
            'slug'  => Str::slug($request->slug,'-'),
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status,
            'img' => $name_save,
            'img_resize'  => $name_resize
        ];
        $servi = Servi::create($data);
        if ($servi) {
            return redirect()->route('backend.servi.index')->with('success','Thêm Bài viết thành công !');
        }
            return redirect()->route('backend.servi.index')->with('error','Thêm Bài viết thất bại !');

    }
    public function update(Request $request, $id)
    {
        $servi = Servi::find($id);
        $a = $request->all();
        // dd($a);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên bài viết !',
            'slug.required'   => 'Vui lòng nhập URL bài viết !',
            'slug.unique'   => 'URL bài viết đã tồn tại !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required',
            'slug'  => 'required|unique:servis,slug,'.$id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $servi->img;
            $name_resize = $servi->img_resize; 
        }else{
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $name_resize = $name_save_slug.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
            $path_resize = public_path('/uploads/thumbnail');
            $img_resize = Image::make($file)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path_resize.'/'.$name_resize);
        }
        if ($request->slug) {
            $slug = $request->slug;
        } else {
            $slug = Str::slug($request->slug,'-');
        }
        $servi->type         = $request->type;
        $servi->stt          = $request->stt;
        $servi->name         = $request->name;
        $servi->descriptions = $request->descriptions;
        $servi->is_featured  = $request->is_featured;
        $servi->is_new       = $request->is_new;
        $servi->hide_show    = $request->hide_show;
        $servi->content      = $request->content;
        $servi->slug         = Str::slug($request->slug,'-');
        $servi->title        = $request->title;
        $servi->keywords     = $request->keywords;
        $servi->description  = $request->description;
        $servi->status       = $request->status;
        $servi->published    = $request->published;
        $servi->img          = $name_save;
        Cache::forget($slug);
        $servi->save();
        return redirect()->route('backend.servi.index')->with('success','Cập nhật Bài viết thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $servi = Servi::find($id);
        if ($servi) {
            $servi->delete();
            return redirect()->route('backend.servi.index')->with('success','Xóa Bài viết thành công !');
        }
            return redirect()->route('backend.servi.index')->with('success','Bài viết không tồn tại !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Servi::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Bài viết đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->is_featured = $request->is_featured;
        $servi->save();
        return response()->json(['success'=>'Servi Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->hide_show = $request->hide_show;
        $servi->save();
        return response()->json(['success'=>'Servi Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->is_new = $request->is_new;
        $servi->save();
        return response()->json(['success'=>'Servi Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->stt = $request->stt;
        $servi->save();
        return response()->json(['success'=>'Servi STT change successfully.']);
    }
}