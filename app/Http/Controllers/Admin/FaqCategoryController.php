<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqCategories = FaqCategory::oldest()->get();
        return view('admin.faq_categories.index', compact('faqCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq_categories.create');
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
            'image' => 'required|mimes:jpg,jpeg,png',
            'status' => 'required',
            'title' => 'required',
        ]);
        $input = $request->all();



        try {
            $faqCategory=FaqCategory::create($input);
            $image_url = $this->uploadImage($request->file('image'), '/faq/categories');
            $faqCategory->image()->create(['url'=>$image_url]);
            Alert::success('', 'دسته  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.faqCategories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FaqCategory  $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq_categories.edit', compact('faqCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\FaqCategory $faqCategory
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'title' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();


        try {
            $faqCategory->update($input);

            $image_url = $faqCategory->image->url;
            if ($request->file('image')) {
                Storage::delete($image_url);
                $image_url = $this->uploadImage($request->file('image'), '/faq/categories');
                $faqCategory->image()->update(['url'=>$image_url]);
            }

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.faqCategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FaqCategory $faqCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(FaqCategory $faqCategory)
    {
        Storage::delete($faqCategory->image->url);
        $faqCategory->image()->delete();
        $faqCategory->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
