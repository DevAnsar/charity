<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->parent) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $state = City::find($parent);
            $level =2;
        } else {
            $state = null;
            $level = 1;
        }
        $cities = City::where('parent_id', $parent)->oldest()->get();
        return view('admin.cities.index', compact('cities', 'parent', 'level', 'state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->parent) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $state = City::find($parent);
            $level =2;
        } else {
            $state = null;
            $level = 1;
        }
        return view('admin.cities.create', compact('state', 'level', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
//        $parent = null;
//        if ($request->parent_id != 0) {
//            $parent = City::find($request->parent_id);
//        }

        try {

            $city = City::create($input);

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }

        Alert::success('', 'شهر  با موفقیت افزوده  شد');
        return redirect(route('panel.cities.index', ['parent' => $request->parent_id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City $city
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city,Request $request)
    {
        if (!$request->parent) {
            $request->parent = 0;
        }
        $parent = $request->parent;
        if ($parent != 0) {
            $state = City::find($parent);
            $level = 2;
        } else {
            $state = null;
            $level = 1;
        }
//        dd($father_category);
        return view('admin.cities.edit', compact('city', 'state', 'level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $input = $request->all();

        try {
            $city->update($input);

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.cities.index', ['parent' => $request->parent_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City $city
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(City $city)
    {
        $city->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
