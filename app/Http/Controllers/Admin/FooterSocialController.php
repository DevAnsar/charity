<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSocial;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footer_socials = FooterSocial::latest()->get();
        return view('admin.footer.footer_socials.index', compact('footer_socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.footer.footer_socials.create');
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
            'icon' => 'required',
            'title' => 'required',
            'link' => 'nullable',
        ]);
        $input = $request->all();

        try {
            FooterSocial::create($input);
            Alert::success('', 'مجوز  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerSocials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FooterSocial  $footerSocial
     * @return \Illuminate\Http\Response
     */
    public function show(FooterSocial $footerSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FooterSocial  $footerSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(FooterSocial $footerSocial)
    {
        return view('admin.footer.footer_socials.edit', compact('footerSocial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\FooterSocial $footerSocial
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, FooterSocial $footerSocial)
    {
        $this->validate($request, [
            'icon' => 'required',
            'title' => 'required',
            'link' => 'nullable',
        ]);

        $input = $request->all();

        try {
            $footerSocial->update($input);
            Alert::success('', 'ویرایش با موفقیت انجام شد');

        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.footerSocials.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FooterSocial $footerSocial
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(FooterSocial $footerSocial)
    {

        $footerSocial->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
