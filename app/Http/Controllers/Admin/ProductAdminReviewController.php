<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductAdminReview;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductAdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        return view('admin.products.admin_reviews.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {

        return view('admin.products.admin_reviews.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Product $product
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Product $product, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'nullable'
        ]);

        $input = $request->all();
        try {
            $product->productAdminReviews()->create($input);

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'نقد جدید  با موفقیت افزوده  شد');
        return redirect(route('panel.productAdminReviews.index',['product'=>$product->id]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @param ProductAdminReview $productAdminReview
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product,ProductAdminReview $productAdminReview)
    {

        return view('admin.products.admin_reviews.edit', compact('product', 'productAdminReview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @param ProductAdminReview $productAdminReview
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Product $product,ProductAdminReview $productAdminReview,Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'nullable'
        ]);

        $input = $request->all();
        try {
            $productAdminReview->update($input);

        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'نقد  با موفقیت ویرایش  شد');
//        return redirect(route('panel.productAdminReviews.index',['product'=>$product->id]));
        return redirect(route('panel.productAdminReviews.index',['product'=>$product->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product $product
     * @param ProductAdminReview $productAdminReview
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product,ProductAdminReview $productAdminReview)
    {
        $productAdminReview->delete();
        Alert::success('', 'نقد و بررسی  با موفقیت حذف  شد');

        return redirect(route('panel.productAdminReviews.index',['product'=>$product->id]));
    }
}
