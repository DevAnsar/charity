<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {

        if (!$request->category) {
            $request->category = null;
        }
        $selected_category_slug = $request->category;

        if ($selected_category_slug == null) {
            $blogs = Blog::whereStatus('1')->latest()->get();
        } else {
            $blog_category=BlogCategory::whereSlug($selected_category_slug)->first();
            $blogs=$blog_category->blogs()->whereStatus(1)->latest()->get();
//            $blogs = Blog::whereStatus('1')->latest()->get();
        }

        $blogCategories = BlogCategory::whereStatus(true)
            ->where('parent_id', '=', 0)
            ->with('real_children')
            ->with('real_children.real_children')
            ->get();

        $new_blogs = Blog::whereStatus('1')->latest()->take(5)->get();
        return view('store.blog.blog', compact('blogs', 'new_blogs', 'blogCategories'));
    }

    public function show($blog_slug)
    {

        $blog = Blog::whereStatus('1')->whereSlug($blog_slug)->first();

        $blogCategories = BlogCategory::whereStatus(true)
            ->where('parent_id', '=', 0)
            ->with('real_children')
            ->with('real_children.real_children')
            ->get();

        if (!$blog) {
            return abort('404');
        }
        $new_blogs = Blog::whereStatus('1')->latest()->take(5)->get();

//        $blog->increment('viewCount');
        return view('store.blog.blog_single', compact('blog', 'new_blogs', 'blogCategories'));
    }
}
