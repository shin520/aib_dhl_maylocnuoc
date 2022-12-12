<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Productcategory;
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

class ProductcategoryController extends ShareController
{
    public function index()
    {
        $data = Productcategory::select('name', 'id', 'parent_id')->orderBy('stt','asc')->get();
        $productcategories = Productcategory::all();
        $cat = Productcategory::query()
                ->whereNull('parent_id')
                ->with([
                    'child' => function($query){
                        $query->select([
                            'id',
                            'name',
                            'parent_id',
                        ]);
                    }
                ])
                ->select([
                    'id',
                    'name',
                    'parent_id',
                ])
                ->get()->toArray();
        return view('backend.productcategories.index', compact('productcategories','data'));
    }
    public function create()
    {
        // $productcategories = Productcategory::all();
        // $productcategories = Productcategory::where('parent_id',0)->get();
        $parent = Productcategory::select('name', 'id', 'parent_id')->get();
        // dd($parent);
        $productcategories = Productcategory::get();
        return view('backend.productcategories.create', compact('productcategories','parent'));
    }

    public function edit(Request $request, $id)
    {
        $productcategory = Productcategory::find($id);
        $productcategories = Productcategory::get();
        return view('backend.productcategories.edit', compact('productcategory','productcategories'));
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
            'slug'  => 'required|max:255|unique:productcategories',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $name_save = $file->getClientOriginalName();
            $res  = $file->storeAs('public/uploads', $name_save);
        } else
        {
            $name_save = 'placeholder.png';
        }
        if ($request->slug) {
            $slug = $request->slug;
        }else{
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
        $productcategory = Productcategory::create($data);
        if ($productcategory) {
            $productcategory->products()->sync($request->products_id);
            return redirect()->route('backend.productcategory.index')->with('success','Thêm Danh mục thành công !');
        }
            return redirect()->route('backend.productcategory.index')->with('error','Thêm Danh mục thất bại !');
    }

    public function update(Request $request, $id)
    {
        $productcategory = Productcategory::find($id);
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
            'slug'  => 'required|max:120|unique:productcategories,slug,'.$id,
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $productcategory->img; 
        } else
        {
            $file = $request->file('img');
            $name_save = $file->getClientOriginalName();
            $res  = $file->storeAs('public/uploads', $name_save);
        }
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $productcategory               = Productcategory::find($id);
        $productcategory->type         = $request->type;
        $productcategory->stt          = $request->stt;
        $productcategory->name         = $request->name;
        $productcategory->parent_id    = $request->parent_id;
        $productcategory->descriptions = $request->descriptions;
        $productcategory->hide_show    = $request->hide_show;
        $productcategory->show_nav     = $request->show_nav;
        $productcategory->is_featured  = $request->is_featured;
        $productcategory->slug         = Str::slug($request->slug,'-');
        $productcategory->title        = $request->title;
        $productcategory->keywords     = $request->keywords;
        $productcategory->description  = $request->description;
        $productcategory->status       = $request->status;
        $productcategory->img          = $name_save;
        Cache::forget($slug);
        $productcategory->save();
        return redirect()->route('backend.productcategory.index')->with('success','Cập nhật Danh mục thành công !');

    }

    public function destroy(Request $request, $id)
    {
        // $productcategory = Productcategory::find($id);
        // $parent = Productcategory::where('parent_id',$id)->count();
        // if ($productcategory && $parent == 0) {
        //     $productcategory->delete();
        //     return redirect()->route('backend.productcategory.index')->with('success','Xóa Danh mục thành công !');
        // }
        //     return redirect()->route('backend.productcategory.index')->with('success','Không xóa được danh mục !');
        $getDataDelete = Productcategory::all();
        $deleteChild = deleteMultiLevel($getDataDelete,$id);
        $deleteChild[] = (int)$id;
        Productcategory::whereIn('id',$deleteChild)->delete();
        return redirect()->route('backend.productcategory.index')->with('success','Xóa Danh mục thành công !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        Productcategory::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
}