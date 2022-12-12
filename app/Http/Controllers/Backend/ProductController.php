<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Product;
use Productsimage;
use App\User;
use Productcategory;
use Procatone;
use Procattwo;
use Procatthree;
use Tag,DB;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProductController extends ShareController
{
    public function index()
    {
        // $products = Product::with(['categoryone' => function ($query) {
        //     $query->with(['procattwo' => function ($query) {
        //         $query->with('procatthree');
        //     }]);
        // }])->orderBy('stt','asc')->orderBy('id','desc')->get();

        $products = DB::table('products')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatones = Procatone::all();
        // $tags = Tag::all();
        return view('backend.products.index', compact('products','procatones'));
    }
    public function select_option(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'procatone') {
                $select_procattwo = Procattwo::where('procatone_id',$data['code_id'])->orderBy('stt','asc')->orderBy('id','desc')->get();
                $output.='<option value="">Chọn</option>';
                foreach ($select_procattwo as $key => $procattwo){
                    $output.='<option value="'.$procattwo->id.'">'.$procattwo->name.'</option>';
                }
            }else{
                $select_procatthree = Procatthree::where('procattwo_id',$data['code_id'])->orderBy('stt','asc')->orderBy('id','desc')->get();
                $output.='<option value="">Chọn</option>';
                foreach ($select_procatthree as $key => $procatthree){
                    $output.='<option value="'.$procatthree->id.'">'.$procatthree->name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function select(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'procatone') {
                $select_procattwo = Procattwo::where('procatone_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option value="">Chọn cấp 2</option>';
                foreach ($select_procattwo as $key => $procattwo){
                    $output.='<option value="'.$procattwo->name.'" data-id="'.$procattwo->id.'">'.$procattwo->name.'</option>';
                }
            }else{
                $select_procatthree = Procatthree::where('procattwo_id',$data['code_id'])->orderBy('id','ASC')->get();
                $output.='<option value="">Chọn cấp 3</option>';
                foreach ($select_procatthree as $key => $procatthree){
                    $output.='<option value="'.$procatthree->name.'" data-id="'.$procatthree->id.'">'.$procatthree->name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function create()
    {
        $productcategories = Productcategory::orderBy('name','ASC')->get();
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();
        // $productcategories = Productcategory::where('parent_id',0)->get();
        // $tags = Tag::all();
        return view('backend.products.create', compact('productcategories','procatones'));
    }
    public function edit(Request $request, $id)
    {
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();
        $procattwos = Procattwo::orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatthrees = Procatthree::orderBy('stt','asc')->orderBy('id','desc')->get();

        $productcategories = Productcategory::all();
        $product_category_check = Product::with(['product_category'])->where('id',$id)->first()->toArray();   
        $id_category = array();
        foreach ($product_category_check["product_category"] as $product_category) {
            $id_category[] = $product_category["id"];
        }
        // 
        // $tags = Tag::all();

        $product_category_selected = DB::table('product_productcategory')->where('product_id',$id)->first();

        $product = Product::find($id);
        $images = Productsimage::select('id','imgs')->where('product_id',$product->id)->get();
        $json = $product->imgs;
        $json = json_decode($json, true);
        // dd($json);
        return view('backend.products.edit', compact('productcategories','product','json','images','product_category_check','id_category','product_category_selected','procatones','procattwos','procatthrees'));
    }
    public function store(Request $request) // tạo mới
    {
        // $product = new Product();
        // $product_id = $product->id;
        // dd($product_id);
        
        $lang = [
            'name.required' => 'Vui lòng nhập Tên sản phẩm !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả sản phẩm !',
            // 'content.required' => 'Vui lòng nhập Nội dung sản phẩm !',
            'slug.required'   => 'Vui lòng nhập URL sản phẩm !',
            'slug.unique'   => 'URL sản phẩm đã tồn tại !',
            'img.image'   => 'Vui lòng chọn hình ảnh hợp lệ !',
            'img.mimes'   => 'Định dạng hình ảnh không hợp lệ !',
            'img.max'   => 'Dung lượng tối đa của hình ảnh là 5MB !',
            'imgs.image'   => 'Vui lòng chọn hình ảnh hợp lệ !',
            'imgs.mimes'   => 'Định dạng hình ảnh không hợp lệ !',
            'imgs.max'   => 'Dung lượng tối đa của hình ảnh là 5MB !',
            // 'productcategories_id.required' => 'Vui lòng chọn Danh mục !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:products',
            // 'productcategories_id' => 'required',
            // 'published' => 'nullable|date',
            'img'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'imgs.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ], $lang);
        // if ($request->hasFile('imgs')) {
        //     foreach ($request->file('imgs') as $img) {
        //         $name_img = $img->getClientOriginalName();
        //         $res  = $img->storeAs('public/uploads', $name_img);
        //         $dataimg[] = $name_img;
        //     }
        // }
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
        }else {
            $slug = Str::slug($request->slug,'-');
        }
        $nowdate = Carbon::now()->toDateTimeString();
        if (!$request->published){
            $nowdate;
        }
        if ($request->price == ''){
            $price = 0;
            $selling_price = 0;
        }else {
            $price = str_replace(',', '',(number_format(str_replace(',', '', $request->price))));
            $selling_price = str_replace(',', '',(number_format(str_replace(',', '', $request->price) - (str_replace(',', '', $request->price) * ($request->discount / 100)))));
        }
        if ($request->discount == ''){
            $discount = 0;
        }else {
            $discount = $request->discount;
        }
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'name' => $request->name,
            'procatone_id' => $request->procatone,
            'procattwo_id' => $request->procattwo,
            'procatthree_id' => $request->procatthree,
            'product_code' => $request->product_code,
            'price' => $price,
            'selling_price' => $selling_price,
            'discount' => $discount,
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
            'img_resize'  => $name_resize,
            // 'imgs' => json_encode($dataimg),
        ];
        // json_encode($dateimg) = [
        //     'imgs' => $name_multi_img,
        // ]
        // $product->imgs = json_encode($dataimg);
        $product = Product::create($data);
        $product_id = $product->id;
        $inputImgs = $request->all();
        if ($request->hasFile('imgs')) {
            $files = $request->file('imgs');
            foreach ($files as $file){
                if($file->isValid()){
                    $full_name_img = $file->getClientOriginalName();
                    $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                    $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                    $ext = $file->getClientOriginalExtension();
                    $name_save_slug = Str::slug($name_without_ext, '-');
                    $name_img = $name_save_slug.'.'.$ext;
                    $res = $file->storeAs('public/products', $name_img);
                    Productsimage::create([
                                            'product_id' => $product_id,
                                            'imgs' => $name_img
                                         ]);
                    // Productsimage::create($inputImgs);
                }
            }
        }
        if ($product) {
            // $product->tags()->sync($request->tags_id);
            $product->productcategories()->sync($request->productcategories_id);
            return redirect()->route('backend.product.index')->with('success','Thêm sản phẩm thành công !');
        }
            return redirect()->route('backend.product.index')->with('error','Thêm sản phẩm thất bại !');

    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên sản phẩm !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả sản phẩm !',
            // 'content.required' => 'Vui lòng nhập Nội dung sản phẩm !',
            'slug.required'   => 'Vui lòng nhập URL sản phẩm !',
            'slug.unique'   => 'URL sản phẩm đã tồn tại !',
            'img.image'   => 'Vui lòng chọn hình ảnh hợp lệ !',
            'img.mimes'   => 'Định dạng hình ảnh không hợp lệ !',
            'img.max'   => 'Dung lượng tối đa của hình ảnh là 5MB !',
            'imgs.image'   => 'Vui lòng chọn hình ảnh hợp lệ !',
            'imgs.mimes'   => 'Định dạng hình ảnh không hợp lệ !',
            'imgs.max'   => 'Dung lượng tối đa của hình ảnh là 5MB !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
            // 'productcategories_id.required' => 'Vui lòng chọn Danh mục !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            'slug'  => 'required|max:120|unique:products,slug,'.$id, //so sánh slug bỏ qua id chính nó
            // 'productcategories_id' => 'required',
            // 'published' => 'nullable|date',
            'img'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'imgs.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $product->img;
            $name_resize = $product->img_resize; 
        } else
        {
            // $file = $request->file('img');
            // $name_save = $file->getClientOriginalName();
            // $res  = $file->storeAs('public/uploads', $name_save);
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
            $img_resize = Image::make($file)->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();})->save($path_resize.'/'.$name_resize);
        }
        if ($request->slug){
            $slug = $request->slug;
        }else {
            $slug = Str::slug($request->slug,'-');
        }
        if ($request->price == '') {
            $price = 0;
            $selling_price = 0;
        }else{
            $price = str_replace(',', '',(number_format(str_replace(',', '', $request->price))));
            $selling_price = str_replace(',', '',(number_format(str_replace(',', '', $request->price) - (str_replace(',', '', $request->price) * ($request->discount / 100)))));
        }
        if ($request->discount == '') {
            $discount = 0;
        }else {
            $discount = $request->discount;
        }
        $product->type           = $request->type;
        $product->stt            = $request->stt;
        $product->name           = $request->name;
        $product->procatone_id   = $request->procatone;
        $product->procattwo_id   = $request->procattwo;
        $product->procatthree_id = $request->procatthree;
        $product->product_code   = $request->product_code;
        $product->price          = $price;
        $product->selling_price  = $selling_price;
        $product->discount       = $discount;
        $product->descriptions   = $request->descriptions;
        $product->is_featured    = $request->is_featured;
        $product->is_new         = $request->is_new;
        $product->hide_show      = $request->hide_show;
        $product->content        = $request->content;
        $product->slug           = Str::slug($request->slug,'-');
        $product->title          = $request->title;
        $product->keywords       = $request->keywords;
        $product->description    = $request->description;
        $product->status         = $request->status;
        $product->published      = $request->published;
        $product->img            = $name_save;
        Cache::forget($slug);
        $product->save();
        
        $product_id = $product->id;
        $inputImgs = $request->all();
        if ($request->hasFile('imgs')) {
            $files = $request->file('imgs');
            foreach ($files as $file){
                if($file->isValid()){
                    $full_name_img = $file->getClientOriginalName();
                    $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                    $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                    $ext = $file->getClientOriginalExtension();
                    $name_save_slug = Str::slug($name_without_ext, '-');
                    $name_img = $name_save_slug.'.'.$ext;
                    $res = $file->storeAs('public/products', $name_img);
                    Productsimage::create([
                                            'product_id' => $product_id,
                                            'imgs' => $name_img
                                         ]);
                    // Productsimage::create($inputImgs);
                }
            }
        }
        // sync categories
        // $product->productcategories()->sync($request->productcategories_id);
        // $product->tags()->sync($request->tags_id);
        return redirect()->route('backend.product.index')->with('success','Cập nhật sản phẩm thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('backend.product.index')->with('success','Xóa sản phẩm thành công !');
        }
            return redirect()->route('backend.product.index')->with('success','sản phẩm không tồn tại !');
    }
    
    public function delete($id){
        Productsimage::find($id)->delete($id);
        return response()->json(['status'=>true,'message'=>'Xoá thành công']);
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Product::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các sản phẩm đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $product = Product::find($request->product_id);
        $product->is_featured = $request->is_featured;
        $product->save();
        return response()->json(['success'=>'Product Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $product = Product::find($request->product_id);
        $product->hide_show = $request->hide_show;
        $product->save();
        return response()->json(['success'=>'Product Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $product = Product::find($request->product_id);
        $product->is_new = $request->is_new;
        $product->save();
        return response()->json(['success'=>'Product Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $product = Product::find($request->product_id);
        $product->stt = $request->stt;
        $product->save();
        return response()->json(['success'=>'Product STT change successfully.']);
    }
}