<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SendType;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use SoapClient;

class PaymentController extends Controller
{
    public $UB = 'user.baskets';


    public function index(Request $request)
    {

        $oldBasket = session()->get($this->UB);
        $basket = [];
        foreach ($oldBasket as $item) {
            $basket[] = $item['product_id'];
        }
        $products = Product::whereIn('id', $basket)->with('main_image')->get();
        $send_type = SendType::find($request->session()->get('send_type'));
        return view('store.payment', compact('products', 'send_type'));
    }

    public function check_needy(Request $request)
    {
        $status = false;
        $message = '';

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


                if (!$request->session()->has('hasNeedy')) {
                    $request->session()->put('hasNeedy', 1);
                } else {
                    $request->session()->put('hasNeedy', 1);
                }

            } else {

                if ($user->needy) {
                    $message = 'درخواست نیازمند بودن شما فعلا تایید نشده است';
                } else {
                    $message = 'شما به عنوان نیازمند ثبت نام نکرده اید.';
                }


            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'discount' => $prepayment
        ]);
    }

    public function delete_needy_session(Request $request)
    {
        if ($request->session()->has('hasNeedy')) {
            $request->session()->forget('hasNeedy');
        }
        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * @param Request $request
     * @return string|void
     */
    public function getPay(Request $request)
    {
        $user = auth()->user();
        if ($request->has('_type')) {
//            return $request->session()->all();

            if ($request->_type == '1') {
                //zarin-pal

                $hasNeedy = false;
                if ($request->session()->has('hasNeedy')) {
                    $hasNeedy = $request->session()->get('hasNeedy') == 1 ? true : false;
                }
//                dd($hasNeedy);
                $order = $this->orderCreator($user, $request, 'زرین پال', $hasNeedy);
                return $this->pay_for_zarin($user, $order->paid_price, $order);

            }
        } else {
            return 'no type';
        }
    }

    public function orderCreator(User $user, Request $request, $pay_type_title, $has_needy)
    {

        $user_products_basket = $request->session()->get($this->UB);
        $send_type_id = $request->session()->get('send_type');
        $address_id = $request->session()->get('default_address');

        //Products Section
        $total_product_price = 0;
        $products = [];
        foreach ($user_products_basket as $basket_product) {
            $product = Product::whereId($basket_product['product_id'])->first();

            if ($product && $product->stock >= $basket_product['count']) {
                $total_product_price = $total_product_price + ($basket_product['count'] * ($product->price * (1 - $product->discount / 100)));
                $product['user_sale'] = $basket_product['count'];
                $products[] = $product;
            }
        }
//        return $products;

        //Send Type Section
        $send_type = SendType::find($send_type_id);

        //user address
        $address = UserAddress::find($address_id);

        $total_price = $total_product_price + $send_type->price;
        //discount section

        if ($has_needy) {
            $prepayment_field = Config::where('key', 'prepayment')->first();
            if ($prepayment_field) {
                $prepayment = $prepayment_field->value;
            } else {
                $prepayment = 100;
            }
            $paid_price = $total_price * $prepayment / 100;
        } else {
            $paid_price = $total_price;
        }


        //create order
        $order_number = $this->generateRandomString(3) . '-' . Carbon::now()->timestamp;
        $order = $user->orders()->create([
            'order_number' => $order_number,
            'paid_price' => $paid_price,
            'sponsor_total_price' => '0',
            'total_price' => $total_price,
            'status' => '0',
            'pay_status' => '0',
            'state' => $address->state,
            'receiver' => $address->receiver,
            'mobile' => $address->mobile,
            'city' => $address->city,
            'postal_code' => $address->postal_code,
            'address' => $address->address,
            'send_type_title' => $send_type->title,
            'send_type_price' => $send_type->price,
            'pay_type_title' => $pay_type_title,
            'has_needy' => $has_needy,
        ]);
        if ($order) {
            //delete all sessions

            foreach ($products as $product) {
                $price = $product->price * (1 - $product->discount / 100);
                $quantity = $product['user_sale'];
                $order->products_fields()->create([
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'image' => $product->main_image[0] ? $product->main_image[0]->url : $product->images()->first()->url,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_price' => $quantity * $price,
                ]);

//                return $product->stock;
                $user_sale = $product['user_sale'];
                unset($product['user_sale']);
                $product->update([
                    'stock' => $product->stock - $user_sale
                ]);
            }
            $request->session()->forget([$this->UB]);
        }

        return $order;
    }

    public function pay_for_zarin(User $user, $amount, Order $order)
    {

        $MerchantID = env('ZP_MID'); //Required
        $Amount = $amount; //Amount will be based on Toman - Required
        $Description = 'خرید از فروشگاه خیریه'; // Required
//            $Email = $client->email; // Optional
        $Mobile = $user->mobile; // Optional

        $CallbackURL = route('site.callback.zarin');

        if ($this->ZP_Test) {
            $zarin_client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        } else {
            $zarin_client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        }


        $result = $zarin_client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => '',
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );


        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            $order->payments()->create([
                'user_id' => $user->id,
                'amount' => $Amount,
                'authority' => $result->Authority,
                'type' => 'bank',
                'status' => 0
            ]);


            if ($this->ZP_Test) {
                return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);
            } else {
                return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
            }


        } else {

            return response()->json(['status' => false, 'message' => 'خطای درگاه بانک']);
        }


    }

    /**
     * @param Order $order
     * @param Request $request
     * @return string|void
     */
    public function getPayAgain(Order $order, Request $request)
    {
        $user = auth()->user();
        if ($order->user_id == auth()->user()->id) {
            if ($request->has('_type')) {
//            return $request->session()->all();

                if ($request->_type == '1') {
                    //zarin-pal

                    return $this->pay_for_zarin($user, $order->paid_price, $order);

                }
            }
        } else {
            abort(403);
        }
    }

    public function zarin_chacker(Request $request)
    {
        $Authority = $request->Authority;
        $status = $request->Status;

        $payment = Payment::whereAuthority($Authority)->firstOrFail();
        if ($status == 'OK') {

            if ($this->ZP_Test) {
                $zarin_client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            } else {
                $zarin_client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            }


            $result = $zarin_client->PaymentVerification([
                'MerchantID' => env('ZP_MID'),
                'Authority' => $Authority,
                'Amount' => $payment->amount,
            ]);

//            if (true) {

            if ($result->Status == 100) {
                $payment->update([
                    'RefID' => $result->RefID,
                    'status' => 1
                ]);

                $payment->paymentable->update([
                    'pay_status' => true
                ]);

                $message = 'پرداخت با موفقیت انجام شد';
                $type = 'success';
                Alert::success('', $message);
                return redirect(route('site.profile.index'));


            } else {
                $message = 'مشکلی در ارتباط با بانک به وجود آمد.از پروفایل کاربری خود ظرف مدت 12 ساعت نسبت به پرداخت هزینه ی سفارش اقدام کنید.در غیر اینصورت سفارش شما لغو خواهد شد.با تشکر';
                $type = 'error';
                Alert::warning('', $message);
                return redirect(route('site.profile.index'));
            }
        } else {

            $message = 'شما از پرداخت منصرف شدید.از پروفایل کاربری خود ظرف مدت 12 ساعت نسبت به پرداخت هزینه ی سفارش اقدام کنید.در غیر اینصورت سفارش شما لغو خواهد شد.با تشکر';
            $type = 'error';
            Alert::warning('', $message);
            return redirect(route('site.profile.index'));
        }
    }

    public function app_payment(Order $order)
    {

        $user = auth()->user();

        $MerchantID = env('ZP_MID'); //Required
        $Amount = $order->paid_price;
        $Description = 'خرید از فروشگاه خیریه'; // Required
//            $Email = $client->email; // Optional
        $Mobile = $user->mobile; // Optional

        $CallbackURL = route('site.app_callback.zarin');

        if ($this->ZP_Test) {
            $zarin_client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        } else {
            $zarin_client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        }


        $result = $zarin_client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => '',
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );


        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {

            $order->payments()->create([
                'user_id' => $user->id,
                'amount' => $Amount,
                'authority' => $result->Authority,
                'type' => 'bank',
                'status' => 0
            ]);


            if ($this->ZP_Test) {
                return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);
            } else {
                return redirect('https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
            }


        } else {

            return response()->json(['status' => false, 'message' => 'خطای درگاه بانک']);
        }
    }

    public function app_zarin_chacker(Request $request)
    {
        $Authority = $request->Authority;
        $status = $request->Status;

        $payment = Payment::whereAuthority($Authority)->firstOrFail();
        if ($status == 'OK') {

            if ($this->ZP_Test) {
                $zarin_client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            } else {
                $zarin_client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
            }


            $result = $zarin_client->PaymentVerification([
                'MerchantID' => env('ZP_MID'),
                'Authority' => $Authority,
                'Amount' => $payment->amount,
            ]);

//            if (true) {

            if ($result->Status == 100) {
                $payment->update([
                    'RefID' => $result->RefID,
                    'status' => 1
                ]);

                $payment->paymentable->update([
                    'pay_status' => true
                ]);

                $message = 'پرداخت با موفقیت انجام شد';
                $type = 'success';
//                Alert::success('', $message);
                return view('store.app_redirect', compact('message', 'type'));


            } else {
                $message = 'مشکلی در ارتباط با بانک به وجود آمد.از پروفایل کاربری خود ظرف مدت 12 ساعت نسبت به پرداخت هزینه ی سفارش اقدام کنید.در غیر اینصورت سفارش شما لغو خواهد شد.با تشکر';
                $type = 'error';
                return view('store.app_redirect', compact('message', 'type'));
            }
        } else {

            $message = 'شما از پرداخت منصرف شدید.از پروفایل کاربری خود ظرف مدت 12 ساعت نسبت به پرداخت هزینه ی سفارش اقدام کنید.در غیر اینصورت سفارش شما لغو خواهد شد.با تشکر';
            $type = 'error';

            return view('store.app_redirect', compact('message', 'type'));
        }
    }
}
