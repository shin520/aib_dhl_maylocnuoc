<?php
    namespace App\Http\Controllers\Frontend;
    use App\Http\Controllers\ShareController;
    use Illuminate\Http\Request;
    use Jenssegers\Agent\Agent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\View;
    use Carbon\Carbon;
    use Cache;
    use Procatone;
    class SitemapController extends ShareController
    {
        public function sitemap()
        {
            $procatones = Procatone::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            return response()->view('frontend.sitemaps.index',compact('procatones'))->header('Content-Type', 'text/xml');
        }   
    }
        