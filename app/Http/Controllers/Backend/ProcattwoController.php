<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Procattwo;
use Procatone;
use Procatthree;
// use App\Models\Procattwo;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProcattwoController extends ShareController
{
    public function index()
    {
        $data = Procattwo::select('name', 'id', 'parent_id')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procattwos = Procattwo::with('procatone')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatones = Procatone::all();
        // $cat = Procattwo::query()
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
                //dd($procattwos);
        return view('backend.procattwos.index', compact('procattwos','procatones','data'));
    }
    public function create()
    {
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();
        // $procattwos = Procattwo::all();
        // $procattwos = Procattwo::where('parent_id',0)->get();
        $parent = Procattwo::select('name', 'id', 'parent_id')->get();
        // dd($parent);
        $procattwos = Procattwo::get();
        return view('backend.procattwos.create', compact('procattwos','procatones','parent'));
    }

    public function edit(Request $request, $id)
    {
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();
        $procattwo = Procattwo::find($id);
        $procattwos = Procattwo::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.procattwos.edit', compact('procattwo','procattwos', 'procatones'));
    }

    public function store(Request $request) // Tạo mới productcategory
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique'   => 'URL danh mục đã tồn tại !',
            'procatone_id.required' => 'Vui lòng chọn danh mục !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug'  => 'required|max:255|unique:procattwos',
            'procatone_id' => 'required',
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
            'procatone_id' => $request->procatone_id,
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
        $procattwo = Procattwo::create($data);
        if ($procattwo) {
            // $procattwo->products()->sync($request->products_id);
            return redirect()->route('backend.procattwo.index')->with('success','Thêm Danh mục thành công !');
        }
            return redirect()->route('backend.procattwo.index')->with('error','Thêm Danh mục thất bại !');
    }

    public function update(Request $request, $id)
    {
        $procattwo = Procattwo::find($id);
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
            'slug'  => 'required|max:120|unique:procattwos,slug,'.$id,
            'procatone_id' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $procattwo->img; 
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
        if ($request->slug){
            $slug = $request->slug;
        }else {
            $slug = Str::slug($request->slug,'-');
        }
        $procattwo               = Procattwo::find($id);
        $procattwo->type         = $request->type;
        $procattwo->stt          = $request->stt;
        $procattwo->name         = $request->name;
        $procattwo->parent_id    = $request->parent_id;
        $procattwo->procatone_id = $request->procatone_id;
        $procattwo->descriptions = $request->descriptions;
        $procattwo->hide_show    = $request->hide_show;
        $procattwo->show_nav     = $request->show_nav;
        $procattwo->is_featured  = $request->is_featured;
        $procattwo->slug         = Str::slug($request->slug,'-');
        $procattwo->title        = $request->title;
        $procattwo->keywords     = $request->keywords;
        $procattwo->description  = $request->description;
        $procattwo->status       = $request->status;
        $procattwo->img          = $name_save;
        Cache::forget($slug);
        $procattwo->save();
        return redirect()->route('backend.procattwo.index')->with('success','Cập nhật Danh mục thành công !');
    }

    public function destroy(Request $request, $id)
    {
        // $countProcate3 = Procatthree::where('procattwo_id', $id)->count();
        // if ($countProcate3 > 0) {
        //     return redirect()->route('backend.procattwo.index')->with('success','Khong the xoa the loai nay'); 
        // }
        // $procattwo = Procattwo::find($id);
        // $parent = Procattwo::where('parent_id',$id)->count();
        // if ($procattwo && $parent == 0) {
        //     $procattwo->delete();
        //     return redirect()->route('backend.procattwo.index')->with('success','Xóa Danh mục thành công !');
        // }
        //     return redirect()->route('backend.procattwo.index')->with('success','Không xóa được danh mục !');
        $getDataDelete = Procattwo::all();
        $deleteChild = deleteMultiLevel($getDataDelete,$id);
        $deleteChild[] = (int)$id;
        Procattwo::whereIn('id',$deleteChild)->delete();
        return redirect()->route('backend.procattwo.index')->with('success','Xóa Danh mục thành công !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Procattwo::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->is_featured = $request->is_featured;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->hide_show = $request->hide_show;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->is_new = $request->is_new;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->stt = $request->stt;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo STT change successfully.']);
    }
}