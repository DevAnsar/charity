<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Models\PropertyDefault;
use Illuminate\Http\Request;
Use Alert;

class PropertyDefaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @param Property $property
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Category $category, Property $property)
    {
        $defaults = $property->defaults;
        return view('admin.default_properties.index', compact('category', 'property', 'defaults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category, Property $property)
    {
        return view('admin.default_properties.create', compact('category', 'property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Category $category
     * @param Property $property
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Category $category, Property $property, Request $request)
    {
        $this->validate($request, [
            'value' => 'required'
        ]);
        $input = $request->all();
        try {
            $property->defaults()->create($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Alert::success('', 'مقدار با موفقیت افزوده  شد');
        return redirect(route('panel.propertyDefaults.index', ['category' => $category, 'property' => $property]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyDefault $propertyDefault
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyDefault $propertyDefault)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param Property $property
     * @param  \App\Models\PropertyDefault $propertyDefault
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Property $property, PropertyDefault $propertyDefault)
    {
        return view('admin.default_properties.edit', compact('category', 'property', 'propertyDefault'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param Property $property
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\PropertyDefault $propertyDefault
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Property $property, Request $request, PropertyDefault $propertyDefault)
    {
        $input = $request->all();
        try {
            $propertyDefault->update($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

//        Flash::success('saved successfully.');
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.propertyDefaults.index', ['category' => $category, 'property' => $property]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param Property $property
     * @param  \App\Models\PropertyDefault $propertyDefault
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Category $category, Property $property, PropertyDefault $propertyDefault)
    {
        if (empty($propertyDefault)) {
            Alert::warning('', 'مقدار یافت نشد');
            return back();
        }

        $propertyDefault->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
