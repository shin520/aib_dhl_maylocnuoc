<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Procatthree;
use Procattwo;
use Procatone;
use Product;
// use App\Models\Productcategory;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProcatthreeController extends ShareController
{
    public function index()
    {
        $data = Procatthree::select('name', 'id', 'parent_id')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatthrees = Procatthree::with(['procattwo' => function ($query) {
            $query->with('procatone');
        }])->get();
        $procatones = Procatone::all();
        $procattwos = Procattwo::all();
        // $cat = Procatthree::query()
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
        return view('backend.procatthrees.index', compact('procatones','procattwos','procatthrees','data'));
    }
    public function select(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'procatone') {
                $select_procattwo = Procattwo::where('procatone_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option>Chọn danh mục cấp 2</option>';
                foreach ($select_procattwo as $key => $procattwo){
                    $output.='<option value="'.$procattwo->id.'">'.$procattwo->name.'</option>';
                }
            }else{
                $select_procatthree = Procatthree::where('procattwo_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option>Chọn danh mục cấp 3</option>';
                foreach ($select_procatthree as $key => $procatthree){
                    $output.='<option value="'.$procatthree->id.'">'.$procatthree->name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function create()
    {
        // $procatthrees = Procatthree::all();
        // $procatthrees = Procatthree::where('parent_id',0)->get();
        $parent = Procatthree::select('name', 'id', 'parent_id')->get();
        // dd($parent);
        $procatthrees = Procatthree::get();
        $procattwos = Procattwo::get();
        $procatones = Procatone::get();
        return view('backend.procatthrees.create', compact('procatthrees','procattwos','procatones','parent'));
    }

    public function edit(Request $request, $id)
    {
        $procattwos = Procattwo::get();
        $procatones = Procatone::get();
        $procatthree = Procatthree::find($id);
        $procatthrees = Procatthree::get();
        return view('backend.procatthrees.edit', compact('procatthree','procatthrees','procattwos', 'procatones'));
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
            'slug'  => 'required|max:255|unique:procatthrees',
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
            'procatone_id' => $request->procatone,
            'procattwo_id' => $request->procattwo,
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
        $procatthree = Procatthree::create($data);
        if ($procatthree) {
            // $procatthree->products()->sync($request->products_id);
            return redirect()->route('backend.procatthree.index')->with('success','Thêm Danh mục thành công !');
        }
            return redirect()->route('backend.procatthree.index')->with('error','Thêm Danh mục thất bại !');
    }

    public function update(Request $request, $id)
    {
        $procatthree = Procatthree::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên danh mục !',
            'name.max'     => 'Vui lòng nhập tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả danh mục !',
            'slug.required' => 'Vui lòng nhập URL danh mục !',
            'slug.unique'   => 'URL danh mục đã tồn tại !',
            'img.image'   => 'Hình ảnh không hợp lệ !',
            'img.mimes'   => 'Định dạng hình ảnh không đúng !',
            'img.max'   => 'Dung lượng hình ảnh tối đa là 5MB !',
        ];
        $request->validate([
            'name'  => 'required|max:120',
            // 'descriptions' => 'required|max:400',
            'slug'  => 'required|max:120|unique:procatthrees,slug,'.$id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if (!$request->hasFile('img')){
            $name_save = $procatthree->img; 
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
        $procatthree               = Procatthree::find($id);
        $procatthree->type         = $request->type;
        $procatthree->stt          = $request->stt;
        $procatthree->name         = $request->name;
        $procatthree->parent_id    = $request->parent_id;
        $procatthree->procatone_id = $request->procatone;
        $procatthree->procattwo_id = $request->procattwo;
        $procatthree->descriptions = $request->descriptions;
        $procatthree->hide_show    = $request->hide_show;
        $procatthree->show_nav     = $request->show_nav;
        $procatthree->is_featured  = $request->is_featured;
        $procatthree->slug         = Str::slug($request->slug,'-');
        $procatthree->title        = $request->title;
        $procatthree->keywords     = $request->keywords;
        $procatthree->description  = $request->description;
        $procatthree->status       = $request->status;
        $procatthree->img          = $name_save;
        Cache::forget($slug);
        $procatthree->save();
        return redirect()->route('backend.procatthree.index')->with('success','Cập nhật Danh mục thành công !');
    }

    public function destroy(Request $request, $id)
    {
        // $countProcate3 = Product::where('procatthree_id', $id)->count();
        // if ($countProcate3 > 0) {
        //     return redirect()->route('backend.procatthree.index')->with('success','Khong the xoa the loai nay'); 
        // }
        // $procatthree = Procatthree::find($id);
        // $parent = Procatthree::where('parent_id',$id)->count();
        // if ($procatthree && $parent == 0) {
        //     $procatthree->delete();
        //     return redirect()->route('backend.procatthree.index')->with('success','Xóa Danh mục thành công !');
        // }
        //     return redirect()->route('backend.procatthree.index')->with('success','Không xóa được danh mục !');
        $getDataDelete = Procatthree::all();
        $deleteChild = deleteMultiLevel($getDataDelete,$id);
        $deleteChild[] = (int)$id;
        Procatthree::whereIn('id',$deleteChild)->delete();
        return redirect()->route('backend.procatthree.index')->with('success','Xóa Danh mục thành công !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Procatthree::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->is_featured = $request->is_featured;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->hide_show = $request->hide_show;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->is_new = $request->is_new;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->stt = $request->stt;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree STT change successfully.']);
    }
}