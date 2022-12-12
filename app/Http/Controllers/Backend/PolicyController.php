<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Category;
use Tag;
use Policy;
use App\User;
use Cache;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class PolicyController extends ShareController
{
    public function index()
    {
        $policies = Policy::orderBy('stt','asc')->orderBy('id','desc')->get();
        $tags = Tag::all();
        $users = User::all();
        return view('backend.policies.index', compact('policies','tags','users'));
    }
    public function create()
    {
        $users = User::all();
        $tags = Tag::all();
        return view('backend.policies.create', compact('users','tags'));
    }

    public function edit(Request $request, $id)
    {
        $users = User::all();
        $tags = Tag::all();
        $policy = Policy::find($id);
        return view('backend.policies.edit', compact('users','tags','policy'));
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
            'slug'  => 'required|max:120|unique:policies',
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
        }else {
            $name_save = 'placeholder.png';
        }
        if ($request->slug){
            $slug = $request->slug;
        }else {
            $slug = Str::slug($request->slug,'-');
        }
        $nowdate = Carbon::now()->toDateTimeString();
        if (!$request->published){
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
            'img'  => $name_save
        ];
        $policy = Policy::create($data);
        if ($policy) {
            return redirect()->route('backend.policy.index')->with('success','Thêm Bài viết thành công !');
        }
            return redirect()->route('backend.policy.index')->with('error','Thêm Bài viết thất bại !');

    }
    public function update(Request $request, $id)
    {
        $policy = Policy::find($id);
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
            'slug'  => 'required|max:120|unique:policies,slug,'.$id, //so sánh slug bỏ qua id chính nó
            // 'published' => 'nullable|date',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $policy->img; 
        }else {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res  = $file->storeAs('public/uploads', $name_save);
        }
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $policy->type         = $request->type;
        $policy->stt          = $request->stt;
        $policy->name         = $request->name;
        $policy->descriptions = $request->descriptions;
        $policy->is_featured  = $request->is_featured;
        $policy->is_new       = $request->is_new;
        $policy->hide_show    = $request->hide_show;
        $policy->content      = $request->content;
        $policy->slug         = Str::slug($request->slug,'-');
        $policy->title        = $request->title;
        $policy->keywords     = $request->keywords;
        $policy->description  = $request->description;
        $policy->status       = $request->status;
        $policy->published    = $request->published;
        $policy->img          = $name_save;
        Cache::forget($slug);
        $policy->save();
        return redirect()->route('backend.policy.index')->with('success','Cập nhật Bài viết thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $policy = Policy::find($id);
        if ($policy) {
            $policy->delete();
            return redirect()->route('backend.policy.index')->with('success','Xóa Bài viết thành công !');
        }
            return redirect()->route('backend.policy.index')->with('success','Bài viết không tồn tại !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Policy::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Bài viết đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $policy = Policy::find($request->policy_id);
        $policy->is_featured = $request->is_featured;
        $policy->save();
        return response()->json(['success'=>'Policy Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $policy = Policy::find($request->policy_id);
        $policy->hide_show = $request->hide_show;
        $policy->save();
        return response()->json(['success'=>'Policy Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $policy = Policy::find($request->policy_id);
        $policy->is_new = $request->is_new;
        $policy->save();
        return response()->json(['success'=>'Policy Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $policy = Policy::find($request->policy_id);
        $policy->stt = $request->stt;
        $policy->save();
        return response()->json(['success'=>'Policy STT change successfully.']);
    }
}