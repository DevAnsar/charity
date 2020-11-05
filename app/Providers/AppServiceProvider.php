<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FooterAd;
use App\Models\FooterDetail;
use App\Models\FooterLicense;
use App\Models\FooterSocial;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('store.layouts.header',function ($view){

            $categories = Category::whereParent_idAndStatus(0, 1)->get();
            foreach ($categories as $cat_l1) {
                $children = $cat_l1->children;
                foreach ($children as $child) {
                    $child->children;
                }
            }
            $view->with(compact('categories'));
        });

        view()->composer('store.layouts.footer',function ($view){

            $footer_details=FooterDetail::first();
            $footer_ads=FooterAd::oldest()->get();
            $footer_licenses=FooterLicense::oldest()->get();
            $footer_socials=FooterSocial::oldest()->get();
            $view->with(compact('footer_details','footer_ads','footer_licenses','footer_socials'));
        });
    }
}
