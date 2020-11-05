<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->parent_id) {
            $request->parent_id = 0;
        }
        $parent_id = $request->parent_id;

        if ($parent_id != 0) {
            $parent = BlogCategory::find($parent_id);
        } else {
            $parent = null;
        }
        $blogCategories = BlogCategory::where('parent_id', $parent_id)->latest()->get();

        return view('admin.blog_categories.index', compact('blogCategories','parent','parent_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->parent_id) {
            $request->parent_id = 0;
        }
        $parent_id = $request->parent_id;
        if ($parent_id != 0) {
            $parent = BlogCategory::find($parent_id);

        } else {
            $parent = null;
        }
        return view('admin.blog_categories.create',compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'title' => 'required',
        ]);

//        $parent = null;
//        if ($request->parent_id != 0) {
//            $parent = BlogCategory::find($request->parent_id);
//        }
        $input = $request->all();



        try {
            BlogCategory::create($input);
            Alert::success('', 'دسته  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.blogCategories.index', ['parent_id' => $request->parent_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        return view('admin.blog_categories.show', compact('blogCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory,Request $request)
    {
        $parent_id = $request->parent_id;
        if ($parent_id != 0) {
            $parent = BlogCategory::find($parent_id);

        } else {
            $parent = null;
        }

        return view('admin.blog_categories.edit', compact('blogCategory','parent','parent_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();


        try {
            $blogCategory->update($input);

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.blogCategories.index', ['parent_id' => $request->parent_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
