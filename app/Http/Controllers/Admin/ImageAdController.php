<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ImageAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageAds = ImageAd::all();
        return view('admin.contents.image_ads.index', compact('imageAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=$this->category_list();
        return view('admin.contents.image_ads.create',compact('categories'));
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
        ]);
        $input = $request->all();
        $image_url = $this->uploadImage($request->file('image'), '/image_ads');

        try {
            $image_ad = ImageAd::create($input);
            $image_ad->image()->create(['url' => $image_url]);

            Alert::success('', 'تبلیغ  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.imageAds.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ImageAd  $imageAd
     * @return \Illuminate\Http\Response
     */
    public function show(ImageAd $imageAd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ImageAd  $imageAd
     * @return \Illuminate\Http\Response
     */
    public function edit(ImageAd $imageAd)
    {
        $categories=$this->category_list();
        return view('admin.contents.image_ads.edit', compact('imageAd','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ImageAd $imageAd
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ImageAd $imageAd)
    {

//        return $request->all();
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'status' => 'required',
        ]);

        $input = $request->all();

        try {
            $image_url = $imageAd->image;
            if ($request->file('image')) {
                Storage::delete($image_url);
                $image_url = $this->uploadImage($request->file('image'), '/image_ads');
                $imageAd->image()->update(['url' => $image_url]);
            }

            $imageAd->update($input);
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.imageAds.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ImageAd $imageAd
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ImageAd $imageAd)
    {
        if ($imageAd->image) {
            Storage::delete($imageAd->image->url);

        }
        $imageAd->image()->delete();
        $imageAd->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
