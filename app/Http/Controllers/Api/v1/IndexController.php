<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryInAds;
use App\Models\City;
use App\Models\ImageAd;
use App\Models\MainSlider;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){


        $mainSlider=MainSlider::whereStatus(1)->get();//
//        $superDiscounts=Product::where('discount','>',0)->orderBy('discount','asc')->take(7)->get();

        $lastViews=Product::where('status','=',1)->where('viewCount','>=',0)
            ->orderBy('viewCount','asc')
            ->take(10)
            ->with('images')
            ->with('seller')
            ->get();//

        $lastSales=Product::where('status','=',1)->where('saleCount','>=',0)
            ->orderBy('saleCount','asc')
            ->take(10)
            ->with('images')
            ->with('seller')
            ->get();//

//        $category_ads=Category::where('parent_id','0')->with('image')->get();//

        $brands=Brand::where('status',1)->with('image')->get();//

        $categoryInAds=CategoryInAds::with('category')
            ->with('category.products')
            ->with('category.products.images')
            ->get();//

        $index_section_one_image_ads = ImageAd::where('status', 1)
            ->where('showInApp',true)->where('section', 'index_section_one')->with('image')->get();

        $index_section_two_image_ads = ImageAd::where('status', 1)
            ->where('showInApp',true)->where('section', 'index_section_two')->with('image')->get();

        return response()->json([

            'mainSlider'=>$mainSlider,
            'lastViews'=>$lastViews,
            'lastSales'=>$lastSales,
//            'category_ads'=>$category_ads,
            'brands'=>$brands,
            'categoryInAds'=>$categoryInAds,
            'imageAds1'=>$index_section_one_image_ads,
            'imageAds2'=>$index_section_two_image_ads,
        ]);
    }

    public function getCities(){
        $cities=City::whereParent_id(0)->oldest()->with('children')->get();

        return response()->json([
            'cities'=>$cities
        ]);
    }
}
