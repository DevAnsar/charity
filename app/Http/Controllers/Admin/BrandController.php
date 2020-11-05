<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\MainSlider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $brands = Brand::latest()->get();
        return view('admin.contents.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create()
    {

        return view('admin.contents.brands.create');
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
            'status' => 'required',
        ]);
        $input = $request->all();
        $image_url = $this->uploadImage($request->file('image'), '/brands');

        try {
            $brand = Brand::create(array_merge($input));
            $brand->image()->create(['url' => $image_url]);

            Alert::success('', 'برند  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.brands.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @return Brand
     */
    public function show(Brand $brand)
    {
        return $brand;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return Response
     */
    public function edit(Brand $brand)
    {

        return view('admin.contents.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Brand $brand)
    {

//        return $request->all();
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'status' => 'required',
        ]);

        $input = $request->all();

        try {
            $image_url = $brand->image;
            if ($request->file('image')) {
                Storage::delete($image_url);
                $image_url = $this->uploadImage($request->file('image'), '/brands');
                $brand->image()->update(['url' => $image_url]);
            }

            $brand->update($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.brands.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return Response
     * @throws \Exception
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image) {
            Storage::delete($brand->image->url);

        }
        $brand->image()->delete();
        $brand->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
