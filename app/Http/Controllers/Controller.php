<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Config;
use App\Models\Product;
use App\Models\SendType;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $ZP_Test = true;

    function getArrayColumn($array = [], $titleAttribute = 'title', $extraClass = '', $separator = ', ')
    {
        $result = [];
        foreach ($array as $link) {
            $title = $link[$titleAttribute];
//        $replace = preg_replace('/\$\{href\}/', url($baseUrl, $link[$idAttribute]), $html);
//        $replace = preg_replace('/\$\{title\}/', $link[$titleAttribute], $replace);
            $html = "<span class='{$extraClass}'>{$title}</span>";
            $result[] = $html;
        }
        return implode($separator, $result);
    }


    function uploadImage($file, $dir)
    {

//        $upload_dir=$dir.$file->getClientOriginalName();
        $url = $file->storeAs($dir, $file->getClientOriginalName());

        return $url;
    }

    function uploadFile($file, $dir)
    {
        $url = $file->storeAs($dir, $file->getClientOriginalName());
        return $url;
    }

    function category_list()
    {
        $categories = [];
        $cats_l1 = Category::whereParent_idAndStatus(0, 1)->get();
        foreach ($cats_l1 as $cat_l1) {

            if ($cat_l1->children()->get()->count() == 0) {
                $categories[] = [
                    'id' => $cat_l1->id,
                    'title' => $cat_l1->title
                ];
            } else {
                foreach ($cat_l1->children as $cat_l2) {

                    if ($cat_l2->children()->get()->count() == 0) {
                        $categories[] = [
                            'id' => $cat_l2->id,
                            'title' => $cat_l1->title . '-> (' . $cat_l2->title . ')'
                        ];
                    } else {
                        foreach ($cat_l2->children as $cat_l3) {
                            $categories[] = [
                                'id' => $cat_l3->id,
                                'title' => $cat_l1->title . '-> (' . $cat_l2->title . ') ->' . $cat_l3->title
                            ];
                        }
                    }

                }
            }
        }


        return $categories;
    }

    function blog_category_list()
    {
        $categories = [];
        $cats_l1 = Category::whereParent_idAndStatus(0, 1)->get();
        foreach ($cats_l1 as $cat_l1) {

            if ($cat_l1->children()->get()->count() == 0) {
                $categories[] = [
                    'id' => $cat_l1->id,
                    'title' => $cat_l1->title
                ];
            } else {
                foreach ($cat_l1->children as $cat_l2) {

                    if ($cat_l2->children()->get()->count() == 0) {
                        $categories[] = [
                            'id' => $cat_l2->id,
                            'title' => $cat_l1->title . '-> (' . $cat_l2->title . ')'
                        ];
                    } else {
                        foreach ($cat_l2->children as $cat_l3) {
                            $categories[] = [
                                'id' => $cat_l3->id,
                                'title' => $cat_l1->title . '-> (' . $cat_l2->title . ') ->' . $cat_l3->title
                            ];
                        }
                    }

                }
            }
        }


        return $categories;
    }

    function category_line(Category $category)
    {
        $line = [];

        $line[] = $category;
        if ($category->parent()->first()) {
            $line[] = $parent = $category->parent()->first();

            if ($parent->parent()->first()) {
                $line[] = $parent = $parent->parent()->first();
            }
        }

        return array_reverse($line);
    }

    function all_categories()
    {

        $categories = Category::whereParent_idAndStatus(0, 1)->get();
        foreach ($categories as $cat_l1) {
            $children = $cat_l1->children;
            foreach ($children as $child) {
                $child->children;
            }
        }
//            if ($cat_l1->children()->get()->count() == 0) {
//                $categories[] = [
//                    'id' => $cat_l1->id,
//                    'title' => $cat_l1->title
//                ];
//            }
//            else {
//                foreach ($cat_l1->children as $cat_l2) {
//
//                    if ($cat_l2->children()->get()->count() == 0) {
//                        $categories[] = [
//                            'id' => $cat_l2->id,
//                            'title' => $cat_l1->title . '-> (' . $cat_l2->title . ')'
//                        ];
//                    } else {
//                        foreach ($cat_l2->children as $cat_l3) {
//                            $categories[] = [
//                                'id' => $cat_l3->id,
//                                'title' => $cat_l1->title . '-> (' . $cat_l2->title . ') ->' . $cat_l3->title
//                            ];
//                        }
//                    }
//
//                }
//            }


        return $categories;
    }

    public function generateRandomNumber($length = 8)
    {
        $random = "";
        srand((double)microtime() * 1000000);

        $data = "102345601234567899876543210890";

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }

    public function generateRandomString($length = 8)
    {
        $random = "";
        srand((double)microtime() * 1000000);
        $data = "AKDETDGFBCIATWBKDJFNVBCHYEJSKAUEHDFZQAAPOL";
        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }
        return $random;
    }

    public function generateRandomMultiString($length = 8)
    {
        $random = "";
        srand((double)microtime() * 1000000);

        $data = "123456123456789071234567890890";
        $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; // if you need alphabatic also

        for ($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand() % (strlen($data))), 1);
        }

        return $random;

    }

    public function getUserBasket(Request $request){

        $user_products_basket = $request->get('products');
        $send_type_id = $request->get('send_type_id');
        $send_type = SendType::find($send_type_id);

        $total_product_price = 0;
        $products = [];
        foreach ($user_products_basket as $basket_product) {
            $product = Product::whereId($basket_product['product_id'])->with('main_image')->first();
            if ($product && $product->stock >= $basket_product['count']) {
                $total_product_price = $total_product_price + ($basket_product['count'] * ($product->price * (1 - $product->discount / 100)));
                $product['user_sale'] = $basket_product['count'];
                $products[] = $product;
            }
        }
        $total_price = $total_product_price + $send_type->price;
        //discount section

        if ($request->input('has_needy')=='1') {

            $prepayment = 100;
            if (auth()->check()) {
                $user = auth()->user();

                if ($user->hasRole('needy')) {

                    $totalPayPrice = $request->input('totalPayPrice');
                    if ($user->needyData) {
                        $prepayment = $user->needyData->discount_percent;
                    } else {
                        $prepayment_field = Config::where('key', 'prepayment')->first();
                        if ($prepayment_field) {
                            $prepayment = $prepayment_field->value;
                        }
                    }

                    $payment_price = $totalPayPrice * ($prepayment / 100);
                    if ($payment_price > $user->needyData->charge_inventory) {
                        $message ="مبلغ پیش پرداخت سبد خرید بیشتر از شارژ حساب شما میباشد(درصد پرداختی شما $prepayment% از مبلغ کل سبد خرید میباشد که در مجموع حداقل باید $payment_price تومان شارژ حساب داشته باشید";
                    }else{
                        $status=true;
                    }


                } else {

                    if ($user->needy) {
                        $message = 'درخواست نیازمند بودن شما فعلا تایید نشده است';
                    } else {
                        $message = 'شما به عنوان نیازمند ثبت نام نکرده اید.';
                    }
                }
            }

            $paid_price = $total_price * $prepayment / 100;
        } else {
            $paid_price = $total_price;
        }

        $basket_message='';

        if (sizeof($products)>0 &&sizeof($user_products_basket) > sizeof($products)){
            $basket_message='برخی از محصولات سبد خرید شما موجود نمیباشد';
        }
        if (sizeof($products)==0){
            $basket_message=' محصولات سبد خرید شما موجود نمیباشند';
        }

        return[
          'products'=>$products,
          'total_price'=>$total_price,
          'paid_price'=>$paid_price,
          'send_type'=>$send_type,
          'basket_message'=>$basket_message,
        ];
    }

    public function convertPersianToEnglish($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $output = str_replace($persian, $english, $string);
        return $output;
    }
}
