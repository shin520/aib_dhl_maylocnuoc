<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

// Custom share view
use Setting;
use About;
use Productcategory;
use Procatone;
use Procattwo;
use Procatthree;
use Product;
use Video;
use Newcategory;
use Post;
use Contact;
use Contactform;
use Price;
use Order;
use Policy;
use Tutorial;
use Newsletter;
use Author;
use Slider;
use Customer;
use Footer;
use View;
use User;
use Session;
use App;
// End custom share view

class ShareController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
  {
    // $this->middleware(function ($request, $next) {
    //     if ($lang = Session::get('locale') == '') {
    //         $lang = App::getLocale();

    //     }else {
    //         $lang = Session::get('locale');
    //     }              
    //     View::share('lang', $lang);
    //     return $next($request);
    // });
    // if ($lang = Session::get('locale') == '') {
    //     $lang = App::getLocale(); // set default lang
    // }else {
    //     $lang = Session::get('locale'); // get value from session
    //     dd($lang);
    // }              
    // View::share('lang', $lang); // set value for all View
    $setting = Setting::get()->first();
    $abouts = About::get()->where('hide_show',1)->first();
    $productcategories = Productcategory::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $procats = Productcategory::where('parent_id',0)->where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $pro_cats = Productcategory::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    // $pro_cats = Productcategory::where('hide_show',1)->orderBy('stt', 'asc')->get()->toArray();
    // dd($pro_cats);
    $products = Product::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $pro_news = Product::where('hide_show',1)->where('is_new',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $pro_discounts = Product::where('hide_show',1)->where('discount','>',0)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $all_products = Product::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->paginate(12);
    $all_products_index = Product::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    // $product = Product::get();
    $videos = Video::where('hide_show',1)->where('is_featured',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $policies = Policy::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $tutorials = Tutorial::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $newcategories = Newcategory::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $posts = Post::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $contacts = Contact::get()->where('hide_show',1)->first();
    $contactforms = Contactform::orderBy('stt','asc')->orderBy('id','desc')->get();
    $prices = Price::orderBy('stt','asc')->orderBy('id','desc')->get();
    $orders = Order::orderBy('id','asc')->get();
    $newsletters = Newsletter::orderBy('stt','asc')->orderBy('id','desc')->get();
    $author = Author::where('hide_show',1)->first();
    $sliders = Slider::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $customers = Customer::where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
    $footer = Footer::where('hide_show',1)->first();

    View::share('setting', $setting);
    View::share('abouts', $abouts);
    View::share('productcategories', $productcategories);
    View::share('procats', $procats);
    View::share('pro_cats', $pro_cats);
    View::share('products', $products);
    View::share('pro_news', $pro_news);
    View::share('pro_discounts', $pro_discounts);
    View::share('all_products', $all_products);
    View::share('all_products_index', $all_products_index);
    View::share('policies', $policies);
    View::share('tutorials', $tutorials);
    // View::share('product', $product);
    View::share('videos', $videos);
    View::share('newcategories', $newcategories);
    View::share('posts', $posts);
    View::share('contacts', $contacts);
    View::share('contactforms', $contactforms);
    View::share('prices', $prices);
    View::share('orders', $orders);
    View::share('newsletters', $newsletters);
    View::share('author', $author);
    View::share('sliders', $sliders);
    View::share('customers', $customers);
    View::share('footer', $footer);
  }
}