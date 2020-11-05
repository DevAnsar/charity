<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryInAds;
use App\Models\Collaborator;
use App\Models\Config;
use App\Models\ImageAd;
use App\Models\MainSlider;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    public function index()
    {

//        return auth()->user()->files;
        $mainSlider = MainSlider::whereStatus(1)->get();//
        $superDiscounts = Product::where('discount', '>', 0)->orderBy('discount', 'asc')->take(7)->get();

        $lastViews = Product::where('viewCount', '>=', 0)->orderBy('viewCount', 'desc')->take(10)->with('images')->get();//
        $lastSale = Product::where('saleCount', '>=', 0)->orderBy('saleCount', 'desc')->take(10)->with('images')->get();//

        $category_ads = Category::where('parent_id', '0')->with('image')->get();//

        $brands = Brand::where('status', 1)->with('image')->get();//

        $categoryInAds = CategoryInAds::with('category')->get();//

        $index_section_one_image_ads = ImageAd::where('status', 1)->where('section', 'index_section_one')->get();
        $index_section_two_image_ads = ImageAd::where('status', 1)->where('section', 'index_section_two')->get();

        $instant_offer = Config::where('key', 'instant_offer')->first();
        if ($instant_offer->value != '0') {
            $instant_category = Category::find($instant_offer->value);
            $instant_products = $instant_category->products()
                ->where('discount', '>=', 0)
                ->orderBy('discount', 'asc')
                ->take(7)->with('main_image')->get();
        } else {
            $instant_products = null;
        }
//        return $instant_products;

        return view('store.index',
            compact('mainSlider', 'superDiscounts', 'lastViews', 'lastSale', 'category_ads', 'brands', 'categoryInAds', 'index_section_one_image_ads', 'index_section_two_image_ads', 'instant_offer', 'instant_products'));

    }


    public function collaborator()
    {
        return view('store.collaborator');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public  function  collaborator_create(Request $request){
        $this->validate($request,[
           'name'=>'required|string',
           'family'=>'required',
           'code_melli'=>'required',
           'mobile'=>'required',
           'tell'=>'required',
           'address'=>'required',
           'type_of_cooperation'=>'required',
        ]);
        Collaborator::create($request->all());
        Alert::success('', 'درخواست همکاری شما با موفقیت ثبت شد. منتظر تماس مدیریت باشید');
        return redirect(route('site.index'));
    }
}
