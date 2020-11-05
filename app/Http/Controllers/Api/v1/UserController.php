<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function carts(Request $request)
    {

        if (!$request->has('products')) {
            $request->products = [];
        }
        $products = Product::whereIn('id', $request->products)->with('main_image')->get();

        return response()->json([
            'request' => $request->all(),
            'products' => $products
        ]);
    }


    public function user_response_data($user){
        return [
            'name' => $user->name,
            'mobile' => $user->mobile,
            'email' => $user->email,
            'code_melli' => $user->code_melli,
            'shaba_number' => $user->shaba_number,
            'bank_cart' => $user->bank_cart,
            'avatar' => $user->avatar,
        ];
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function additional_info()
    {
        $user = auth()->user();
        return response()->json(['status' => true,
            'user' => $this->user_response_data($user)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function additional_info_update(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'code_melli' => 'required',
            'shaba_number' => 'required',
            'bank_cart' => 'required',
        ]);
//        return $request->all();
        $user = auth()->user();

        if ($request->file('avatar')) {

            $url = $this->uploadImage($request->file('avatar'), "/users/$user->id/avatar");
            if ($user->image) {
                Storage::delete($user->image->url);
                $user->image()->update(['url' => $url]);
            } else {
                $user->image()->create(['url' => $url]);
            }
        }

        $user->update($request->all());

        return response()->json(['status' => true,'user'=>$this->user_response_data($user)]);
    }

    public function user_reviews(){
        $user = auth()->user();
        $productReviews = $user->productReviews()->whereStatus('1')->oldest()->get();
        return response()->json([
           'productReviews' =>$productReviews
        ]);
    }

    public function user_reviews_delete(ProductReview $productReview){

        try{

            if ($productReview->user_id == auth()->user()->id){

                $productReview->delete();

                return response()->json([
                    'status'=>true
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'خطا،این نظر متعلق به شما نیست'
                ]);
            }


        }catch (\Exception $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ]);
        }

    }

//    public function get_basket()
//    {
//
////        session()->forget($this->UB);
//        if (!session()->has($this->UB)) {
//            session()->put($this->UB, []);
//        }
//        return session()->get($this->UB);
//    }
//
//    public function add_basket(Request $request)
//    {
//        $product = Product::whereId($request->product_id)->first();
//        if (!$product) {
//            return response()->json(['status' => false]);
//        }
//        $oldBasket = session()->get($this->UB);
//
//        $product_has_in_basket = false;
//        $basket = [];
//        foreach ($oldBasket as $item) {
//            if ($item['product_id'] == $product->id) {
//                $product_has_in_basket = true;
//            }
//            $basket[] = $item;
//        }
//
//        if (!$product_has_in_basket) {
//
//            $basket[] = [
//                'product_id' => $product->id,
//                'title' => $product->title,
//                'price' => $product->price,
//                'image' => $product->images()->where('isMain', 1)->first()->url,
//                'count' => 1
//            ];
//        }
//        $request->session()->put($this->UB, $basket);
//
//        return response()->json([
//            'status' => true,
//            'basket' => $basket
//        ]);
//    }
//
//    public function delete_basket(Request $request)
//    {
//        $product = Product::whereId($request->product_id)->first();
//        if (!$product) {
//            return response()->json(['status' => false]);
//        }
//        $oldBasket = session()->get($this->UB);
//
//        $basket = [];
//        foreach ($oldBasket as $item) {
//            if ($item['product_id'] != $product->id) {
//                $basket[] = $item;
//            }
//
//        }
//
//        $request->session()->put($this->UB, $basket);
//
//        return response()->json([
//            'status' => true,
//            'basket' => $basket
//        ]);
//    }
}
