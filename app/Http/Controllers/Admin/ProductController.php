<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\PropertyDefault;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_products()
    {
        $user = auth()->user();
        $products = $user->products;
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=$this->category_list();

        $users = User::role('store')->get();
        return view('admin.products.create', compact('users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return array
     */
    public function store(CreateProductRequest $request)
    {
//        return $request->all();
        $input = $request->all();
        try {
            if (auth()->user()->hasRole('admin')) {
                $user_id = $input['user_id'];
            } else {
                $user_id = auth()->user()->id;
            }
            $product = Product::create(array_merge($input, ['user_id' => $user_id]));
//            if (isset($input['image']) && $input['image']) {
//                foreach ($input['image'] as $img){
//                    $cacheUpload = Upload::query()->where('uuid', $img)->first();
//                    $mediaItem = $cacheUpload->getMedia('image')->first();
//                    $mediaItem->copy($product, 'image');
//                }

//            }
//            event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'محصول جدید  با موفقیت افزوده  شد');
        if ($product->category->level >= 2)
            return redirect(route('panel.products.properties.index', ['product' => $product]));
        else
            return redirect(route('panel.products.index'));
    }

    public function get_properties(Product $product)
    {

        $selected_category = $product->category;
        if ($selected_category->level == 1) {
//            $properties=$selected_category->properties()->get();
        } else if ($selected_category->level == 2) {
            $properties = $selected_category->properties()->with('defaults')->get();
        } else if ($selected_category->level == 3) {
            $properties = $selected_category->parent->properties()->with('defaults')->get();
        }
        return view('admin.products.set_properties', compact('product', 'properties'));
    }

    public function store_properties(Product $product, Request $request)
    {

//        return $request->all();
        $selected_category = $product->category;
        if ($selected_category->level == 1) {
//            $properties=$selected_category->properties()->get();
        } else if ($selected_category->level == 2) {
            $properties = $selected_category->properties()->with('defaults')->get();
        } else if ($selected_category->level == 3) {
            $properties = $selected_category->parent->properties()->with('defaults')->get();
        }

        foreach ($properties as $property) {
            $product_property_value = $product->property_values()->where('property_id', '=', $property->id)->first();

            if ($request->input($property->id)) {
                $property_value_id = $request->input($property->id);
                if (isset($property_value_id) && $property_value_id != 0) {
                    if ($product_property_value) {
                        $product_property_value->update([
                            'property_default_id' => $property_value_id,
                            'value' => PropertyDefault::find($property_value_id)->value,
                        ]);
                    } else {
                        $product->property_values()->create([
                            'property_id' => $property->id,
                            'property_default_id' => $property_value_id,
                            'value' => PropertyDefault::find($property_value_id)->value,
                        ]);
                    }
                } else {

                    if ($product_property_value) {
                        $product_property_value->delete();
                    }
                }
            } else {
                if ($product_property_value) {
                    $product_property_value->delete();
                }
            }
        }
        Alert::success('', 'ویژگی ها  با موفقیت به محصول افزوده  شد');
        if (auth()->user()->hasRole('admin')) {
            return redirect(route('panel.products.index'));
        } else {
            return redirect(route('panel.products.my_products'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function show(Product $product)
    {

        return $product;
//        return $product->image;
//        return


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function product_images(Product $product)
    {


        return view('admin.products.images',compact('product'));

    }
    public function store_image(Product $product,Request $request)
    {
        $this->createImage($request->file('image'),$product,'/images/products/'.$product->id,false);

        Alert::success('', 'تصویر  با موفقیت به محصول افزوده  شد');
        return redirect(route('panel.products.images.index',['product'=>$product]));
    }

    public function createImage($image_file, Model $model, $dir, $main_image = true)
    {

        $url = $this->uploadImage($image_file, $dir);

        if ($main_image) {
            $model->images()->where('isMain', true)->update(['isMain' => false]);
        }
        if (sizeof($model->images)==0){
            $main_image=true;
        }
        $image = $model->images()->create([
            'url' => $url,
            'isMain' => $main_image
        ]);

        return $image;
    }


    public function set_default_image(Product $product,Image $image){

        $product->images()->update(['isMain'=>false]);
        $check_status=!$image->isMain;
        $image->update(['isMain'=>$check_status]);

        if (!$check_status){
            $default_img=$product->images()->where('isMain',1)->get();
            if (sizeof($default_img)==0){
                $product->images()->first()->update([
                    'isMain'=>true
                ]);
            }
        }
        return response()->json([
           'status'=>true,
           'check_status'=>$image->isMain
        ]);
    }
    public function delete_image(Product $product,Image $image)
    {
        $image->delete();
        Alert::success('', 'تصویر  با موفقیت حذف  شد');
        return back();
    }

    public function updateImage($image_file, Model $model, $id, $main_image = false)
    {

//        $image_field=$model->images()->where('isMain', true)->first()
//        $url = $this->uploadImage($image_file, $dir);
//
//        if ($main_image) {
//            $model->images()->where('isMain', true)->first()->update(['isMain' => false]);
//        }
//        $model->images()->where->update([
//            'url' => $url,
//            'isMain' => $main_image
//        ]);
//        return $image;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = [];
        $cats_l1 = Category::whereParent_idAndStatus(0, 1)->get();
        foreach ($cats_l1 as $cat_l1) {

            if ($cat_l1->children()->get()->count() == 0) {
                $categories[] = [
                    'id' => $cat_l1->id,
                    'title' => $cat_l1->title
                ];
            } else {
                foreach ($cat_l1->children as $cat_l2) {

                    if ($cat_l2->children()->get()->count() == 0) {
                        $categories[] = [
                            'id' => $cat_l2->id,
                            'title' => $cat_l1->title . '-> (' . $cat_l2->title . ')'
                        ];
                    } else {
                        foreach ($cat_l2->children as $cat_l3) {
                            $categories[] = [
                                'id' => $cat_l3->id,
                                'title' => $cat_l1->title . '-> (' . $cat_l2->title . ') ->' . $cat_l3->title
                            ];
                        }
                    }

                }
            }
        }

        $users = User::role('store')->get();
        return view('admin.products.edit', compact('product', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $old_category_id = $product->category_id;
        try {
            if (auth()->user()->hasRole('admin')) {
                $user_id = $input['user_id'];
            } else {
                $user_id = auth()->user()->id;
            }
            $product->update(array_merge($input, ['user_id' => $user_id]));
            if (isset($input['image']) && $input['image']) {
                $cacheUpload = Upload::query()->where('uuid', $input['image'])->first();
                $mediaItem = $cacheUpload->getMedia('image')->first();
                $mediaItem->copy($product, 'image');
            }
//            event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'محصول  با موفقیت ویرایش  شد');

        if ($old_category_id != $product->category_id) {
            $product->property_values()->delete();
        }

        if ($product->category->level >= 2)
            return redirect(route('panel.products.properties.index', ['product' => $product]));
        else
            return redirect(route('panel.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->property_values()->delete();
        $product->delete();
        Alert::success('', 'محصول  با موفقیت حذف  شد');
        if (auth()->user()->hasRole('admin')) {
            return redirect(route('panel.products.index'));
        } else {
            return redirect(route('panel.products.my_products'));
        }
    }

    /**
     * Remove Media of User
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {

        if (auth()->user()->can('medias.delete')) {
            $input = $request->all();
            $user = User::find($input['id']);
            try {
                if ($user->hasMedia($input['collection'])) {
                    $user->getFirstMedia($input['collection'])->delete();
                }
            } catch (\Exception $e) {
//                    Log::error($e->getMessage());
            }
        }

    }
}
