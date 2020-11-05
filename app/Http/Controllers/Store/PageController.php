<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page_show($slug){
        $page=Page::whereSlug($slug)->first();
        if (!$page){
            return abort('404','صفحه ای که به دنبال آن هستید یافت نشد');
        }
        return view('store.page',compact('page'));
    }
}
