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
// Auth::routes(['verify' => true]);
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::group([ 'prefix' => '', 'namespace' => 'Frontend'],function(){
    Route::get('sitemap.xml', 'SitemapController@sitemap')->name('frontend.sitemap.index');
    Route::get('/search.html', 'HomeController@search')->name('search.index')->where('search','[A-Za-z0-9]+');
    Route::get('', 'HomeController@index')->name('frontend.home.index');
    Route::get('gioi-thieu.html', 'HomeController@about')->name('frontend.about.index');
    Route::get('gop-y.html', 'HomeController@feedback')->name('frontend.feedback.index');
    Route::get('lien-he.html', 'HomeController@contact')->name('frontend.contact.index');
    Route::get('dang-ky-nhan-bao-gia.html', 'HomeController@price')->name('frontend.price.index');
    Route::get('author.html', 'HomeController@author')->name('frontend.author.index');
    // Products
    Route::get('san-pham/{slug}.html', 'ProductController@categories')->name('frontend.categories');
    Route::get('san-pham.html', 'ProductController@cat')->name('frontend.cat');
    Route::get('tin-tuc.html', 'HomeController@news')->name('frontend.news');
    Route::get('dich-vu.html', 'HomeController@servis')->name('frontend.servis');
    // Route::get('dich-vu.html', 'HomeController@all_policies')->name('frontend.all_policy.index');
    Route::get('chinh-sach/{slug}.html', 'HomeController@policy')->name('frontend.policy.index');
    Route::get('huong-dan/{slug}.html', 'HomeController@tutorial')->name('frontend.tutorial.index');
    Route::get('tin-tuc/{slug}.html', 'HomeController@posts')->name('frontend.posts.index');
    Route::get('dich-vu/{slug}.html', 'HomeController@serindex')->name('frontend.serindex.index');
    Route::get('{slug}.htmI', 'HomeController@dtpost')->name('frontend.dtpost.index');
    Route::get('{slug}.html', 'HomeController@products')->name('frontend.products.index');
    Route::get('producindex', 'HomeController@producindex')->name('frontend.productindex');
    Route::post('quickview', 'HomeController@quickview')->name('frontend.quickview');
});
// các route post không cần login, verified
Route::group(['prefix' => 'newsletters','namespace' => 'Backend'], function(){
    Route::post('/store', 'NewsletterController@store')->name('backend.newsletter.store');
});
Route::group([ 'prefix' => 'contact','namespace' => 'Backend'],function(){
    Route::post('/store', 'ContactformController@store')->name('backend.contactform.store');
});
Route::group([ 'prefix' => 'price','namespace' => 'Backend'],function(){
    Route::post('/store', 'PriceController@store')->name('backend.price.store');
});
// ['auth','verified']
Route::group([ 'prefix' => 'administrator' , 'middleware' => ['auth'] ,'namespace' => 'Backend'],function(){
    
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');

    Route::post('short-day', 'DashboardController@shortday')->name('backend.shortday.store');
    
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
        Route::post('', 'OrderController@postSearchTable')->name('backend.order.postSearchTable');
        Route::get('create', 'OrderController@create')->name('backend.order.create');
        Route::get('{id}/edit', 'OrderController@edit')->name('backend.order.edit');
        Route::put('{id}/update', 'OrderController@update')->name('backend.order.update');
        Route::delete('{id}/destroy', 'OrderController@destroy')->name('backend.order.destroy');
        Route::delete('{id}/destroyorderdetail', 'OrderController@destroyorderdetail')->name('backend.order.destroyorderdetail');
        Route::delete('deletemultiple', 'OrderController@deletemultiple')->name('backend.order.deletemultiple');
        Route::get('changeStt', 'OrderController@changeStt')->name('backend.order.changestt');
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
        Route::get('Read', 'ContactformController@Read')->name('backend.contactform.read');
        Route::get('changeStt', 'ContactformController@changeStt')->name('backend.contactform.changestt');
    });
    Route::group(['prefix' => 'prices'], function(){
        Route::get('', 'PriceController@index')->name('backend.price.index');
        Route::get('{id}/edit', 'PriceController@edit')->name('backend.price.edit');
        Route::put('{id}/update', 'PriceController@update')->name('backend.price.update');
        Route::delete('{id}/destroy', 'PriceController@destroy')->name('backend.price.destroy');
        Route::delete('deletemultiple', 'PriceController@deletemultiple')->name('backend.price.deletemultiple');
        Route::get('Read', 'PriceController@Read')->name('backend.price.read');
        Route::get('changeStt', 'PriceController@changeStt')->name('backend.price.changestt');
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
    Route::group(['prefix' => 'procatones'], function(){
        Route::get('', 'ProcatoneController@index')->name('backend.procatone.index');
        Route::get('create', 'ProcatoneController@create')->name('backend.procatone.create');
        Route::get('{id}/edit', 'ProcatoneController@edit')->name('backend.procatone.edit');
        Route::post('store', 'ProcatoneController@store')->name('backend.procatone.store');
        Route::put('{id}/update', 'ProcatoneController@update')->name('backend.procatone.update');
        Route::delete('{id}/destroy', 'ProcatoneController@destroy')->name('backend.procatone.destroy');
        Route::delete('/deletemultiple', 'ProcatoneController@deletemultiple')->name('backend.procatone.deletemultiple');
        Route::get('isFeatured', 'ProcatoneController@ChangeIsFeatured')->name('backend.procatone.isfeatured');
        Route::get('hideShow', 'ProcatoneController@hideShow')->name('backend.procatone.hideshow');
        Route::get('isNew', 'ProcatoneController@isNew')->name('backend.procatone.isnew');
        Route::get('changeStt', 'ProcatoneController@changeStt')->name('backend.procatone.changestt');
    });
    Route::group(['prefix' => 'procattwos'], function(){
        Route::get('', 'ProcattwoController@index')->name('backend.procattwo.index');
        Route::get('create', 'ProcattwoController@create')->name('backend.procattwo.create');
        Route::get('{id}/edit', 'ProcattwoController@edit')->name('backend.procattwo.edit');
        Route::post('store', 'ProcattwoController@store')->name('backend.procattwo.store');
        Route::put('{id}/update', 'ProcattwoController@update')->name('backend.procattwo.update');
        Route::delete('{id}/destroy', 'ProcattwoController@destroy')->name('backend.procattwo.destroy');
        Route::delete('/deletemultiple', 'ProcattwoController@deletemultiple')->name('backend.procattwo.deletemultiple');
        Route::get('isFeatured', 'ProcattwoController@ChangeIsFeatured')->name('backend.procattwo.isfeatured');
        Route::get('hideShow', 'ProcattwoController@hideShow')->name('backend.procattwo.hideshow');
        Route::get('isNew', 'ProcattwoController@isNew')->name('backend.procattwo.isnew');
        Route::get('changeStt', 'ProcattwoController@changeStt')->name('backend.procattwo.changestt');
    });
    Route::group(['prefix' => 'procatthrees'], function(){
        Route::get('', 'ProcatthreeController@index')->name('backend.procatthree.index');
        Route::get('create', 'ProcatthreeController@create')->name('backend.procatthree.create');
        Route::get('{id}/edit', 'ProcatthreeController@edit')->name('backend.procatthree.edit');
        Route::post('store', 'ProcatthreeController@store')->name('backend.procatthree.store');
        Route::put('{id}/update', 'ProcatthreeController@update')->name('backend.procatthree.update');
        Route::delete('{id}/destroy', 'ProcatthreeController@destroy')->name('backend.procatthree.destroy');
        Route::delete('/deletemultiple', 'ProcatthreeController@deletemultiple')->name('backend.procatthree.deletemultiple');
        Route::get('isFeatured', 'ProcatthreeController@ChangeIsFeatured')->name('backend.procatthree.isfeatured');
        Route::get('hideShow', 'ProcatthreeController@hideShow')->name('backend.procatthree.hideshow');
        Route::get('isNew', 'ProcatthreeController@isNew')->name('backend.procatthree.isnew');
        Route::get('changeStt', 'ProcatthreeController@changeStt')->name('backend.procatthree.changestt');
        Route::post('select', 'ProcatthreeController@select')->name('backend.procatthree.select');
    });
    Route::group(['prefix' => 'policies' ], function(){
        Route::get('', 'PolicyController@index')->name('backend.policy.index');
        Route::get('create', 'PolicyController@create')->name('backend.policy.create');
        Route::get('{id}/edit', 'PolicyController@edit')->name('backend.policy.edit');
        Route::post('store', 'PolicyController@store')->name('backend.policy.store');
        Route::put('{id}/update', 'PolicyController@update')->name('backend.policy.update');
        Route::delete('{id}/destroy', 'PolicyController@destroy')->name('backend.policy.destroy');
        Route::delete('deletemultiple', 'PolicyController@deletemultiple')->name('backend.policy.deletemultiple');
        Route::get('isFeatured', 'PolicyController@ChangeIsFeatured')->name('backend.policy.isfeatured');
        Route::get('hideShow', 'PolicyController@hideShow')->name('backend.policy.hideshow');
        Route::get('isNew', 'PolicyController@isNew')->name('backend.policy.isnew');
        Route::get('changeStt', 'PolicyController@changeStt')->name('backend.policy.changestt');
    });
    Route::group(['prefix' => 'criterias' ], function(){
        Route::get('', 'CriteriaController@index')->name('backend.criteria.index');
        Route::get('create', 'CriteriaController@create')->name('backend.criteria.create');
        Route::get('{id}/edit', 'CriteriaController@edit')->name('backend.criteria.edit');
        Route::post('store', 'CriteriaController@store')->name('backend.criteria.store');
        Route::put('{id}/update', 'CriteriaController@update')->name('backend.criteria.update');
        Route::delete('{id}/destroy', 'CriteriaController@destroy')->name('backend.criteria.destroy');
        Route::delete('deletemultiple', 'CriteriaController@deletemultiple')->name('backend.criteria.deletemultiple');
        Route::get('hideShow', 'CriteriaController@hideShow')->name('backend.criteria.hideshow');
        Route::get('changeStt', 'CriteriaController@changeStt')->name('backend.criteria.changestt');
    });
    Route::group(['prefix' => 'tutorials' ], function(){
        Route::get('', 'TutorialController@index')->name('backend.tutorial.index');
        Route::get('create', 'TutorialController@create')->name('backend.tutorial.create');
        Route::get('{id}/edit', 'TutorialController@edit')->name('backend.tutorial.edit');
        Route::post('store', 'TutorialController@store')->name('backend.tutorial.store');
        Route::put('{id}/update', 'TutorialController@update')->name('backend.tutorial.update');
        Route::delete('{id}/destroy', 'TutorialController@destroy')->name('backend.tutorial.destroy');
        Route::delete('deletemultiple', 'TutorialController@deletemultiple')->name('backend.tutorial.deletemultiple');
        Route::get('isFeatured', 'TutorialController@ChangeIsFeatured')->name('backend.tutorial.isfeatured');
        Route::get('hideShow', 'TutorialController@hideShow')->name('backend.tutorial.hideshow');
        Route::get('isNew', 'TutorialController@isNew')->name('backend.tutorial.isnew');
        Route::get('changeStt', 'TutorialController@changeStt')->name('backend.tutorial.changestt');
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
        Route::get('isFeatured', 'ProductController@ChangeIsFeatured')->name('backend.product.isfeatured');
        Route::get('hideShow', 'ProductController@hideShow')->name('backend.product.hideshow');
        Route::get('isNew', 'ProductController@isNew')->name('backend.product.isnew');
        Route::get('changeStt', 'ProductController@changeStt')->name('backend.product.changestt');
        Route::post('select', 'ProductController@select')->name('backend.product.select');
        Route::post('select-option', 'ProductController@select_option')->name('backend.product.select_option');
    });
    Route::group(['prefix' => 'newcategories'], function(){
        Route::get('', 'NewcategoryController@index')->name('backend.newcategory.index');
        Route::get('create', 'NewcategoryController@create')->name('backend.newcategory.create');
        Route::get('{id}/edit', 'NewcategoryController@edit')->name('backend.newcategory.edit');
        Route::post('store', 'NewcategoryController@store')->name('backend.newcategory.store');
        Route::put('{id}/update', 'NewcategoryController@update')->name('backend.newcategory.update');
        Route::delete('{id}/destroy', 'NewcategoryController@destroy')->name('backend.newcategory.destroy');
        Route::delete('deletemultiple', 'NewcategoryController@deletemultiple')->name('backend.newcategory.deletemultiple');
        Route::get('isFeatured', 'NewcategoryController@ChangeIsFeatured')->name('backend.newcategory.isfeatured');
        Route::get('hideShow', 'NewcategoryController@hideShow')->name('backend.newcategory.hideshow');
        Route::get('isNew', 'NewcategoryController@isNew')->name('backend.newcategory.isnew');
        Route::get('changeStt', 'NewcategoryController@changeStt')->name('backend.newcategory.changestt');
    });
    Route::group(['prefix' => 'posts'], function(){
        Route::get('', 'PostController@index')->name('backend.post.index')/**->middleware('role:news_index')**/;
        Route::get('create', 'PostController@create')->name('backend.post.create');
        Route::get('{id}/edit', 'PostController@edit')->name('backend.post.edit');
        Route::post('store', 'PostController@store')->name('backend.post.store');
        Route::put('{id}/update', 'PostController@update')->name('backend.post.update');
        Route::delete('{id}/destroy', 'PostController@destroy')->name('backend.post.destroy');
        Route::delete('deletemultiple', 'PostController@deletemultiple')->name('backend.post.deletemultiple');
        Route::get('isFeatured', 'PostController@ChangeIsFeatured')->name('backend.post.isfeatured');
        Route::get('hideShow', 'PostController@hideShow')->name('backend.post.hideshow');
        Route::get('isNew', 'PostController@isNew')->name('backend.post.isnew');
        Route::get('changeStt', 'PostController@changeStt')->name('backend.post.changestt');
    });
    Route::group(['prefix' => 'servis'], function(){
        Route::get('', 'ServiController@index')->name('backend.servi.index')/**->middleware('role:news_index')**/;
        Route::get('create', 'ServiController@create')->name('backend.servi.create');
        Route::get('{id}/edit', 'ServiController@edit')->name('backend.servi.edit');
        Route::post('store', 'ServiController@store')->name('backend.servi.store');
        Route::put('{id}/update', 'ServiController@update')->name('backend.servi.update');
        Route::delete('{id}/destroy', 'ServiController@destroy')->name('backend.servi.destroy');
        Route::delete('deletemultiple', 'ServiController@deletemultiple')->name('backend.servi.deletemultiple');
        Route::get('isFeatured', 'ServiController@ChangeIsFeatured')->name('backend.servi.isfeatured');
        Route::get('hideShow', 'ServiController@hideShow')->name('backend.servi.hideshow');
        Route::get('isNew', 'ServiController@isNew')->name('backend.servi.isnew');
        Route::get('changeStt', 'ServiController@changeStt')->name('backend.servi.changestt');
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
        Route::get('hideShow', 'SliderController@hideShow')->name('backend.slider.hideshow');
        Route::get('changeStt', 'SliderController@changeStt')->name('backend.slider.changestt');
    });
    Route::group(['prefix' => 'social'], function(){
        Route::get('', 'SliderController@index')->name('backend.social.index');
        Route::get('create', 'SliderController@create')->name('backend.social.create');
        Route::get('{id}/edit', 'SliderController@edit')->name('backend.social.edit');
        Route::post('store', 'SliderController@store')->name('backend.social.store');
        Route::delete('{id}/destroy', 'SliderController@destroy')->name('backend.social.destroy');
        Route::put('{id}/update', 'SliderController@update')->name('backend.social.update');
        Route::delete('deletemultiple', 'SliderController@deletemultiple')->name('backend.social.deletemultiple');
        Route::get('hideShow', 'SliderController@hideShow')->name('backend.social.hideshow');
        Route::get('changeStt', 'SliderController@changeStt')->name('backend.social.changestt');
    });
    Route::group(['prefix' => 'other'], function(){
        Route::get('', 'SliderController@index')->name('backend.other.index');
        Route::get('create', 'SliderController@create')->name('backend.other.create');
        Route::get('{id}/edit', 'SliderController@edit')->name('backend.other.edit');
        Route::post('store', 'SliderController@store')->name('backend.other.store');
        Route::delete('{id}/destroy', 'SliderController@destroy')->name('backend.other.destroy');
        Route::put('{id}/update', 'SliderController@update')->name('backend.other.update');
        Route::delete('deletemultiple', 'SliderController@deletemultiple')->name('backend.other.deletemultiple');
        Route::get('hideShow', 'SliderController@hideShow')->name('backend.other.hideshow');
        Route::get('changeStt', 'SliderController@changeStt')->name('backend.other.changestt');
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
        Route::get('status', 'UserController@status')->name('backend.user.status');
        Route::get('changeStt', 'UserController@changeStt')->name('backend.user.changestt');
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