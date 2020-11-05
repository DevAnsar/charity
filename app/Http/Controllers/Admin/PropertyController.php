<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\CreatePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
Use Alert;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @param Request $request
     * @return Category
     */
    public function index(Category $category,Request $request)
    {
        $properties=$category->properties;
        return view('admin.properties.index',compact('category','properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {

        return view('admin.properties.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Category $category
     * @param CreatePropertyRequest $request
     * @return Category
     */
    public function store(Category $category,CreatePropertyRequest $request)
    {
        $input = $request->all();
        try {
            $category->properties()->create($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Alert::success('', 'ویژگی  با موفقیت افزوده  شد');
        return redirect(route('panel.properties.index',['category'=>$category]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param Property $property
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category,Property $property)
    {
        return view('admin.properties.edit',compact('category','property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param  \Illuminate\Http\Request $request
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category,UpdatePropertyRequest $request, Property $property)
    {
//        return $request->all();
        $input = $request->all();
        try {
            $property->update($input);
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.properties.index',['category'=>$category]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param Property $property
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category,Property $property)
    {
        if (empty($property)) {
//            Flash::error('Permission not found');

            return redirect(route('panel.permissions.index'));
        }

        $property->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return redirect(route('panel.properties.index',['category'=>$category]));
    }
}
