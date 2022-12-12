<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Procatone;
use Procattwo;
// use App\Models\Procatone;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProcatoneController extends ShareController
{
    public function index()
    {
        $data = Procatone::select('name', 'id', 'parent_id')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();
        // $cat = Procatone::query()
        //         ->whereNull('parent_id')
        //         ->with([
        //             'child' => function($query){
        //                 $query->select([
        //                     'id',
        //                     'name',
        //                     'parent_id',
        //                 ]);
        //             }
        //         ])
        //         ->select([
        //             'id',
        //             'name',
        //             'parent_id',
        //         ])
        //         ->get()->toArray();
        return view('backend.procatones.index', compact('procatones','data'));
    }
    public function create()
    {
        // $procatones = Procatone::all();
        // $procatones = Procatone::where('parent_id',0)->get();
        $parent = Procatone::select('name', 'id', 'parent_id')->get();
        // dd($parent);
        $procatones = Procatone::get();
        return view('backend.procatones.create', compact('procatones','parent'));
    }

    public function edit(Request $request, $id)
    {
        $procatone = Procatone::find($id);
        $procatones = Procatone::get();
        return view('backend.procatones.edit', compact('procatone','procatones'));
    }

    public function store(Request $request) // Tạo mới productcategory
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique'   => 'URL danh mục đã tồn tại !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug'  => 'required|max:255|unique:procatones',
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
        $data = [
            'type' => $request->type,
            'parent_id' => $request->parent_id,
            'stt' => $request->stt,
            'name' => $request->name,
            'descriptions' => $request->descriptions,
            'hide_show' => $request->hide_show,
            'show_nav' => $request->show_nav,
            'is_featured' => $request->is_featured,
            'slug'  => Str::slug($request->slug,'-'),
            'title' => $request->title,
            'keywords' => $request->keywords,
            'description' => $request->description,
            'status' => $request->status,
            'img'  => $name_save
        ];
        $procatone = Procatone::create($data);
        if ($procatone) {
            // $procatone->products()->sync($request->products_id);
            return redirect()->route('backend.procatone.index')->with('success','Thêm Danh mục thành công !');
        }
            return redirect()->route('backend.procatone.index')->with('error','Thêm Danh mục thất bại !');
    }

    public function update(Request $request, $id)
    {
        $procatone = Procatone::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique'   => 'URL danh mục đã tồn tại !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug'  => 'required|max:120|unique:procatones,slug,'.$id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $procatone->img; 
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
        $procatone               = Procatone::find($id);
        $procatone->type         = $request->type;
        $procatone->stt          = $request->stt;
        $procatone->name         = $request->name;
        $procatone->parent_id    = $request->parent_id;
        $procatone->descriptions = $request->descriptions;
        $procatone->hide_show    = $request->hide_show;
        $procatone->show_nav     = $request->show_nav;
        $procatone->is_featured  = $request->is_featured;
        $procatone->slug         = Str::slug($request->slug,'-');
        $procatone->title        = $request->title;
        $procatone->keywords     = $request->keywords;
        $procatone->description  = $request->description;
        $procatone->status       = $request->status;
        $procatone->img          = $name_save;
        Cache::forget($slug);
        $procatone->save();
        return redirect()->route('backend.procatone.index')->with('success','Cập nhật Danh mục thành công !');

    }

    public function destroy(Request $request, $id)
    {
        // $countProcate2 = Procattwo::where('procatone_id', $id)->count();
        // if ($countProcate2 > 0) {
        //     return redirect()->route('backend.procatone.index')->with('danger','Bạn phải xóa danh mục 2 trước !'); 
        // }
        // $procatone = Procatone::find($id);
        // $parent = Procatone::where('parent_id',$id)->count();
        // if ($procatone && $parent == 0) {
        //     $procatone->delete();
        //     return redirect()->route('backend.procatone.index')->with('success','Xóa Danh mục thành công !');
        // }
        //     return redirect()->route('backend.procatone.index')->with('success','Không xóa được danh mục !');
        $getDataDelete = Procatone::all();
        $deleteChild = deleteMultiLevel($getDataDelete,$id);
        $deleteChild[] = (int)$id;
        Procatone::whereIn('id',$deleteChild)->delete();
        return redirect()->route('backend.procatone.index')->with('success','Xóa Danh mục thành công !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Procatone::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_featured = $request->is_featured;
        $procatone->save();
        return response()->json(['success'=>'Procatone Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->hide_show = $request->hide_show;
        $procatone->save();
        return response()->json(['success'=>'Procatone Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_new = $request->is_new;
        $procatone->save();
        return response()->json(['success'=>'Procatone Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->stt = $request->stt;
        $procatone->save();
        return response()->json(['success'=>'Procatone STT change successfully.']);
    }
}