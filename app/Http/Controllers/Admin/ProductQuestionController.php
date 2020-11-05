<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductQuestionController extends Controller
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

            $productQuestions=ProductQuestion::whereStatus('1');
        }else if($list=='awaiting'){

            $productQuestions=ProductQuestion::whereStatus('0');
        }else if ($list=='failed'){

            $productQuestions=ProductQuestion::whereStatus('-1');
        }

        $productQuestions=$productQuestions->with('product')->with('user')->latest()->get();
//        return $productReviews;
        return view('admin.product_questions.index',compact('list','productQuestions'));
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
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductQuestion $productQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductQuestion $productQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ProductQuestion $productQuestion
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ProductQuestion $productQuestion)
    {
        $this->validate($request,[
            'content'=>'required',
            'status'=>'required',
        ]);
        $productQuestion->update($request->all());
        Alert::success('', 'پرسش/پاسخ  با موفقیت ویرایش  شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductQuestion $productQuestion
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(ProductQuestion $productQuestion)
    {
        $productQuestion->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
