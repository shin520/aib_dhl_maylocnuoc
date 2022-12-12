<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Customer;
use App\User;
use Tag;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;


class CustomerController extends ShareController
{
    public function index()
    {   
        $customers = Customer::orderBy('stt','asc')->get();
        return view('backend.customers.index', compact('customers'));
    }
    public function create()
    {
        return view('backend.customers.create');
    }

    public function edit(Request $request, $id)
    {
        $customer = Customer::find($id);
        return view('backend.customers.edit', compact('customer'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Khách hàng !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả bài viết !',
            // 'content.required' => 'Vui lòng nhập Nội dung bài viết !',
            // 'slug.required'   => 'Vui lòng nhập URL bài viết !',
            // 'slug.unique'   => 'URL bài viết đã tồn tại !',
            // 'svcategories_id.required' => 'Vui lòng chọn Danh mục !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            // 'slug'  => 'required|max:120|unique:customers',
            // 'svcategories_id' => 'required',
            // 'published' => 'nullable|date',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ], $lang);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $name_save = $file->getClientOriginalName();
            $name_resize = $file->getClientOriginalName();
            $res  = $file->storeAs('public/uploads', $name_save);
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
        } else
        {
            $name_save = 'placeholder.png';
            $name_resize = 'placeholder.png';
        }
        if ($request->slug) {
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
            'work' => $request->work,
            'descriptions' => $request->descriptions,
            'hide_show' => $request->hide_show,
            'status' => $request->status,
            'img'  => $name_save,
            'img_resize'  => $name_resize
        ];
        $customer = Customer::create($data);
        if ($customer->type == 'customer') {
            return redirect()->route('backend.customer.index')->with('success','Thêm Bài viết thành công !');
        }
        elseif($customer->type == 'why'){
            return redirect()->route('backend.why.index')->with('success','Thêm Bài viết thành công !');
        }else{
          return redirect()->route('backend.customer.index')->with('error','Thêm Bài viết thất bại !');   
        }
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Khách hàng !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            // 'descriptions.required' => 'Vui lòng nhập Mô tả bài viết !',
            // 'content.required' => 'Vui lòng nhập Nội dung bài viết !',
            // 'slug.required'   => 'Vui lòng nhập URL bài viết !',
            // 'slug.unique'   => 'URL bài viết đã tồn tại !',
            // 'published' => 'Vui lòng nhập đúng định dạng Ngày !',
            // 'svcategories_id.required' => 'Vui lòng chọn Danh mục !',
        ];
        $request->validate([
            'name' => 'required|max:120',
            // 'descriptions' => 'required',
            // 'content' => 'required',
            // 'slug'  => 'required|max:120|unique:customers,slug,'.$id, //so sánh slug bỏ qua id chính nó
            // 'svcategories_id' => 'required',
            // 'published' => 'nullable|date',
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $customer->img;
            $name_resize = $customer->img_resize; 
        } else
        {
            // $file = $request->file('img');
            // $name_save = $file->getClientOriginalName();
            // $res  = $file->storeAs('public/uploads', $name_save);
            $file = $request->file('img');
            $name_save = $file->getClientOriginalName();
            $name_resize = $file->getClientOriginalName();
            $res  = $file->storeAs('public/uploads', $name_save);
            $path_resize = public_path('/uploads/thumbnail');
            $img_resize = Image::make($file)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();})->save($path_resize.'/'.$name_resize);
        }
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $customer->type         = $request->type;
        $customer->stt          = $request->stt;
        $customer->name         = $request->name;
        $customer->work         = $request->work;
        $customer->descriptions = $request->descriptions;
        $customer->hide_show    = $request->hide_show;
        $customer->status       = $request->status;
        $customer->img          = $name_save;
        Cache::forget($slug);
        $customer->save();
        if ($customer->type == 'customer') {
            return redirect()->route('backend.customer.index')->with('success','Cập nhật Bài viết thành công !');
        }elseif ($customer->type == 'why') {
            return redirect()->route('backend.why.index')->with('success','Cập nhật Bài viết thành công !');
        }else{
          return redirect()->route('backend.why.index')->with('error','Cập nhật Bài viết thất bại !');   
        }
        
    }

    public function destroy(Request $request, $id)
    {
        $customer = Customer::find($id);
        if ($customer and $customer->type == 'customer') {
            $customer->delete();
            return redirect()->route('backend.customer.index')->with('success','Xóa Bài viết thành công !');
        }elseif ($customer and $customer->type == 'why'){
            $customer->delete();
            return redirect()->route('backend.why.index')->with('success','Xóa Bài viết thành công !');
        }else{
            return redirect()->route('backend.customer.index')->with('success','Bài viết không tồn tại !'); 
        }
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        Customer::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Bài viết đã chọn !']);
    }
}