<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\User;
use App\Models\Account;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends ShareController
{
    public function index()
    {
        $users = User::orderBy('stt','asc')->orderBy('id','desc')->get();
        //dd($users);
        return view('backend.users.index', compact('users'));
    }
    public function addaccount()
    {
        // dd(bcrypt(123456));
        // User::create([
        // 'name' => 'admin',
        // 'email' => 'tritrinh@gmail.com',
        // 'password' => bcrypt(123456),
        // ]);
        // Account::create([
        // 'name' => 'Customer',
        // 'email' => 'tritrinh@gmail.com',
        // 'phone' => '0909135090',
        // 'password' => bcrypt(123456),
        // ]);
    }
    public function create()
    {
        $users = User::all();
        return view('backend.users.create', compact('users'));
    }

    public function editinfo(Request $request, $id)
    {
        $user = User::find($id);
        return view('backend.users.editinfo', compact('user'));
    }

    public function editpassword(Request $request, $id)
    {
        $user = User::find($id);
        return view('backend.users.editpassword', compact('user'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required'     => 'Vui lòng nhập Tên thành viên !',
            'name.min'     => 'Vui lòng nhập Tối thiểu :min ký tự !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'email.required'     => 'Vui lòng nhập Email thành viên !',
            'password.required'     => 'Vui lòng nhập Mật khẩu đăng nhập !',
            'password_confirmation.required'     => 'Vui lòng nhập lại Mật khẩu đăng nhập !',
            'required_with' => 'Mật khẩu xác nhận là Bắt buộc nhập khi đã nhập Mật khẩu !',
            'password.confirmed'     => 'Mật khẩu Xác nhận chưa đúng !',
            'password.required_with'     => 'Mật khẩu Xác nhận không khớp !',
            'email.unique'   => 'Email thành viên đã tồn tại !',
        ];
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email'  => 'required|email|unique:users',
            'password' => 'required|confirmed|min:12',
            'password_confirmation'=>'sometimes|required_with:password',
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
            $res  = $file->storeAs('public/uploads', $name_save);
        }else {
            $name_save = 'placeholder.png';
        }
        $id = Auth::id();
        $data = [
            'stt' => $request->stt,
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'created_by' => $id,
            'content' => $request->content,
            'password' => $request->password,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'img'  => $name_save
        ];
        $user = User::create($data);
        return redirect()->route('backend.user.index')->with('success','Đã tạo User thành công');
    }
    public function updateinfo(Request $request, $id)
    {
        $user = User::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên thành viên !',
            'name.min'     => 'Vui lòng nhập Tối thiểu :min ký tự !',
            'name.max'     => 'Vui lòng nhập Tối đa :max ký tự !',
            'email.required' => 'Vui lòng nhập Email thành viên !',
            'email.unique'  => 'Email thành viên đã tồn tại !',
            'img.required' => 'Vui lòng chọn Avatar thành viên !',
        ];
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email'  => 'required|email|unique:users,email,'.$id,
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            
        ], $lang);
        if (!$request->hasFile('img')) {
            $name_save = $user->img; 
        }else{
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res  = $file->storeAs('public/uploads', $name_save);
        }
        $user->stt          = $request->stt;
        $user->name         = $request->name;
        $user->content      = $request->content;
        $user->email        = $request->email;
        $user->status       = $request->status;
        $user->img          = $name_save;
        $user->save();
        return redirect()->back()->with('success','Cập nhật thông tin Thành viên thành công !');
    }

    public function updatepassword(Request $request, $id)
    {
        $user = User::find($id);
        $lang = [
            'password.required' => 'Vui lòng nhập Mật khẩu đăng nhập hiện tại!',
            'new_password.required' => 'Vui lòng nhập Mật khẩu mới !',
            'required_with' => 'Mật khẩu Xác nhận là Bắt buộc nhập khi đã nhập Mật khẩu mới !',
            'different' => 'Mật khẩu mới phải khác Mật khẩu hiện tại !',
            'confirmed'     => 'Mật khẩu Xác nhận lại Mật khẩu mới chưa đúng !',
        ];
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|different:password|confirmed',
            'new_password_confirmation'=>'sometimes|required_with:new_password',
        ], $lang);
        if (Hash::check($request->password, $user->password)) { 
            $user->fill([
            'password' => Hash::make($request->new_password)
            ]);
        }else {
            return redirect()->back()->with('success','Mật khẩu cũ bạn nhập chưa chính xác !');
        }
            $user->password = Hash::make($request->new_password);
            $user->save();
        if ($user->save()) {
            Auth::logout();
            return redirect()->route('login')->with('success','Đổi mật khẩu mới thành công ! Vui lòng đăng nhập lại !');
        }else{
            return redirect()->back()->with('success','Cập nhật Mật khẩu mới thất bại !');
            // Auth::login($user);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('backend.user.index')->with('success','Xóa Thành viên thành công !');
        }
            return redirect()->route('backend.user.index')->with('success','Xoá Thành viên thất bại !');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>"Xoá thành công các Thành viên đã chọn !"]);
    }
    public function status(Request $request){
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['success'=>'User status change successfully.']);
    }
    public function changeStt(Request $request){
        $user = User::find($request->user_id);
        $user->stt = $request->stt;
        $user->save();
        return response()->json(['success'=>'User STT change successfully.']);
    }
}