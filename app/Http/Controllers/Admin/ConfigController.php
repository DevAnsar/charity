<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_logo = Config::where('key','app_logo')->first();

        $instant_offer = Config::where('key','instant_offer')->first();
        $categories=$this->category_list();

        $free_delivery=Config::where('key','free_delivery')->first();

        $prepayment=Config::where('key','prepayment')->first();

        return view('admin.configs.index', compact('instant_offer','categories','free_delivery','app_logo','prepayment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->file('app_logo')){
            Storage::delete(Config::where('key','app_logo')->first()->value);
            $url=$this->uploadImage($request->file('app_logo'),'/app');
            Config::where('key','app_logo')->first()->update(['value'=>$url]);
        }
        Config::where('key','instant_offer')->first()->update(['value'=>$request->input('instant_offer')]);

//        Config::where('key','free_delivery')->first()->update(['value'=>$request->input('free_delivery')]);
        Config::where('key','prepayment')->first()->update(['value'=>$request->input('prepayment')]);

        Alert::success('','ویرایش با موفقیت انجام شد');
        return redirect(route('panel.configs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
