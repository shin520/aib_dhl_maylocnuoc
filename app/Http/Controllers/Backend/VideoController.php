<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Video;
use Cache;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class VideoController extends ShareController
{
    public function index()
    {
        $videos = Video::orderBy('stt', 'asc')->get();
        return view('backend.videos.index', compact('videos'));
    }
    public function create()
    {
        return view('backend.videos.create');
    }

    public function edit(Request $request, $id)
    {
        $video = Video::find($id);
        return view('backend.videos.edit', compact('video'));
    }

    public function store(Request $request) // tạo mới
    {
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Video !',
            'link.unique'   => 'URL Video đã tồn tại !',
            'link.required' => 'Vui lòng chọn Link Video Youtube !',
        ];
        $request->validate([
            'name' => 'required',
            'link'  => 'required|unique:videos',
        ], $lang);

        $url_video = $request->link;
        $code = Str::after($url_video, 'https://www.youtube.com/watch?v=');
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'name' => $request->name,
            'url_code' => $code,
            'link' => $request->link,
            'is_featured' => $request->is_featured,
            'hide_show' => $request->hide_show,
            'status' => $request->status,
        ];
        $video = Video::create($data);
        if ($video) {
            return redirect()->route('video.index')->with('success','Thêm Video thành công !');
        }
            return redirect()->route('video.index')->with('error','Thêm Video thất bại !');

    }
    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập Tên Video !',
            'link.unique'   => 'URL Video đã tồn tại !',
            'link.required' => 'Vui lòng chọn Link Video Youtube !',
        ];
        $request->validate([
            'name' => 'required',
            'link'  => 'required|unique:videos,link,'.$id,
        ], $lang);

        $url_video = $request->link;
        $code = Str::after($url_video, 'https://www.youtube.com/watch?v=');
        $video->type         = $request->type;
        $video->stt          = $request->stt;
        $video->name         = $request->name;
        $video->url_code     = $code;
        $video->link         = $request->link;
        $video->is_featured  = $request->is_featured;
        $video->hide_show    = $request->hide_show;
        $video->status       = $request->status;
        if ($video->save()) {
            return redirect()->route('video.index')->with('success','Cập nhật Video thành công !');
        }
            return redirect()->route('video.index')->with('success','Cập nhật Video không thành công !');
        
    }

    public function destroy(Request $request, $id)
    {
        $video = Video::find($id);
        if ($video) {
            $video->delete();
            return redirect()->route('video.index')->with('success','Xóa Video thành công !');
        }
            return redirect()->route('video.index')->with('success','Video không tồn tại !');
    }
    public function deletemultiple(Request $request){
            $ids = $request->ids;
            Video::whereIn('id',explode(",",$ids))->delete();
            return response()->json(['status'=>true,'message'=>'Xoá thành công các Videos đã chọn !']);
        }
}