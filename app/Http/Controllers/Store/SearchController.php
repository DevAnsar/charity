<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SearchProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search_product(Request $request){

        $string=$request->get('string','');

        if(strlen(trim($string))>=2){
            return view('store.search');
        }
        else{
            return  redirect('/');
        }

    }

    public function get_search_product(Request $request){

        $searchProduct=new SearchProduct($request);
        return $result=$searchProduct->getProduct();
    }

    public function cat_product($category_slug,Request $request){
        $category=Category::with('parent.parent')
            ->with('children')
            ->where('slug',$category_slug)->firstOrFail();
        $filter=Category::getCatFilter($category);

        return view('store.search',['filter'=>$filter,'category'=>$category]);
    }

    public function get_cat_product($category_slug,Request $request){
        $category=Category::with('children.children')
            ->where('slug',$category_slug)->firstOrFail();

        $searchProduct=new SearchProduct($request);
        $searchProduct->set_product_category($category);
//        $searchProduct->brands=$request->get('brand',null);
        return $result=$searchProduct->getProduct();
    }
}
