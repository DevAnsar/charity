<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FooterAdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footer_ads = FooterAd::latest()->get();
        return view('admin.footer.footer_ads.index', compact('footer_ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.footer.footer_ads.create');
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
//        return $request->all();
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'title' => 'required',
        ]);
        $input = $request->all();
        $image_url = $this->uploadImage($request->file('image'), '/footer/footer_ads');

        try {
            $footer_ad = FooterAd::create($input);
            $footer_ad->image()->create([
                'url' => $image_url
            ]);
            Alert::success('', 'تبلیغ  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerAds.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterAd $footerAd
     * @return \Illuminate\Http\Response
     */
    public function show(FooterAd $footerAd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterAd $footerAd
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterAd $footerAd)
    {
        return view('admin.footer.footer_ads.edit', compact('footerAd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\FooterAd $footerAd
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, FooterAd $footerAd)
    {
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'title' => 'required',
        ]);

        $input = $request->all();

        try {
            $footerAd->update($input);

            $image_url = $footerAd->image->url;
            if ($request->file('image')) {
                Storage::delete($image_url);
                $image_url = $this->uploadImage($request->file('image'), '/footer/footer_ads');
                $footerAd->image()->update(['url' => $image_url]);
            }
            Alert::success('', 'ویرایش با موفقیت انجام شد');

        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerAds.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterAd $footerAd
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(FooterAd $footerAd)
    {
        if ($footerAd->image) {
            Storage::delete($footerAd->image->url);
            $footerAd->image()->delete();
        }

        $footerAd->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
