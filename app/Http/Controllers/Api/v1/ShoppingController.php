<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\SendType;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $address = $user->addresses()->where('is_default', true)->first();
        $sendTypes = SendType::whereStatus(true)->oldest()->get();

//        $sendTypes->setHidden(['created_at']);
        return response()->json([
            'address' => $address,
            'send_types' => $sendTypes
        ]);
    }

    public function getBasket(Request $request)
    {
        try {

            $this->validate($request, [
                'products' => 'required|array',
                'send_type_id' => 'required',
                'has_needy' => 'nullable',
            ]);
            $response = $this->getUserBasket($request);

            return response()->json([
                'status' => true,
                'products' => $response['products'],
                'paid_price' => $response['paid_price'],
                'total_price' => $response['total_price'],
                'send_type' => $response['send_type'],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ]);
        }
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


            } else {

                if ($user->needy) {
                    $message = 'درخواست نیازمند بودن شما فعلا تایید نشده است';
                } else {
                    $message = 'شما به عنوان نیازمند ثبت نام نکرده اید.';
                }
            }
        }


//        if ($status){
//            $prepayment_field = Config::where('key', 'prepayment')->first();
//            if ($prepayment_field) {
//                $prepayment = $prepayment_field->value;
//            }
//        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'discount' => $prepayment
        ]);
    }
}
