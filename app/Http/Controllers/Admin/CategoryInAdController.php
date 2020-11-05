<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryInAds;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryInAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $categoryInAds = CategoryInAds::with('category')->latest()->get();
        return view('admin.contents.category_in_ads.index', compact('categoryInAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $categories=$this->category_list();
        return view('admin.contents.category_in_ads.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'type_in_mobile' => 'nullable',
        ]);
        $input = $request->all();

        try {
            CategoryInAds::create($input);

            Alert::success('', 'دسته  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.categoryInAds.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param CategoryInAds $categoryInAds
     * @return CategoryInAds
     */
    public function show(CategoryInAds $categoryInAds)
    {
        return $categoryInAds;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CategoryInAds $categoryInAd
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(CategoryInAds $categoryInAd)
    {

        $categories=$this->category_list();
        return view('admin.contents.category_in_ads.edit', compact('categoryInAd','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param CategoryInAds $categoryInAd
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,CategoryInAds $categoryInAd)
    {

//        return $request->all();
        $this->validate($request, [
            'category_id' => 'required',
            'type_in_mobile' => 'nullable',
        ]);

        $input = $request->all();

        try {
            $categoryInAd->update($input);
            Alert::success('', 'ویرایش با موفقیت انجام شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'مشکلی پیش آمد');
        }

        return redirect(route('panel.categoryInAds.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CategoryInAds $categoryInAd
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(CategoryInAds $categoryInAd)
    {
        $categoryInAd->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
