<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Product;
use App\Models\ProductQuestion;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public $UB = 'user.baskets';

    public function get_info($product_slug)
    {
        $product = Product::whereSlug($product_slug)->first();
        if (!$product) {
            return abort(404);
        }

        $category = $product->category;
        $category_line = $this->category_line($category);
        $property_values = $product->property_values()->with('property')->get();

        $product->increment('viewCount');

        $has_in_basket = false;
        $basket = session()->get($this->UB);
        if (is_array($basket)) {
            foreach ($basket as $item) {
                if ($item['product_id'] == $product->id) {
                    $has_in_basket = true;
                }
            }
        }

        $is_favorite = $product->isFavorite();

        $productReviews = $product->productReviews()->whereStatus('1')->oldest()->get();
        $productQuestions = $product->productQuestions()->whereParent_idAndStatus(0, '1')->oldest()->with('children')->get();

        $prepayment = 100;
        $prepayment_field = Config::where('key', 'prepayment')->first();
        if ($prepayment_field) {
            $prepayment = $prepayment_field->value;
        }
        $price = $product->price;
        $needy_price=$price*($prepayment/100);
        $product['needy_price'] =$needy_price;
        $product['helper_price'] = $price-$needy_price;

        return view('store.product', compact('product', 'category_line', 'property_values', 'has_in_basket', 'is_favorite', 'productReviews', 'productQuestions'));
    }

    public function get_favorite(Product $product, Request $request)
    {

        $user = auth()->user();
        $favorite = $user->favorites()->whereProduct_id($product->id)->first();
        if ($favorite) {
            $favorite->delete();
            $is_favorite = false;
        } else {
            $user->favorites()->create(['product_id' => $product->id]);
            $is_favorite = true;
        }
//        return $product;

        return response()->json([
            'status' => true,
            'is_favorite' => $is_favorite
        ]);
    }

    public function getReviewForm($product_slug)
    {
        $product = Product::whereSlug($product_slug)->first();
        if (!$product) {
            return abort(404);
        }

        return view('store.product_review', compact('product'));
    }

    public function getReviewStore($product_slug, Request $request)
    {
        $product = Product::whereSlug($product_slug)->first();
        if (!$product) {
            return abort(404);
        }

        $product->productReviews()->create([
            'user_id' => auth()->user()->id,
            'rate' => $request->rate,
            'review' => $request->review,
        ]);
        Alert::success('', 'نظر شما با موفقیت برای محصول ثبت شد');
        return redirect(route('site.product', ['slug' => $product->slug]));
    }


    /**
     * @param Product $product
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getQuestionStore(Product $product, Request $request)
    {

        $this->validate($request, [
            'content' => 'required|min:5|string'
        ]);
        $user = auth()->user();
        $product->productQuestions()->create([
            'user_id' => $user->id,
            'content' => $request->input('content')
        ]);

        return back();
    }


    /**
     * @param Product $product
     * @param ProductQuestion $productQuestion
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getReplyStore(Product $product, ProductQuestion $productQuestion, Request $request)
    {

        $this->validate($request, [
            'reply' => 'required|min:3|string'
        ]);
        $user = auth()->user();
        $productQuestion->children()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'content' => $request->input('reply')
        ]);

        Alert::success('ok');
        return back();
    }
}
