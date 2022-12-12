<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use View;
use Carbon;
use App\Models\Counter;
use App\Models\Online;
use CartHelper;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Sharing Data With All Views
        view()->composer('*', function($view){
            $view->with([
                'order' => new CartHelper()
            ]);
        });

        // https for route('name')
        // if (env('APP_ENV') === 'production') {
        //     URL::forceSchema('https');
        // }

        // View::composer('*', function ($view) {
        //     //
        // });
        // View::share('key', 'value');
        $counter_access['online'] = Online::get();
        $counter_access['day'] = Counter::whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-1 days')) )->count();
        $counter_access['week'] = Counter::whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-7 days')) )->count();
        $counter_access['month'] = Counter::whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-30 days')) )->count();
        $counter_access['year'] = Counter::whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-365 days')) )->count();
        $counter_access['total'] = Counter::count();
    
        View::share('counter_access', $counter_access);

        // $counter['day'] = Counter::whereDate('time', Carbon::today())->get()->count();
        // // $counter['day'] = Counter::whereDate('time', Carbon::dayOfWeek())->get()->count();
        // dd(Carbon::now()->dayOfWeek);
        // $counter['week'] = 2;   
        // $counter['month'] = 3;   
        // $counter['year'] = 4;   
        // View::share('counter',$counter);
    }
}
