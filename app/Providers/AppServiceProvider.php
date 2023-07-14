<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Language;
use App\Models\Review;
use App\Models\Settings;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


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
        $setting = Settings::first();
        View::share('setting',$setting);
        $languages = Language::all();
        View::share('languages',$languages);
        $contact = Contact::where('status','0')->get();
        View::share('contact',$contact);
        view()->composer('*', function($view) {
            $view->with('user', auth()->user());
        });
        Paginator::useBootstrapFour();
    }
}
