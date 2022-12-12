<?php
    namespace App\Http\Controllers\Frontend;
    use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;
    use App\Models\Productcategory;
    use App\Models\Product;
    use App\Models\Setting;
    use View;
    use Auth;
    use Cache;
    use Session;
    use App\Models\Procatone;
    use App\Models\Procattwo;
    use App\Models\Procatthree;
    use Carbon\Carbon;
    use Jenssegers\Agent\Agent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\URL;

    class ProductController extends ShareController
    {
        public function cat(Request $request)
        {
            $setting = Setting::get()->first();
            $master = [
                        'title' => "Tất cả sản phẩm",
                        'keywords' => "Tất cả sản phẩm",
                        'description' => "Tất cả sản phẩm",
                        'img' => $setting->img,
                        'type' => $setting->type,
                        'created_at' => $setting->created_at,
                        'updated_at' => $setting->updated_at
                        ];
            return view('frontend.products.cat',compact('master'));
        }
        // public function cate(Request $request, $slug)
        // {
        //     $setting = Setting::get()->first();
        //     $productcategory   = Productcategory::whereSlug($slug)->first();
        //     if (!$slug) {
        //         return abort(404);
        //     }
        //     if (!$productcategory) {
        //         return abort(404);
        //     }
        //     $products      = $productcategory->products()->orderBy('stt','asc')->get();
        //     $products      = $productcategory->products()->orderBy('stt','asc')->paginate(6);
        //     $slug       = str::slug($slug);
        //     if (Cache::has($slug)){
        //         $productcategory = Cache::get($slug);
        //     }else{
        //         $productcategory = Productcategory::whereSlug($slug)->first();
        //         Cache::put($slug, $productcategory, 1440);
        //     }
        //     $session_productcategory = $request->session()->get('key');
        //         if (!$session_productcategory) { 
        //              session(['key' => '1']);
        //              $productcategory->increment('view_count');
        //         }
        //     $master = [
        //                 'title' => "Sản phẩm",
        //                 'keywords' => "Sản phẩm",
        //                 'description' => "Sản phẩm",
        //                 'img' => $setting->img,
        //                 'type' => $setting->type,
        //                 'created_at' => $setting->created_at,
        //                 'updated_at' => $setting->updated_at
        //                 ];
        //     return view('frontend.products.cate',compact('master','productcategory'));
        // }
        /* lượt xem danh mục tin tức */
        public function handleproductcategory(Productcategory $productcategory)
        {
            $productcategory->increment('view_count');
        }

        public function categories ($slug) {
            // $setting = Setting::get()->first();
            // $procat_one = Procatone::where('slug', $slug)->first();
            // $procat_two = Procattwo::where('slug', $slug)->first();
            // $pros = null;
            // $procate = null;
            // if (!is_null($procat_one)) {
            //     $pros = Product::where('procatone_id', $procat_one->id)->get();
            //     $procate = $procat_one;
            //     $master = [
            //         'title' => $procat_one->title,
            //         'keywords' => $procat_one->keywords,
            //         'description' => $procat_one->description,
            //         'img' => $setting->img,
            //         'type' => $setting->type,
            //         'created_at' => $setting->created_at,
            //         'updated_at' => $setting->updated_at
            //         ];
            //     return view('frontend.products.cate',compact('master','pros','procate'));

            // } elseif (!is_null($procat_two)) {
            //     $pros = Product::where('procattwo_id', $procat_two->id)->get();
            //     $procate = $procat_two;
            //     $master = [
            //         'title' => $procat_two->title,
            //         'keywords' => $procat_two->keywords,
            //         'description' => $procat_two->description,
            //         'img' => $setting->img,
            //         'type' => $setting->type,
            //         'created_at' => $setting->created_at,
            //         'updated_at' => $setting->updated_at
            //         ];
            //     return view('frontend.products.cate',compact('master','pros','procate'));
            // }else {
            //     $master = [
            //         'title' => "Sản phẩm",
            //         'keywords' => "Sản phẩm",
            //         'description' => "Sản phẩm",
            //         'img' => $setting->img,
            //         'type' => $setting->type,
            //         'created_at' => $setting->created_at,
            //         'updated_at' => $setting->updated_at
            //         ];
            //     return view('frontend.products.cate',compact('master','pros','procate'));
            // }

            $setting = Setting::get()->first();
            $procat_one = Procatone::where('slug', $slug)->first();
            $procat_two = Procattwo::with('procatone')->where('slug', $slug)->first();
            $pros = null;
            $procate = null;
            $procattwo = null;

            if (!is_null($procat_one)) {
                $pros = Product::where('procatone_id', $procat_one->id)->get();
                $procate = $procat_one;
                $procattwo = null;
                $master = [
                    'title' => $procate->title,
                    'keywords' => $procate->keywords,
                    'description' => $procate->description,
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
                return view('frontend.products.cate',compact('master','pros','procate', 'procattwo'));

            } elseif (!is_null($procat_two)) {
                $pros = Product::where('procattwo_id', $procat_two->id)->get();
                $procate = $procat_two->procatone;
                $procattwo = $procat_two;
                $master = [
                    'title' => $procattwo->title,
                    'keywords' => $procattwo->keywords,
                    'description' => $procattwo->description,
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
                return view('frontend.products.cate',compact('master','pros','procate', 'procattwo'));
            } else {
                return abort(404);
            }

            //$product = Product::with(['product_category'])->get()->toArray();
            //$cateid = Productcategory::select('id')->where('slug', $slug)->value('id');

            //$procat_one = Productcategory::where('slug',$slug)->first();
            // dd($procat_one);
            //$cateall = Productcategory::all();
            // $mangdb = array();
            // recursiveSelect($cateall, $cateid, $mangdb);
            // $mangdb[] = array($cateid);

            // $pros = DB::table('product_productcategory')
            //     ->join('productcategories', 'productcategories.id', '=', 'product_productcategory.productcategory_id')
            //     ->join('products', 'products.id', '=', 'product_productcategory.product_id')
            //     ->whereIn('product_productcategory.productcategory_id', $mangdb)
            //     ->get();

            // dd($pros);
            
            
            //$breadcrumb_current = Productcategory::where("slug",$slug)->value('id');
            //$allBreadCrumb = getCategoryTreeIDs ($breadcrumb_current);
            //$allBreadCrumb[] = $breadcrumb_current;
            //$allDataBreadCrumb = Productcategory::whereIn('id',$allBreadCrumb)->get();
            
        }
    }









