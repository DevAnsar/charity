<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->parent) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $father_category = Category::find($parent);
            $level = $father_category->level + 1;
        } else {
            $father_category = null;
            $level = 1;
        }
        $categories = Category::where('parent_id', $parent)->latest()->get();
        return view('admin.categories.index', compact('categories', 'parent', 'level', 'father_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if (!$request->parent) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $father_category = Category::find($parent);
            $level = $father_category->level + 1;
        } else {
            $father_category = null;
            $level = 1;
        }
        return view('admin.categories.create', compact('father_category', 'level', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $parent = null;
        if ($request->parent_id != 0) {
            $parent = Category::find($request->parent_id);
        }
        $input['level'] = $request->parent_id == 0 ? 1 : $parent->level + 1;
        try {

            $category = Category::create($input);
            if ($request->file('image')) {
                $image_url = $this->uploadImage($request->file('image'), '/categories');
                $category->image()->create([
                    'url' => $image_url,
                    'isMain' => 1,
                ]);
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Alert::success('', 'دسته  با موفقیت افزوده  شد');
        return redirect(route('panel.categories.index', ['parent' => $request->parent_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category $category
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Request $request)
    {
        if (!$request->paren) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $father_category = Category::find($parent);
            $level = $father_category->level + 1;
        } else {
            $father_category = null;
            $level = 1;
        }
//        dd($father_category);
        return view('admin.categories.edit', compact('category', 'father_category', 'level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $input = $request->all();
//        $parent=null;
////        if ($request->parent_id!=0){
////            $parent=Category::find($request->parent_id);
////        }
//        $input['level'] =$request->parent_id==0?1:$parent->level+1;
        try {
            $category->update($input);

            if ($request->file('image')) {

                $image_url = $this->uploadImage($request->file('image'), '/categories');
                if ($category->image) {
                    Storage::delete($category->image->url);
                    $category->image()->update([
                        'url' => $image_url,
                        'isMain' => 1,
                    ]);
                } else {
                    $category->image()->create([
                        'url' => $image_url,
                        'isMain' => 1,
                    ]);
                }
            }
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.categories.index', ['parent' => $request->parent_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
