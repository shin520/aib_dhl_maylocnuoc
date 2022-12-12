<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::group([ 'prefix' => '', 'namespace' => 'Frontend'],function(){
    Route::get('sitemap.xml', 'SitemapController@sitemap')->name('frontend.sitemap.index');
    // Route::get('/search.html', 'HomeController@search')->name('search.index')->where('search','[A-Za-z0-9]+');
    Route::get('', 'HomeController@index')->name('frontend.home.index');
    Route::get('gioi-thieu.html', 'HomeController@about')->name('frontend.about.index');
    Route::get('gop-y.html', 'HomeController@feedback')->name('frontend.feedback.index');
    Route::get('lien-he.html', 'HomeController@contact')->name('frontend.contact.index');
    Route::get('author.html', 'HomeController@author')->name('frontend.author.index');
    // Products
    Route::get('menu/{slug}.html', 'ProductController@categories')->name('frontend.categories');
    Route::get('menu.html', 'ProductController@cat')->name('frontend.cat');
    Route::get('tin-tuc/{slug}.html', 'HomeController@posts')->name('frontend.posts.index');
    Route::get('{slug}.htm', 'HomeController@dtpost')->name('frontend.dtpost.index');
    Route::get('{slug}.html', 'HomeController@products')->name('frontend.products.index');
    Route::get('producindex', 'HomeController@producindex')->name('frontend.productindex');
});
// các route post không cần login, verified
Route::group(['prefix' => 'newsletters','namespace' => 'Backend'], function(){
    Route::post('/store', 'NewsletterController@store')->name('backend.newsletter.store');
});
Route::group([ 'prefix' => 'contact','namespace' => 'Backend'],function(){
    Route::post('/store', 'ContactformController@store')->name('backend.contactform.store');
});
Route::group([ 'prefix' => 'feedback','namespace' => 'Backend'],function(){
    Route::post('/store', 'FeedbackController@store')->name('backend.feedback.store');
});
Route::group([ 'prefix' => 'administrator' , 'middleware' => ['auth','verified'] ,'namespace' => 'Backend'],function(){
    Route::get('', 'DashboardController@index')->name('backend.dashboard.index');
    Route::group(['prefix' => 'about'], function(){
        Route::get('edit', 'AboutController@edit')->name('backend.about.edit');
        Route::put('update', 'AboutController@update')->name('backend.about.update');
    });
    Route::group(['prefix' => 'contact'], function(){
        Route::get('edit', 'ContactController@edit')->name('backend.contact.edit');
        Route::put('update', 'ContactController@update')->name('backend.contact.update');
    });
    Route::group(['prefix' => 'footer'], function(){
        Route::get('edit', 'FooterController@edit')->name('backend.footer.edit');
        Route::put('update', 'FooterController@update')->name('backend.footer.update');
    });
    Route::group(['prefix' => 'author'], function(){
        Route::get('edit', 'AuthorController@edit')->name('backend.author.edit');
        Route::put('update', 'AuthorController@update')->name('backend.author.update');
    });
    Route::group(['prefix' => 'orders'], function(){
        Route::get('', 'OrderController@index')->name('backend.order.index');
        Route::get('create', 'OrderController@create')->name('backend.order.create');
        Route::get('{id}/edit', 'OrderController@edit')->name('backend.order.edit');
        Route::put('{id}/update', 'OrderController@update')->name('backend.order.update');
        Route::delete('{id}/destroy', 'OrderController@destroy')->name('backend.order.destroy');
        Route::delete('deletemultiple', 'OrderController@deletemultiple')->name('backend.order.deletemultiple');
    });
    Route::group(['prefix' => 'newsletters'], function(){
        Route::resource('newsletter', 'NewsletterController');
        Route::delete('deletemultiple', 'NewsletterController@deletemultiple')->name('newsletter.delete.multiple');
    });
    Route::group(['prefix' => 'contactforms'], function(){
        Route::get('', 'ContactformController@index')->name('backend.contactform.index');
        Route::get('{id}/edit', 'ContactformController@edit')->name('backend.contactform.edit');
        Route::put('{id}/update', 'ContactformController@update')->name('backend.contactform.update');
        Route::delete('{id}/destroy', 'ContactformController@destroy')->name('backend.contactform.destroy');
        Route::delete('deletemultiple', 'ContactformController@deletemultiple')->name('backend.contactform.deletemultiple');
    });
    Route::group(['prefix' => 'feedbacks'], function(){
        Route::get('', 'FeedbackController@index')->name('backend.feedback.index');
        Route::get('{id}/edit', 'FeedbackController@edit')->name('backend.feedback.edit');
        Route::put('{id}/update', 'FeedbackController@update')->name('backend.feedback.update');
        Route::delete('{id}/destroy', 'FeedbackController@destroy')->name('backend.feedback.destroy');
        Route::delete('deletemultiple', 'FeedbackController@deletemultiple')->name('backend.feedback.deletemultiple');
    });
    Route::group(['prefix' => 'productcategories'], function(){
        Route::get('', 'ProductcategoryController@index')->name('backend.productcategory.index');
        Route::get('create', 'ProductcategoryController@create')->name('backend.productcategory.create');
        Route::get('{id}/edit', 'ProductcategoryController@edit')->name('backend.productcategory.edit');
        Route::post('store', 'ProductcategoryController@store')->name('backend.productcategory.store');
        Route::put('{id}/update', 'ProductcategoryController@update')->name('backend.productcategory.update');
        Route::delete('{id}/destroy', 'ProductcategoryController@destroy')->name('backend.productcategory.destroy');
        Route::delete('/deletemultiple', 'ProductcategoryController@deletemultiple')->name('backend.productcategory.deletemultiple');
    });
    Route::group(['prefix' => 'products'], function(){
        Route::get('', 'ProductController@index')->name('backend.product.index');
        Route::get('create', 'ProductController@create')->name('backend.product.create');
        Route::get('{id}/edit', 'ProductController@edit')->name('backend.product.edit');
        Route::post('store', 'ProductController@store')->name('backend.product.store');
        Route::put('{id}/update', 'ProductController@update')->name('backend.product.update');
        Route::delete('{id}/destroy', 'ProductController@destroy')->name('backend.product.destroy');
        Route::delete('deletemultiple', 'ProductController@deletemultiple')->name('backend.product.deletemultiple');
        Route::delete('{id}/delete', 'ProductController@delete')->name('backend.product.delete');
    });
    Route::group(['prefix' => 'newcategories'], function(){
        Route::get('', 'NewcategoryController@index')->name('backend.newcategory.index');
        Route::get('create', 'NewcategoryController@create')->name('backend.newcategory.create');
        Route::get('{id}/edit', 'NewcategoryController@edit')->name('backend.newcategory.edit');
        Route::post('store', 'NewcategoryController@store')->name('backend.newcategory.store');
        Route::put('{id}/update', 'NewcategoryController@update')->name('backend.newcategory.update');
        Route::delete('{id}/destroy', 'NewcategoryController@destroy')->name('backend.newcategory.destroy');
        Route::delete('deletemultiple', 'NewcategoryController@deletemultiple')->name('backend.newcategory.deletemultiple');
    });
    Route::group(['prefix' => 'posts'], function(){
        Route::get('', 'PostController@index')->name('backend.post.index')/**->middleware('role:news_index')**/;
        Route::get('create', 'PostController@create')->name('backend.post.create');
        Route::get('{id}/edit', 'PostController@edit')->name('backend.post.edit');
        Route::post('store', 'PostController@store')->name('backend.post.store');
        Route::put('{id}/update', 'PostController@update')->name('backend.post.update');
        Route::delete('{id}/destroy', 'PostController@destroy')->name('backend.post.destroy');
        Route::delete('deletemultiple', 'PostController@deletemultiple')->name('backend.post.deletemultiple');
    });
    Route::group(['prefix' => 'customers'], function(){
        Route::get('', 'CustomerController@index')->name('backend.customer.index');
        Route::get('create', 'CustomerController@create')->name('backend.customer.create');
        Route::get('{id}/edit', 'CustomerController@edit')->name('backend.customer.edit');
        Route::post('store', 'CustomerController@store')->name('backend.customer.store');
        Route::put('{id}/update', 'CustomerController@update')->name('backend.customer.update');
        Route::delete('{id}/destroy', 'CustomerController@destroy')->name('backend.customer.destroy');
        Route::delete('deletemultiple', 'CustomerController@deletemultiple')->name('backend.customer.deletemultiple');
    });
    Route::group(['prefix' => 'whys'], function(){
        Route::get('', 'CustomerController@index')->name('backend.why.index');
        Route::get('create', 'CustomerController@create')->name('backend.why.create');
        Route::get('{id}/edit', 'CustomerController@edit')->name('backend.why.edit');
        Route::post('store', 'CustomerController@store')->name('backend.why.store');
        Route::put('{id}/update', 'CustomerController@update')->name('backend.why.update');
        Route::delete('{id}/destroy', 'CustomerController@destroy')->name('backend.why.destroy');
        Route::delete('deletemultiple', 'CustomerController@deletemultiple')->name('backend.why.deletemultiple');
    });
    Route::group(['prefix' => 'slider'], function(){
        Route::get('', 'SliderController@index')->name('backend.slider.index');
        Route::get('create', 'SliderController@create')->name('backend.slider.create');
        Route::get('{id}/edit', 'SliderController@edit')->name('backend.slider.edit');
        Route::post('store', 'SliderController@store')->name('backend.slider.store');
        Route::delete('{id}/destroy', 'SliderController@destroy')->name('backend.slider.destroy');
        Route::put('{id}/update', 'SliderController@update')->name('backend.slider.update');
        Route::delete('deletemultiple', 'SliderController@deletemultiple')->name('backend.slider.deletemultiple');
    });
    Route::group(['prefix' => 'social'], function(){
        Route::get('', 'SliderController@index')->name('backend.social.index');
        Route::get('create', 'SliderController@create')->name('backend.social.create');
        Route::get('{id}/edit', 'SliderController@edit')->name('backend.social.edit');
        Route::post('store', 'SliderController@store')->name('backend.social.store');
        Route::delete('{id}/destroy', 'SliderController@destroy')->name('backend.social.destroy');
        Route::put('{id}/update', 'SliderController@update')->name('backend.social.update');
        Route::delete('deletemultiple', 'SliderController@deletemultiple')->name('backend.social.deletemultiple');
    });
    Route::group(['prefix' => 'other'], function(){
        Route::get('', 'SliderController@index')->name('backend.other.index');
        Route::get('create', 'SliderController@create')->name('backend.other.create');
        Route::get('{id}/edit', 'SliderController@edit')->name('backend.other.edit');
        Route::post('store', 'SliderController@store')->name('backend.other.store');
        Route::delete('{id}/destroy', 'SliderController@destroy')->name('backend.other.destroy');
        Route::put('{id}/update', 'SliderController@update')->name('backend.other.update');
        Route::delete('deletemultiple', 'SliderController@deletemultiple')->name('backend.other.deletemultiple');
    });
    Route::group(['prefix' => 'videos'], function(){
        Route::resource('video', 'VideoController');
        Route::delete('deletemultiple', 'VideoController@deletemultiple')->name('video.delete.multiple');
    });
    Route::group(['prefix' => 'settings'], function(){
        Route::get('edit', 'SettingController@edit')->name('backend.setting.edit');
        Route::put('update', 'SettingController@update')->name('backend.setting.update');
    });
    Route::group(['prefix' => 'users'], function(){
        Route::get('add_account', 'UserController@addaccount')->name('backend.user.addaccount');
        Route::get('', 'UserController@index')->name('backend.user.index');
        Route::get('create', 'UserController@create')->name('backend.user.create');
        Route::get('{id}/editinfo', 'UserController@editinfo')->name('backend.user.editinfo');
        Route::get('{id}/editpassword', 'UserController@editpassword')->name('backend.user.editpassword');
        Route::get('changeStatus', 'UserController@changeStatus')->name('backend.user.changestatus');
        Route::post('store', 'UserController@store')->name('backend.user.store');
        Route::put('{id}/updateinfo', 'UserController@updateinfo')->name('backend.user.updateinfo');
        Route::put('{id}/updatepassword', 'UserController@updatepassword')->name('backend.user.updatepassword');
        Route::delete('{id}/destroy', 'UserController@destroy')->name('backend.user.destroy');
        Route::delete('deletemultiple', 'UserController@deletemultiple')->name('backend.user.deletemultiple');
    });
    Route::group(['prefix' => 'tags'], function(){
        Route::get('', 'TagController@index')->name('backend.tag.index');
        Route::get('create', 'TagController@create')->name('backend.tag.create');
        Route::get('{id}/edit', 'TagController@edit')->name('backend.tag.edit');
        Route::post('store', 'TagController@store')->name('backend.tag.store');
        Route::put('{id}/update', 'TagController@update')->name('backend.tag.update');
        Route::delete('{id}/destroy', 'TagController@destroy')->name('backend.tag.destroy');
        Route::delete('deletemultiple', 'TagController@deletemultiple')->name('backend.tag.deletemultiple');
        Route::get('/{id}/view', 'TagController@view')->name('backend.tag.view');
    });
});
// Custom cart
Route::group(['prefix' => 'order'], function(){
    Route::get('view', 'CartCustomController@view')->name('order.view');
    Route::get('add-now/{id}', 'CartCustomController@add_now')->name('order.now');
    Route::post('add-now-quantity', 'CartCustomController@add_now_quantity')->name('order.now.quantity');
    Route::get('add-to-cart-quantity/{id}', 'CartCustomController@add_to_cart_quantity')->name('order.tocart.quantity');
    Route::get('add/{id}', 'CartCustomController@add')->name('order.add');
    Route::get('remove/{id}', 'CartCustomController@remove')->name('order.remove');
    Route::get('update/{id}', 'CartCustomController@update')->name('order.update');
    Route::get('clear', 'CartCustomController@clear')->name('order.clear');
    Route::post('update-cart', 'CartCustomController@update_cart')->name('order.update_cart');
});
// Checkout cart
Route::group(['prefix' => 'checkout'], function(){
    Route::get('', 'OrderController@form')->name('checkout');
    Route::post('', 'OrderController@submit_form')->name('checkout');
    Route::get('checkout-success', 'OrderController@success')->name('frontend.checkout.success');
    Route::post('feeship-select-home', 'OrderController@selecthome')->name('feeship.select.home');
    Route::post('calculate-fee', 'OrderController@calculate_fee')->name('calculate.fee');
    Route::get('delete-fee', 'OrderController@delete_fee')->name('delete.fee');
});
// Login - Logout
Route::get('logout', function(){
    \Auth::logout();
    return redirect()->route('login');
});
// Auth::routes();