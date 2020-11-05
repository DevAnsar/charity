<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FaqCategory $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function index(FaqCategory $faqCategory)
    {
        $faqs = $faqCategory->faqs()->oldest()->get();
        return view('admin.faqs.index', compact('faqs','faqCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param FaqCategory $faqCategory
     * @return \Illuminate\Http\Response
     */
    public function create(FaqCategory $faqCategory)
    {
        return view('admin.faqs.create',compact('faqCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FaqCategory $faqCategory
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(FaqCategory $faqCategory,Request $request)
    {
        $this->validate($request, [
            'status' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'nullable',
        ]);
        $input = $request->all();



        try {
            $faqCategory->faqs()->create($input);
            Alert::success('', 'سوال  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.faqs.index',['faqCategory'=>$faqCategory]));
    }

    /**
     * Display the specified resource.
     *
     * @param FaqCategory $faqCategory
     * @param  \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function show(FaqCategory $faqCategory,Faq $faq)
    {
        return view('admin.faqs.show', compact('faq','faqCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FaqCategory $faqCategory
     * @param  \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(FaqCategory $faqCategory,Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq','faqCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FaqCategory $faqCategory
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(FaqCategory $faqCategory,Request $request, Faq $faq)
    {
        $this->validate($request, [
            'status' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'nullable',
        ]);
        $input = $request->all();



        try {
            $faq->update($input);
            Alert::success('', 'سوال  با موفقیت ویرایش  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.faqs.index',['faqCategory'=>$faqCategory]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FaqCategory $faqCategory
     * @param  \App\Models\Faq $faq
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(FaqCategory $faqCategory,Faq $faq)
    {

        $faq->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');
        return back();
    }
}
