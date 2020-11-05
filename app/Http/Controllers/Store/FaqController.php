<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
   public function index(Request $request){

       $faqCategories=FaqCategory::whereStatus(true)->oldest()->get();
       $repetitives=Faq::whereStatusAndRepetitive(true,true)->oldest()->get();

       $q=$request->q;
       $search=[];
       if ($q){
           $search=Faq::whereStatus(true)
               ->where('title','LIKE','%'.$q.'%')
               ->orWhere('description','LIKE','%'.$q.'%')
               ->orWhere('body','LIKE','%'.$q.'%')
               ->oldest()
               ->get();
       }
       return view('store.faq.index',compact('faqCategories','repetitives','q','search'));
   }

   public function getCategory(FaqCategory $faqCategory){

       $faqs=$faqCategory->faqs()->whereStatus(true)->oldest()->get();
       $repetitives=Faq::whereStatusAndRepetitive(true,true)->oldest()->get();

       return view('store.faq.category',compact('faqs','faqCategory','repetitives'));
   }

   public function getQuestion(Faq $faq){

//       return $faq;
//       $faqs=$faqCategory->faqs()->whereStatus(true)->oldest()->get();
       $repetitives=Faq::whereStatusAndRepetitive(true,true)->oldest()->get();

       return view('store.faq.question',compact('faq','repetitives'));
   }
}
