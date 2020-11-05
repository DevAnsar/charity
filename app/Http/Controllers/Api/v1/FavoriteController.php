<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        if ($user) {
            $favorites = $user->favorites()->with('product')->with('product.main_image')->latest()->get();
            return response()->json([
                'status' => true,
                'favorites' => $favorites
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function actionFavorites($product_id)
    {

        $product = Product::find($product_id);
        if ($product) {
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
        } else {


            return response()->json([
                'status' => false
            ]);
        }
    }
}
