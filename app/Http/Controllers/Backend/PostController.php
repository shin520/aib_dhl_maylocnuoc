<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Post;
use App\User;
use Newcategory;
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


class PostController extends ShareController
{
    public function index()
    {
        $posts = Post::orderBy('stt','asc')->orderBy('id','desc')->get();
        // $tags = Tag::all();
        return view('backend.posts.index', compact('posts'));
    }
    public function create()
    {
        $newcategories = Newcategory::all();
        // $tags = Tag::all();
        return view('backend.posts.create', compact('newcategories'));
    }

    public function edit(Request $request, $id)
    {
        $newcategories = Newcategory::all();
        // $tags = Tag::all();
        $post = Post::find($id);
        return view('backend.posts.edit', compact('newcategories','post'));
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
            'newcategories_id.required' => 'Vui lòng chọn Danh mục !',
            'published' => 'Vui lòng nhập đúng định dạng Ngày !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:posts',
            'newcategories_id' => 'required',
            // 'published' => 'nullable|date',
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
            // $extension = $file->getClientOriginalExtension(); // kq: png
            // $imgname = $file->getClientOriginalName();
            // $img_name = explode('.',$imgname)[0];
            // $img_extension = $file->getClientOriginalExtension();
            // $name_save = $img_name.'-'.'370x208'.'.'.$img_extension;
            // $name_save = $file->getClientOriginalName();
            // $name=explode('.',$name_save)[0]; // img
            // return $img->response();
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
            'published' => $request->published,
            'published' => Carbon::parse($request->published),
            'img'  => $name_save,
            'img_resize'  => $name_resize
        ];
        $post = Post::create($data);
        if ($post) {
            // $post->tags()->sync($request->tags_id);
            $post->newcategories()->sync($request->newcategories_id);
            return redirect()->route('backend.post.index')->with('success','Thêm Bài viết thành công !');
        }
        return redirect()->route('backend.post.index')->with('error','Thêm Bài viết thất bại !');

    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên bài viết !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả bài viết !',
            // 'content.required' => 'Vui lòng nhập Nội dung bài viết !',
            'slug.required'   => 'Vui lòng nhập URL bài viết !',
            'slug.unique'   => 'URL bài viết đã tồn tại !',
            'published' => 'Vui lòng nhập đúng định dạng Ngày !',
            'newcategories_id.required' => 'Vui lòng chọn Danh mục !',
            'img.image' => 'Vui lòng chọn hình ảnh !',
            'img.mines' => 'Định dạng hình ảnh không hợp lệ !',
            'img.max' => 'Dung lượng tối đa hình ảnh là 5MB !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:posts,slug,'.$id, //so sánh slug bỏ qua id chính nó
            'newcategories_id' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            // 'published' => 'nullable|date',
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $post->img;
            $name_resize = $post->img_resize; 
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
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $post->type         = $request->type;
        $post->stt          = $request->stt;
        $post->name         = $request->name;
        $post->descriptions = $request->descriptions;
        $post->is_featured  = $request->is_featured;
        $post->is_new       = $request->is_new;
        $post->hide_show    = $request->hide_show;
        $post->content      = $request->content;
        $post->slug         = Str::slug($request->slug,'-');
        $post->title        = $request->title;
        $post->keywords     = $request->keywords;
        $post->description  = $request->description;
        $post->status       = $request->status;
        $post->published    = $request->published;
        $post->img          = $name_save;
        Cache::forget($slug);
        $post->save();
        // sync newcategories
        $post->newcategories()->sync($request->newcategories_id);
        // $post->tags()->sync($request->tags_id);
        return redirect()->route('backend.post.index')->with('success','Cập nhật Bài viết thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return redirect()->route('backend.post.index')->with('success','Xóa Bài viết thành công !');
        }
            return redirect()->route('backend.post.index')->with('success','Bài viết không tồn tại !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Post::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Bài viết đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $post = Post::find($request->post_id);
        $post->is_featured = $request->is_featured;
        $post->save();
        return response()->json(['success'=>'Post Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $post = Post::find($request->post_id);
        $post->hide_show = $request->hide_show;
        $post->save();
        return response()->json(['success'=>'Post Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $post = Post::find($request->post_id);
        $post->is_new = $request->is_new;
        $post->save();
        return response()->json(['success'=>'Post Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $post = Post::find($request->post_id);
        $post->stt = $request->stt;
        $post->save();
        return response()->json(['success'=>'Post STT change successfully.']);
    }
}