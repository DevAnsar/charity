<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public $UB = 'user.baskets';

    public function get_cart()
    {
//        return $basket = session()->get($this->UB);
        return view('store.cart');
    }

    public function get_cart_details()
    {

        $basket = session()->get($this->UB);
        $products = [];

        if ($basket) {
            foreach ($basket as $item) {
                $data = Product::whereId($item['product_id'])->with('main_image')->with('seller')->first();
                $data['count'] = $item['count'];
                $products[] = $data;
            }
        }

        return response()->json([
            'status' => true,
            'data' => $products
        ]);

    }

    public function StepDown(Request $request)
    {
        $oldBasket = session()->get($this->UB);
        $basket = [];
        foreach ($oldBasket as $item) {
            if ($item['product_id'] == $request->product_id) {
                $item['count']--;
            }
            $basket[] = $item;
        }

        session()->put($this->UB, $basket);

        return response()->json([
            'status' => true,
            'basket' => session()->get($this->UB),
        ]);
    }

    public function StepUp(Request $request)
    {
        $oldBasket = session()->get($this->UB);
        $basket = [];
        foreach ($oldBasket as $item) {
            if ($item['product_id'] == $request->product_id) {
                $item['count']++;
            }
            $basket[] = $item;
        }

        session()->put($this->UB, $basket);

        return response()->json([
            'status' => true,
            'basket' => session()->get($this->UB),
        ]);
    }
}
