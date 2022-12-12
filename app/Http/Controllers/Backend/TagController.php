<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Article;
use Tag;
use Cache;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class TagController extends ShareController
{
    public function index()
    {
        $tags = Tag::get();
        return view('backend.tags.index', compact('tags'));
    }
    public function view(Request $request, $id)
    {
        $tag      = Tag::find($id);
        $article  = Article::find($id);
        return view('backend.tags.view', compact('tag','article'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('backend.tags.create', compact('tags'));
    }

    public function edit(Request $request, $id)
    {

        $tag = Tag::find($id);
        return view('backend.tags.edit', compact('tag'));
    }

    public function store(Request $request) // tạo mới
    {

        $lang = [
            'name.required' => 'Vui lòng nhập Tên Tag !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'descriptions.required' => 'Vui lòng nhập Mô tả Tag !',
            'slug.required' => 'Vui lòng nhập URL Tag !',
            'slug.unique'   => 'URL Tag đã tồn tại !',
        ];

        $request->validate([
            'name' => 'required|max:120',
            'descriptions' => 'required|max:300',
            'slug'  => 'required|max:255|unique:tags'
        ], $lang);
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $data = [
            
            'name' => $request->name,
            'descriptions' => $request->descriptions,
            'hide_show' => $request->hide_show,
            'slug'  => Str::slug($request->slug,'-'),
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status,
        ];
        
        $tag = Tag::create($data);

        if ($tag) {
            $tag->articles()->sync($request->articles_id);
            return redirect()->route('backend.tag.index')->with('success','Thêm Tag thành công !');
        }
            return redirect()->route('backend.tag.index')->with('error','Thêm Tag thất bại !');
    }

    public function update(Request $request, $id)
    {
        $tag  = Tag::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Tag !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'descriptions.required' => 'Vui lòng nhập Mô tả Tag !',
            'slug.required' => 'Vui lòng nhập URL Tag !',
            'slug.unique'   => 'URL Tag đã tồn tại !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            'descriptions' => 'required|max:300',
            'slug'  => 'required|max:120|unique:tags,slug,'.$id,
    
        ], $lang);
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $tag->name         = $request->name;
        $tag->descriptions = $request->descriptions;
        $tag->hide_show    = $request->hide_show;
        $tag->slug         = Str::slug($request->slug,'-');
        $tag->title        = $request->title;
        $tag->keywords     = $request->keywords;
        $tag->description  = $request->description;
        $tag->status       = $request->status;
        Cache::forget($slug);
        $tag->save();

        return redirect()->route('backend.tag.index')->with('success','Cập nhật Tag thành công !');
    }
    public function destroy(Request $request, $id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return redirect()->route('backend.tag.index')->with('success','Xóa Tag thành công !');
        }
            return redirect()->route('backend.tag.index')->with('success','Tag không tồn tại !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Tag::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Tags đã chọn !']);
        }
}