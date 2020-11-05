<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\FooterDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FooterDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $footer_details=FooterDetail::first();
        return view('admin.footer.footer_details.index', compact('footer_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        return $request->all();
        FooterDetail::first()->update($request->all());
        Alert::success('','ویرایش با موفقیت انجام شد');
        return back();
    }
}
