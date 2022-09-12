<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        //@hhz
        Blade::directive('hhz',fn()=>"<h1>Hein Htet Zan</h1>");

        Blade::if('onlyAdmin',fn()=> auth()->user()->isAdmin() );

        View::share("my",(Object)["name"=>"hein htet zan","age"=>27,"gf"=>"poe"]);


        View::composer(['home','welcome'],function (){
            View::share('cat',Category::all());
        });
    }
}
