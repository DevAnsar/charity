<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_info(){
        $main_categories=Category::whereParent_id(0)
            ->with('image')
            ->with('limit_children')
            ->with('limit_children.image')
            ->get();


        return response()->json([
            'categories'=>$main_categories,
        ]);

    }

    public function get_details($category_id){
        $category=Category::whereId($category_id)->first();

        return response()->json([
            'categories'=>$category->children()->whereStatus(true)->with('image')->get(),
            'products'=>$category->products()->whereStatus('1')->with('main_image')->latest()->get(),
            'most_visited'=>$category->products()->where('viewCount','>','0')->whereStatus('1')->with('main_image')->orderByRaw("CAST(viewCount as signed) DESC")->get(),
            'most_sales'=>$category->products()->where('saleCount','>=','0')->whereStatus('1')->with('main_image')->orderByRaw("CAST(saleCount as signed) DESC")->get(),
            'newest'=>$category->products()->whereStatus('1')->with('main_image')->orderBy('created_at','desc')->get(),
        ]);

    }
}
