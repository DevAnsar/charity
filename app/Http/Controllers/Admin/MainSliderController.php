<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MainSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sliders = MainSlider::latest()->get();
        return view('admin.contents.main_slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=$this->category_list();
        return view('admin.contents.main_slider.create',compact('categories'));
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
            'image' => 'required|mimes:jpg,jpeg,png',
            'image_responsive' => 'required|mimes:jpg,jpeg,png',
            'status' => 'required',
        ]);
        $input = $request->all();
        $image_url = $this->uploadImage($request->file('image'), '/main_slider');
        $responsive_image_url = $this->uploadImage($request->file('image_responsive'), '/main_slider/responsive');

        try {
            MainSlider::create(array_merge($input, ['image' => $image_url, 'image_responsive' => $responsive_image_url]));
            Alert::success('', 'اسلاید  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.mainSliders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(MainSlider $mainSlider)
    {
        return $mainSlider;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MainSlider $mainSlider
     * @return \Illuminate\Http\Response
     */
    public function edit(MainSlider $mainSlider)
    {

        $categories=$this->category_list();
        return view('admin.contents.main_slider.edit', compact('mainSlider','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MainSlider $mainSlider
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, MainSlider $mainSlider)
    {

//        return $request->all();
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'image_responsive' => 'nullable|mimes:jpg,jpeg,png',
            'status' => 'required',
        ]);

        $input = $request->all();

        $image_url = $mainSlider->image;
        if ($request->file('image')) {
            Storage::delete($image_url);
            $image_url = $this->uploadImage($request->file('image'), '/main_slider');
        }

        $responsive_image_url = $mainSlider->image_responsive;
        if ($request->file('image_responsive')) {
            Storage::delete($responsive_image_url);
            $responsive_image_url = $this->uploadImage($request->file('image_responsive'), '/main_slider/responsive');
        }

        try {
            $mainSlider->update(array_merge($input, ['image' => $image_url, 'image_responsive' => $responsive_image_url]));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.mainSliders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MainSlider $mainSlider
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(MainSlider $mainSlider)
    {
        Storage::delete($mainSlider->image);
        Storage::delete($mainSlider->image_responsive);

        $mainSlider->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
