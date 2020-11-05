<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class FooterLicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footer_licenses = FooterLicense::latest()->get();
        return view('admin.footer.footer_licenses.index', compact('footer_licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.footer.footer_licenses.create');
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
            'image' => 'required|mimes:jpg,jpeg,png,svg',
            'title' => 'required',
            'link' => 'nullable',
        ]);
        $input = $request->all();
        $image_url = $this->uploadImage($request->file('image'), '/footer/footer_licenses');

        try {
            $footer_license = FooterLicense::create($input);
            $footer_license->image()->create([
                'url' => $image_url
            ]);
            Alert::success('', 'مجوز  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerLicenses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterLicense  $footerLicense
     * @return \Illuminate\Http\Response
     */
    public function show(FooterLicense $footerLicense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterLicense  $footerLicense
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterLicense $footerLicense)
    {
        return view('admin.footer.footer_licenses.edit', compact('footerLicense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\FooterLicense $footerLicense
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, FooterLicense $footerLicense)
    {
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'title' => 'required',
            'link' => 'nullable',
        ]);

        $input = $request->all();

        try {
            $footerLicense->update($input);

            $image_url = $footerLicense->image->url;
            if ($request->file('image')) {
                Storage::delete($image_url);
                $image_url = $this->uploadImage($request->file('image'), '/footer/footer_licenses');
                $footerLicense->image()->update(['url' => $image_url]);
            }
            Alert::success('', 'ویرایش با موفقیت انجام شد');

        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerLicenses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterLicense $footerLicense
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(FooterLicense $footerLicense)
    {
        if ($footerLicense->image) {
            Storage::delete($footerLicense->image->url);
            $footerLicense->image()->delete();
        }

        $footerLicense->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
