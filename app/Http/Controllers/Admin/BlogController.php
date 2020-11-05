<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategories = BlogCategory::whereStatus(true)
            ->where('parent_id', '=', 0)
            ->with('real_children')
            ->with('real_children.real_children')
            ->get();

        return view('admin.blogs.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $blog = Blog::create($input);
        $image_url = $this->uploadImage($request->file('image'), "/blogs/$blog->id");
        $blog->image()->create(['url' => $image_url]);
        Alert::success('', 'مقاله  با موفقیت افزوده  شد');
        return redirect(route('panel.blogs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $blogCategories = BlogCategory::whereStatus(true)
            ->where('parent_id', '=', 0)
            ->with('real_children')
            ->with('real_children.real_children')
            ->get();
        return view('admin.blogs.edit', compact('blog', 'blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $input = $request->all();
        $blog->update($input);

        if ($request->file('image')) {
            $image_url = $this->uploadImage($request->file('image'), "/blogs/$blog->id");
            if ($blog->image) {
                Storage::delete($blog->image->url);
                $blog->image()->update(['url' => $image_url]);
            } else {
                $blog->image()->create(['url' => $image_url]);
            }


        }
        Alert::success('', 'مقاله  با موفقیت ویرایش  شد');
        return redirect(route('panel.blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::delete($blog->image->url);
            $blog->image()->delete();
        }
        $blog->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
