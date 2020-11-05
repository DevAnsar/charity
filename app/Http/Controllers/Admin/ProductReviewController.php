<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list=$request->list;
        if ($list=='all' || $list=='' || $list==null){

            $productReviews=ProductReview::whereStatus('1');
        }else if($list=='awaiting'){

            $productReviews=ProductReview::whereStatus('0');
        }else if ($list=='failed'){

            $productReviews=ProductReview::whereStatus('-1');
        }

        $productReviews=$productReviews->with('product')->with('user')->latest()->get();
//        return $productReviews;
        return view('admin.product_reviews.index',compact('list','productReviews'));
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
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductReview $productReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ProductReview $productReview
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ProductReview $productReview)
    {
        $this->validate($request,[
            'review'=>'required',
            'rate'=>'required',
            'status'=>'required',
        ]);
        $productReview->update($request->all());
        Alert::success('', 'نظر  با موفقیت ویرایش  شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReview $productReview
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ProductReview $productReview)
    {

        $productReview->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
