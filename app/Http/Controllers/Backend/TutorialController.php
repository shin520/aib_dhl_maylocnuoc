<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Category;
use Tag;
use Tutorial;
use App\User;
use Cache;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class TutorialController extends ShareController
{
    public function index()
    {
        $tutorials = Tutorial::orderBy('stt','asc')->orderBy('id','desc')->get();
        $tags = Tag::all();
        $users = User::all();
        return view('backend.tutorials.index', compact('tutorials','tags','users'));
    }
    public function create()
    {
        $users = User::all();
        $tags = Tag::all();
        return view('backend.tutorials.create', compact('users','tags'));
    }

    public function edit(Request $request, $id)
    {
        $users = User::all();
        $tags = Tag::all();
        $tutorial = Tutorial::find($id);
        return view('backend.tutorials.edit', compact('users','tags','tutorial'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên bài viết !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả bài viết !',
            // 'content.required' => 'Vui lòng nhập Nội dung bài viết !',
            'slug.required'   => 'Vui lòng nhập URL bài viết !',
            'slug.unique'   => 'URL bài viết đã tồn tại !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:tutorials',
            // 'published' => 'nullable|date',
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
        } else {
            $name_save = 'placeholder.png';
        }
        if ($request->slug){
            $slug = $request->slug;
        }else {
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
            'published' => $request->published,
            'published' => Carbon::parse($request->published),
            'img' => $name_save
        ];
        $tutorial = Tutorial::create($data);
        if ($tutorial) {
            return redirect()->route('backend.tutorial.index')->with('success','Thêm Bài viết thành công !');
        }
            return redirect()->route('backend.tutorial.index')->with('error','Thêm Bài viết thất bại !');
    }
    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên bài viết !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả bài viết !',
            // 'content.required' => 'Vui lòng nhập Nội dung bài viết !',
            'slug.required'   => 'Vui lòng nhập URL bài viết !',
            'slug.unique'   => 'URL bài viết đã tồn tại !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:tutorials,slug,'.$id, //so sánh slug bỏ qua id chính nó
            // 'published' => 'nullable|date',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $tutorial->img; 
        }else {
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
        $tutorial->type         = $request->type;
        $tutorial->stt          = $request->stt;
        $tutorial->name         = $request->name;
        $tutorial->descriptions = $request->descriptions;
        $tutorial->is_featured  = $request->is_featured;
        $tutorial->is_new       = $request->is_new;
        $tutorial->hide_show    = $request->hide_show;
        $tutorial->content      = $request->content;
        $tutorial->slug         = Str::slug($request->slug,'-');
        $tutorial->title        = $request->title;
        $tutorial->keywords     = $request->keywords;
        $tutorial->description  = $request->description;
        $tutorial->status       = $request->status;
        $tutorial->published    = $request->published;
        $tutorial->img          = $name_save;
        Cache::forget($slug);
        $tutorial->save();
        return redirect()->route('backend.tutorial.index')->with('success','Cập nhật Bài viết thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $tutorial = Tutorial::find($id);
        if ($tutorial) {
            $tutorial->delete();
            return redirect()->route('backend.tutorial.index')->with('success','Xóa Bài viết thành công !');
        }
        return redirect()->route('backend.tutorial.index')->with('success','Bài viết không tồn tại !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Tutorial::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Bài viết đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $tutorial = Tutorial::find($request->tutorial_id);
        $tutorial->is_featured = $request->is_featured;
        $tutorial->save();
        return response()->json(['success'=>'Tutorial Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $tutorial = Tutorial::find($request->tutorial_id);
        $tutorial->hide_show = $request->hide_show;
        $tutorial->save();
        return response()->json(['success'=>'Tutorial Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $tutorial = Tutorial::find($request->tutorial_id);
        $tutorial->is_new = $request->is_new;
        $tutorial->save();
        return response()->json(['success'=>'Tutorial Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $tutorial = Tutorial::find($request->tutorial_id);
        $tutorial->stt = $request->stt;
        $tutorial->save();
        return response()->json(['success'=>'Tutorial STT change successfully.']);
    }
}