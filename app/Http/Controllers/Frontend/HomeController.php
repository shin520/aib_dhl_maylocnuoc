<?php
    namespace App\Http\Controllers\Frontend;
    use App\Http\Controllers\ShareController;
    use Illuminate\Http\Request;
    use App\Models\Setting;
    use App\Models\About;
    use App\Models\Productcategory;
    use Procatone;
    use App\Models\Product;
    use App\Models\Tag;
    use App\Models\Productsimage;
    use App\Models\Newcategory;
    use App\Models\Post;
    use App\Models\Servi;
    use App\Models\Contact;
    use App\Models\Counter;
    use App\Models\Online;
    use App\Models\Author;
    use App\Models\Policy;
    use App\Models\Tutorial;
    use App\Models\Price;
    use View;
    use Auth;
    use Cache;
    use Session;
    use Carbon\Carbon;
    use Jenssegers\Agent\Agent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Config;

    
    // use App\Models\Page;
    // use App\Models\Support;
    // use App\Models\Partner;

    class HomeController extends ShareController
    {
        // trang chủ
        public function index(Request $request)
        {
            $web = Setting::first();
            $time_now = Carbon::now('Asia/Ho_Chi_Minh');
            $user_online = $request->session()->getId();
            if (Online::where('session_id', '=', $user_online)->count() > 0) {
            } else {
                $online = new Online([
                    'session_id' => $user_online,
                ]);
                $online->save();
            }
            $time_db = Online::get();
            foreach ($time_db as $item) {
                $time_old = $item->created_at;
                $time_id = $item->id;
                $check_time = $time_now->diffInMinutes($time_old);
                $check_time_counter = $time_now->diffInMinutes($time_old);
                $ip_user = $_SERVER['REMOTE_ADDR'];
                if (Counter::where('time', '=', $time_old)->count() > 0) {
                } else {
                DB::table('counters')->whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-1 minutes')) )->insert(['time' => $time_old,'ip'=>$ip_user]);
                }
                if ($check_time_counter > 1) {
                    $deletedRows = Online::where('id', $time_id)->delete();
                }
            }
            // $category = new Category();
            // $category->hello();
            // Auth::guard('account')->attempt(['email' => 'tritrinh@gmail.com', 'password' => '123456']);
            $data['setting'] = Setting::get()->first();
            // $pros = Productcategory::with(['product'])->where('slug',$slug)->first()->toArray();
            $data['master'] = [
                        'title' => $data['setting']->title,
                        'keywords' => $data['setting']->keywords,
                        'description' => $data['setting']->description,
                        'img' => $data['setting']->img,
                        'type' => $data['setting']->type,
                        'created_at' => $data['setting']->created_at,
                        'updated_at' => $data['setting']->updated_at
                        ];

            // $data['cateparent'] = Productcategory::where('parent_id',0)->get();
            $data['cateparent'] = Procatone::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();        
            // $categories = Category::where('parent_id',0)->get();
           return view("frontend.home.index", $data);
           // return view("frontend.home.index",[
           //      'name' => 'Hello Name',
           //      'email' => 'tritrinh@gmail.com',
           //      'data' => ['red','green','yellow']
           // ]);
           // Viet ngoai views
           //<?php echo $name
        }

        public function quickview(Request $request)
        {
            $data['setting'] = Setting::get()->first();
            $data['master'] = [
                        'title' => $data['setting']->title,
                        'keywords' => $data['setting']->keywords,
                        'description' => $data['setting']->description,
                        'img' => $data['setting']->img,
                        'type' => $data['setting']->type,
                        'created_at' => $data['setting']->created_at,
                        'updated_at' => $data['setting']->updated_at
                        ];

            $data['cateparent'] = Productcategory::where('parent_id',0)->get();
            $data['info'] = Product::where('slug', $request->slug)->where('hide_show','1')->first();
   
            return view("frontend.layout.layout", $data);


        }
        /* chi tiết giới thiệu */
        public function About(Request $request)
        {
            // if (Session::has('locale')) {
            //    app()->setlocale(Session::get('locale'));
            // }
            $abouts = About::get()->first();
            // $abouts = About::get()->first()->toArray();
            $session_abouts = $request->session()->get('key');
                if (!$session_abouts)
                { 
                    session(['key' => '1']);
                    $abouts->increment('view_count');
                }
            // $lang = $request->session()->get('locale');
            $lang = Session::get('locale');
            // dd($lang);
            $master = [
                        'name' => $abouts->name,
                        'title' => $abouts->title,
                        'keywords' => $abouts->keywords,
                        'description' => $abouts->description,
                        'descriptions' => $abouts->descriptions,
                        'img' => $abouts->img,
                        'type' => $abouts->type,
                        'created_at' => $abouts->created_at,
                        'updated_at' => $abouts->updated_at
                        ];
            return view('frontend.about.index', compact('abouts','master'));
        }
        /* lượt xem giới thiệu */
        public function handleabout(About $abouts)
        {
            $abouts->increment('view_count');
        }
        /* chi tiết sản phẩm */
        public function products(Request $request, $slug)
        {
            $product = Product::whereSlug($slug)->firstOrFail();
            $procatone_id = $product->procatone_id;
            $procattwo_id = $product->procattwo_id;
            if ($procatone_id > 0 && $procattwo_id > 0) {
                $product_relationship = Product::orderBy('stt','asc')->orderBy('id','desc')
                                    ->where('hide_show',1)
                                    ->where('slug','!=', $product->slug)
                                    ->where('procattwo_id','=', $product->procattwo_id)
                                    ->get();
            }elseif ($procatone_id > 0 && $procattwo_id == null) {
                $product_relationship = Product::orderBy('stt','asc')->orderBy('id','desc')
                                    ->where('hide_show',1)
                                    ->where('slug','!=', $product->slug)
                                    ->where('procattwo_id','=', null)
                                    ->where('procatone_id','=', $product->procatone_id)
                                    ->get();
            }else {
                $product_relationship = Product::orderBy('stt','asc')->orderBy('id','desc')
                                    ->where('hide_show',1)
                                    ->where('slug','!=', $product->slug)
                                    ->where('procattwo_id','=', null)
                                    ->where('procatone_id','=', null)
                                    ->get();
            }
            
            // $product_relationship = Product::orderBy('stt','asc')->orderBy('id','desc')
            //                         ->where('hide_show',1)
            //                         ->where('procatone_id', $product->procatone_id)
            //                         ->orWhere('procattwo_id', $product->procattwo_id)
            //                         // ->orWhere('procatthree_id', $product->procatthree_id)
            //                         ->get();
            // dd($product);
            // $selling_price = str_replace(',', '.', (int)$product->price) - (str_replace(',', '.', (int)$product->price) * ((int)$product->discount / 100));

            // $product_category = Product::with(['product_category'])->whereSlug($slug)->first()->toArray();
            // $breadcrumb_current = $product_category["product_category"][0]["id"];
            // $allBreadCrumb = getCategoryTreeIDs ($breadcrumb_current);
            // $allBreadCrumb[] = $breadcrumb_current;
            // $allDataBreadCrumb = Productcategory::whereIn('id',$allBreadCrumb)->get();

            // $product_relationship = Productcategory::with(['product' => function ($query) use ($product) {
            //     $query->where('products.id','!=',$product->id);
            // }])->where('id', $breadcrumb_current)->first()->product;

            // dd($product_relationship);


            // $selling_price = number_format(str_replace(',', '', $product->price) - (str_replace(',', '', $product->price) * ($product->discount / 100)));
            // $previous   = Product::where('id', '<', $product->id)->orderBy('id','desc')->first();
            // $next       = Product::where('id', '>', $product->id)->orderBy('id')->first();
            $slug       = str::slug($slug);
            $images = Productsimage::select('id','imgs')->where('product_id',$product->id)->get();
            // $json = $product->imgs;
            // $json = json_decode($json, true);
            // if (Cache::has($slug)){
            //     $product = Cache::get($slug);
            // }else{
            //     $product = Product::whereSlug($slug)->first();
            //     Cache::put($slug, $product, 1440);
            // }
            $session_product = $request->session()->get('key');
                if (!$session_product) 
                { 
                    session(['key' => '1']);
                    $product->increment('view_count');
                }

            $master = [
                        'title' => $product->title,
                        'keywords' => $product->keywords,
                        'description' => $product->description,
                        'type' => $product->type,
                        'img' => $product->img,
                        'created_at' => $product->created_at,
                        'updated_at' => $product->updated_at
                        ];
            return view('frontend.products.index', compact('product','master','images','product_relationship'));
        }
        /* lượt xem sản phẩm */
        public function handleproduct(Product $product)
        {
            $product->increment('view_count');
        }
        public function handlesvservice(Svservice $svservice)
        {
            $svservice->increment('view_count');
        }
        /* Tags */
        // public function tag(Request $request, $slug)
        // {
        //     $tag = Tag::whereSlug($slug)->first();
        //     if (!$slug) {
        //         return abort(404);
        //     }
        //     if (!$tag) {
        //         return abort(404);
        //     }
        //     $svservices   = $tag->articles()->get();
        //     $articles   = $tag->articles()->paginate(8);
        //     $slug       = str::slug($slug);
        //     if (Cache::has($slug)){
        //         $tag = Cache::get($slug);
        //     }else{
        //         $tag = Tag::whereSlug($slug)->first();
        //         Cache::put($slug, $tag, 1440);
        //     }
        //     return view("frontend.articles.tag",compact('tag','articles'));
        // }
        
        /* Tất cả tin tức */
        public function news (Request $request){
            $posts = Post::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->paginate(6);
            $posts_is_featureds = Post::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            $setting = Setting::get()->first();
            $master = [
                    'title' => "Tin tức",
                    'keywords' => "Tin tức",
                    'description' => "Tin tức",
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                ];
            return view("frontend.posts.news",compact('posts','posts_is_featureds','master'));   
        }
        /* Tất cả dịch vụ */
        public function servis (Request $request){
            $servis = Servi::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->paginate(6);
            $servis_is_featureds = Servi::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            $setting = Setting::get()->first();
            $master = [
                    'title' => "Dịch vụ",
                    'keywords' => "Dịch vụ",
                    'description' => "Dịch vụ",
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
            return view("frontend.servis.servis",compact('servis','servis_is_featureds','master'));
        }
        /* danh mục tin tức */
        public function posts (Request $request, $slug)
        {
            $newcategory   = Newcategory::whereSlug($slug)->first();
            $posts_is_featureds = Post::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            if (!$slug) {
                return abort(404);
            }
            if (!$newcategory) {
                return abort(404);
            }
            $posts      = $newcategory->posts()->orderBy('stt','asc')->get();
            $posts      = $newcategory->posts()->orderBy('stt','asc')->paginate(6);
            $slug       = str::slug($slug);
            if (Cache::has($slug)){
                $newcategory = Cache::get($slug);
            }else{
                $newcategory = Newcategory::whereSlug($slug)->first();
                Cache::put($slug, $newcategory, 1440);
            }
            $session_newcategory = $request->session()->get('key');
                if (!$session_newcategory) { 
                     session(['key' => '1']);
                     $newcategory->increment('view_count');
                }
            $master = [
                        'title' => $newcategory->title,
                        'keywords' => $newcategory->keywords,
                        'description' => $newcategory->description,
                        'type' => $newcategory->type,
                        'img' => $newcategory->img,
                        'created_at' => $newcategory->created_at,
                        'updated_at' => $newcategory->updated_at
                        ];
            return view("frontend.posts.categories",compact('newcategory','posts','posts_is_featureds','master'));
        }
        /* lượt xem danh mục tin tức */
        public function handlenewcategory(Newcategory $newcategory)
        {
            $newcategory->increment('view_count');
        }
        /* chi tiết tin tức */
        public function dtpost(Request $request ,$slug)
        {
            $post = Post::whereSlug($slug)->firstOrFail();
            $post_newcategory = Post::with(['post_newcategory'])->whereSlug($slug)->first()->toArray();
            $breadcrumb_current_post = $post_newcategory["post_newcategory"][0]["id"];

            $allBreadCrumbPost = getNewCategoryTreeIDs ($breadcrumb_current_post);
            $allBreadCrumbPost[] = $breadcrumb_current_post;

            $allDataBreadCrumbPost = Newcategory::whereIn('id',$allBreadCrumbPost)->get();

            $post_relationship = Newcategory::with(['post' => function ($query) use ($post) {
                $query->where('posts.id','!=',$post->id);
            }])->where('id', $breadcrumb_current_post)->first()->post;

            $previous = Post::where('id', '<', $post->id)->orderBy('id','desc')->first();
            $next     = Post::where('id', '>', $post->id)->orderBy('id')->first();
            $slug     = str::slug($slug);
            if (Cache::has($slug)){
                $post = Cache::get($slug);
            }else{
                $post = Post::whereSlug($slug)->first();
                Cache::put($slug, $post, 1440);
            }
            $session_post = $request->session()->get('key');
                if (!$session_post) { 
                     session(['key' => '1']);
                     $post->increment('view_count');
                }
            $master = [
                        'title' => $post->title,
                        'keywords' => $post->keywords,
                        'description' => $post->description,
                        'type' => $post->type,
                        'img' => $post->img,
                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at
                        ];    
            return view('frontend.posts.index', compact('post','master','previous','next','post_relationship'));
        }
        /* lượt xem chi tiết tin tức */
        public function handlepost(Post $post)
        {
            $post->increment('view_count');
        }
        /* chi tiết dịch vụ */
        public function serindex(Request $request ,$slug)
        {
            $servi = Servi::whereSlug($slug)->firstOrFail();
            $servi_relationship = Servi::where('slug', '!=', $servi->slug)->where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            $slug = str::slug($slug);
            if (Cache::has($slug)){
                $servi = Cache::get($slug);
            }else{
                $servi = Servi::whereSlug($slug)->first();
                Cache::put($slug, $servi, 1440);
            }
            $session_servi = $request->session()->get('key');
                if (!$session_servi) { 
                     session(['key' => '1']);
                     $servi->increment('view_count');
                }
            $master = [
                        'title' => $servi->title,
                        'keywords' => $servi->keywords,
                        'description' => $servi->description,
                        'type' => $servi->type,
                        'img' => $servi->img,
                        'created_at' => $servi->created_at,
                        'updated_at' => $servi->updated_at
                        ];    
            return view('frontend.servis.index', compact('servi','master','servi_relationship'));
        }
        /* lượt xem chi tiết dịch vụ */
        public function handleservi(Servi $servi)
        {
            $servi->increment('view_count');
        }
        /* chi tiết liên hệ */
        public function contact(Request $request)
        {
            $contacts = Contact::get()->first();
            $session_contacts = $request->session()->get('key');
                if (!$session_contacts) { 
                    session(['key' => '1']);
                    $contacts->increment('view_count');
                }
            $master = [
                        'title' => $contacts->title,
                        'keywords' => $contacts->keywords,
                        'description' => $contacts->description,
                        'img' => $contacts->img,
                        'type' => $contacts->type,
                        'created_at' => $contacts->created_at,
                        'updated_at' => $contacts->updated_at
                        ];
            return view('frontend.contact.index', compact('contacts','master'));
        }
        /* chi tiết liên hệ */
        public function price(Request $request)
        {
            $master = [
                        'title' => 'Đăng ký nhận báo giá',
                        'keywords' => 'Đăng ký nhận báo giá',
                        'description' => 'Đăng ký nhận báo giá',
                        'img' => '',
                        'type' => '',
                        'created_at' => '',
                        'updated_at' => ''
                        ];
            return view('frontend.price.index', compact('master'));
        }
        /* lượt xem liên hệ */
        public function handlecontacts(Contact $contacts)
        {
            $contacts->increment('view_count');
        }
        /* chi tiết góp ý */
        public function feedback(Request $request)
        {
            $session_feedback = $request->session()->get('key');
                if (!$session_feedback) { 
                     session(['key' => '1']);
                     $feedback->increment('view_count');
                }
            $setting = Setting::get()->first();
            $master = [
                    'title' => "Góp ý",
                    'keywords' => "Góp ý",
                    'description' => "Góp ý",
                    'img' => $setting->img,
                    'type' => $setting->type,
                    'created_at' => $setting->created_at,
                    'updated_at' => $setting->updated_at
                    ];
            return view('frontend.feedback.index', compact('master'));
        }
        /* lượt xem góp ý */
        public function handlefeedback(Feedback $feedback)
        {
            $feedback->increment('view_count');
        }
        /* chi tiết tác giả */
        public function author(Request $request)
        {
            $authors = Author::get()->first();
            // $supports   = Support::paginate(6);
            // $count_posts = Article::count();
            // $count_blogs = Blog::count();
            // $count_supports = Support::count();
            // $articles   = Article::paginate(6);
            // $blogs      = Blog::paginate(6);
            // $articlesm  = Article::get()->where('is_new',1);
            // $articlesview  = Article::orderBy('view_count','desc')->take(6)->get();
            // $categorydm = Category::get();
            $session_authors = $request->session()->get('key');
                if (!$session_authors) { 
                     session(['key' => '1']);
                     $authors->increment('view_count');
                }
            $master = [
                        'title' => $authors->title,
                        'keywords' => $authors->keywords,
                        'description' => $authors->description,
                        'img' => $authors->img,
                        'type' => $authors->type,
                        'created_at' => $authors->created_at,
                        'updated_at' => $authors->updated_at
                        ];
            return view("frontend.author.index",compact('authors','master'));
        }
        /* lượt xem tác giả */
        public function handleauthors(Author $authors)
        {
            $authors->increment('view_count');
        }
        /* tất cả dịch vụ */
        public function all_policies(Request $request)
        {
            $policies = Policy::get();
            $session_a_policies = $request->session()->get('key');
                if (!$session_a_policies) 
                { 
                    session(['key' => '1']);
                    $policy->increment('view_count');
                }
            $master = [
                        'title' => 'Chính sách',
                        'keywords' => 'Chính sách',
                        'description' => 'Chính sách',
                        'type' => '',
                        'img' => '',
                        'created_at' => '',
                        'updated_at' => ''
                        ];
            return view("frontend.policies.services",compact('policies','master'));
        }
        /* chi tiết dịch vụ */
        public function policy(Request $request, $slug)
        {
            $policy    = Policy::whereSlug($slug)->firstOrFail();
            // $policy_others = Policy::whereSlug(!=, $slug)->get();

            $policy_related = Policy::where('slug', '!=', $policy->slug)->get();

            // $related= Post::where('category_id', '=', $post->category->id)
            // ->where('id', '!=', $post->id)
            // ->get();
            //dd($related);


            $previous   = Policy::where('id', '<', $policy->id)->orderBy('id','desc')->first();
            $next       = Policy::where('id', '>', $policy->id)->orderBy('id')->first();
            $slug       = str::slug($slug);
            if (Cache::has($slug)){
                $policy = Cache::get($slug);
            }else{
                $policy = Policy::whereSlug($slug)->first();
                Cache::put($slug, $policy, 1440);
            }
            $session_servi = $request->session()->get('key');
                if (!$session_servi) 
                { 
                    session(['key' => '1']);
                    $policy->increment('view_count');
                }
            $master = [
                        'title' => $policy->title,
                        'keywords' => $policy->keywords,
                        'description' => $policy->description,
                        'type' => $policy->type,
                        'img' => $policy->img,
                        'created_at' => $policy->created_at,
                        'updated_at' => $policy->updated_at
                        ];
            return view("frontend.policies.index",compact('policy','previous','next','master','policy_related'));
        }
        /* lượt xem dịch vụ */
        public function handlepolicy(Policy $policy)
        {
            $policy->increment('view_count');
        }
        /* chi tiết dịch vụ */
        public function tutorial(Request $request, $slug)
        {
            $tutorial    = Tutorial::whereSlug($slug)->firstOrFail();
            // $tutorial_others = Tutorial::whereSlug(!=, $slug)->get();

            $tutorial_related = Tutorial::where('slug', '!=', $tutorial->slug)->get();

            // $related= Post::where('category_id', '=', $post->category->id)
            // ->where('id', '!=', $post->id)
            // ->get();
            //dd($related);


            $previous   = Tutorial::where('id', '<', $tutorial->id)->orderBy('id','desc')->first();
            $next       = Tutorial::where('id', '>', $tutorial->id)->orderBy('id')->first();
            $slug       = str::slug($slug);
            if (Cache::has($slug)){
                $tutorial = Cache::get($slug);
            }else{
                $tutorial = Tutorial::whereSlug($slug)->first();
                Cache::put($slug, $tutorial, 1440);
            }
            $session_tutorial = $request->session()->get('key');
                if (!$session_tutorial) 
                { 
                    session(['key' => '1']);
                    $tutorial->increment('view_count');
                }
            $master = [
                        'title' => $tutorial->title,
                        'keywords' => $tutorial->keywords,
                        'description' => $tutorial->description,
                        'type' => $tutorial->type,
                        'img' => $tutorial->img,
                        'created_at' => $tutorial->created_at,
                        'updated_at' => $tutorial->updated_at
                        ];
            return view("frontend.tutorials.index",compact('tutorial','previous','next','master','tutorial_related'));
        }
        /* lượt xem dịch vụ */
        public function handletutorial(Tutorial $tutorial)
        {
            $tutorial->increment('view_count');
        }
        public function search(Request $request)
        {
            // $data = $request->all(); //Nhận tất cả các giá trị
            // $query = $request->q;
            // $valid = [
            //     'search' => 'required'
            // ];

            // dd($search);
            // Article::whereSlug($seach)->whereTitle($search);
            // $articles = Article::where(function($search) use ($search){
            //     $search->where('name', 'LIKE','%'.$search.'%');
            //     $search->orwhere('title', 'LIKE','%'.$search.'%');
            // })->get();
            $master = [
                        'title' => 'Kết quả tìm kiếm',
                        'keywords' => 'Kết quả tìm kiếm',
                        'description' => 'Kết quả tìm kiếm',
                        'type' => '',
                        'img' => '',
                        'created_at' => '',
                        'updated_at' => ''
                        ];
            $settings   = Setting::get()->first();
            $search     = $request->get('search');
            $products   = Product::where('name', 'LIKE','%'.$search.'%')
                        // ->orwhere('title', 'LIKE','%'.$search.'%')
                        ->get();

            $search     = str::slug($request->search); //secure search

            return view('frontend.search.index', compact('products','settings','search','master'));
            // if (!$search) {
            //     return view('frontend.search.nokeywordsfound', compact('products','settings','search'));
            // }
            // if(count($products) > 0){
            //     return view('frontend.search.index', compact('products','settings'));
            // }else
            //     return view('frontend.search.noresultsfound', compact('products','settings','search'));
        }
    }