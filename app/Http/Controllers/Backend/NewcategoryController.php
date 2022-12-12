<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Newcategory;
use Cache;
use Validate;
use App\Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class NewcategoryController extends ShareController
{
    public function index()
    {
        $newcategories = Newcategory::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.newcategories.index', compact('newcategories'));
    }

    public function create()
    {
        $newcategories = Newcategory::all();
        return view('backend.newcategories.create', compact('newcategories'));
    }

    public function edit(Request $request, $id)
    {
        $newcategory = Newcategory::find($id);
        return view('backend.newcategories.edit', compact('newcategory'));
    }

    public function store(Request $request) // Tạo mới category
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique'   => 'URL danh mục đã tồn tại !',
            'img.image'   => 'Vui lòng chọn hình ảnh !',
            'img.mines'   => 'Định dạng hình ảnh không hợp lệ !',
            'img.max'   => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug'  => 'required|max:255|unique:newcategories',
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
            $res = $file->storeAs('public/uploads', $name_save);
        }else {
            $name_save = 'placeholder.png';
        }
        if ($request->slug){
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'name' => $request->name,
            'img'  => $name_save,
            'descriptions' => $request->descriptions,
            'hide_show' => $request->hide_show,
            'show_nav' => $request->show_nav,
            'slug'  => Str::slug($request->slug,'-'),
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status
        ];
        $newcategory = Newcategory::create($data);
        if ($newcategory) {
            $newcategory->posts()->sync($request->posts_id);
            return redirect()->route('backend.newcategory.index')->with('success','Thêm Danh mục thành công !');
        }
            return redirect()->route('backend.newcategory.index')->with('error','Thêm Danh mục thất bại !');
    }

    public function update(Request $request, $id)
    {
        $newcategory = Newcategory::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max' => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique' => 'URL danh mục đã tồn tại !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug' => 'required|max:120|unique:newcategories,slug,'.$id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $newcategory->img; 
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
        if ($request->slug){
            $slug = $request->slug;
        }else {
            $slug = Str::slug($request->slug,'-');
        }
        $newcategory               = Newcategory::find($id);
        $newcategory->type         = $request->type;
        $newcategory->stt          = $request->stt;
        $newcategory->name         = $request->name;
        $newcategory->descriptions = $request->descriptions;
        $newcategory->hide_show    = $request->hide_show;
        $newcategory->show_nav     = $request->show_nav;
        $newcategory->slug         = Str::slug($request->slug,'-');
        $newcategory->title        = $request->title;
        $newcategory->keywords     = $request->keywords;
        $newcategory->description  = $request->description;
        $newcategory->status       = $request->status;
        $newcategory->img          = $name_save;
        Cache::forget($slug);
        $newcategory->save();
        return redirect()->route('backend.newcategory.index')->with('success','Cập nhật Danh mục thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $newcategory = Newcategory::find($id);
        if ($newcategory) {
            $newcategory->delete();
            return redirect()->route('backend.newcategory.index')->with('success','Xóa Danh mục thành công !');
        }
            return redirect()->route('backend.newcategory.index')->with('success','Danh mục không tồn tại !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Newcategory::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $newcategory = Newcategory::find($request->newcategory_id);
        $newcategory->is_featured = $request->is_featured;
        $newcategory->save();
        return response()->json(['success'=>'Newcategory Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $newcategory = Newcategory::find($request->newcategory_id);
        $newcategory->hide_show = $request->hide_show;
        $newcategory->save();
        return response()->json(['success'=>'Newcategory Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $newcategory = Newcategory::find($request->newcategory_id);
        $newcategory->is_new = $request->is_new;
        $newcategory->save();
        return response()->json(['success'=>'Newcategory Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $newcategory = Newcategory::find($request->newcategory_id);
        $newcategory->stt = $request->stt;
        $newcategory->save();
        return response()->json(['success'=>'Newcategory STT change successfully.']);
    }
}