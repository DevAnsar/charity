<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ProductReviewCollection;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct(Request $request)
    {

        if ($request->headers->has('Authorization')){
            $this->middleware('auth:api');
        }
    }

    public function get_info($product_id,Request $request){
        $this->__construct($request);

        $product=Product::whereId($product_id)->with('images')->with('seller')->first();
        if (!$product){
            return abort(404);
        }

        $category=$product->category()->first();
        $category_line=$this->category_line($category);
        $property_values=$product->property_values()->with('property')->get();

        $is_favorite = $product->isFavorite();

//        if (auth()->check()){
//            return auth()->user()->favorites()->whereProduct_id($product_id)->first();
//        }

//        $productQuestions = $product->productQuestions()
//            ->whereParent_idAndStatus(0,'1')
//            ->oldest()
//            ->with('user')
//            ->with('children')
//            ->with('children.user')
//            ->get();

        $productReviewsCount=$product->productReviews()->whereStatus('1')->count();
        $productReviews = $product->productReviews()->whereStatus('1')->with('user')->oldest()->take(5)->get();
        $similarProducts = $product->category->products()->whereStatus('1')->with('user.image')->with('main_image')->oldest()->take(5)->get();

        $product->increment('viewCount');
        return response()->json([
            'product'=>$product,
            'category_line'=>$category_line,
            'property_values'=>$property_values,
            'is_favorite'=>$is_favorite,
            'productAdminReviews'=>$product->productAdminReviews()->get(),
//            'productQuestions'=>$productQuestions,
            'productReviews'=>new ProductReviewCollection($productReviews),
            'productReviewsCount'=>$productReviewsCount,
            'similarProducts'=>$similarProducts,
        ]);

    }

    public function get_reviews($product_id){
        $product=Product::find($product_id);
//        return $product;
        $productReviews = $product->productReviews()
            ->whereStatus('1')
            ->with('user')
            ->oldest()->get();
        return response()->json([
            'productReviews'=>new ProductReviewCollection($productReviews),
        ]);
    }

    public function set_reviews($product_id,Request $request){

        try {
            $this->validate($request, [
                'review' => 'required|min:2',
                'rate' => 'required',
            ]);
            $product=Product::find($product_id);
            $product->productReviews()->create([
                'user_id' => auth()->user()->id,
                'rate' => $request->rate,
                'review' => $request->review,
            ]);
            return response()->json([
                'status'=>true,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }


    }
}
