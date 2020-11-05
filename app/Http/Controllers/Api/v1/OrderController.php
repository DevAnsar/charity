<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Order;
use App\Models\Product;
use App\Models\SendType;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use SoapClient;

class OrderController extends Controller
{

    public function orders(Request $request){
        if (!$request->type){
            $request->type='open';
        }
        $type=$request->type;
        $user=auth()->user();


        if ($type=='cancel'){
            $orders1=$user->orders()->where('pay_status','=','0')
                ->where('created_at','<',Carbon::now()->subHours(12))->latest()->get();
            $orders=$user->orders()->where('status','=','-1')
                ->union($orders1);

        }elseif ($type=='unpaid'){

            $orders=$user->orders()->where('status','=','0')->where('pay_status','=','0')
                ->where('created_at','>=',Carbon::now()->subHours(12));

        }elseif ($type=='open'){

            $orders=$user->orders()->where('status','=','0')->where('pay_status','=','1');

        }elseif ($type=='processing'){

            $orders=$user->orders()->where('status','=','1')->where('pay_status','=','1');
        }elseif ($type=='posted'){

            $orders=$user->orders()->where('status','=','2')->where('pay_status','=','1');

        }elseif ($type=='delivered'){

            $orders=$user->orders()->where('status','=','3')->where('pay_status','=','1');
        }else{
            return response()->json([
                'status'=>false
            ]);
        }

        $orders=$orders->latest()->get();
        foreach ($orders as $order){
            $order['created_at']=Verta::instance($order->created_at)->format('Y/m/d');
        }
        return response()->json([
           'status'=>true,
           'orders'=>$orders,
        ]);
    }

    public function getOrder(Order $order){

        return response()->json([
            'status'=>true,
            'orders'=>$order->with('products_fields.product'),
        ]);
    }

    public function setOrder(Request $request){


        try{
            $user = auth()->user();
            if (!$request->has('address_id')){
                return response()->json([
                    'status'=>false,
                    'message'=>'address is required'
                ]);
            }
            if (!$request->has('send_type_id')){
                return response()->json([
                    'status'=>false,
                    'message'=>'send_type is required'
                ]);
            }

            if (!$request->has('products')){
                return response()->json([
                    'status'=>false,
                    'message'=>'products is required'
                ]);
            }

            if ($request->has('pay_type_id')) {
//            return $request->session()->all();

                if ($request->pay_type_id == '1') {
                    //zarin-pal

                    $hasNeedy = false;
                    if ($request->has('has_needy')) {
                        $hasNeedy = $request->get('hasNeedy') == 1 ? true : false;
                    }
//                dd($hasNeedy);
                    $order = $this->orderCreator($user, $request, 'زرین پال', $hasNeedy);

                    return response()->json([
                        'status'=>true,
                        'order_id'=>$order->id
                    ]);
//                return $this->pay_for_zarin($user, $order->paid_price, $order);

                }
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'pay_type is required'
                ]);
            }
        }catch (\Exception $exception){
            return response()->json([
                'status'=>false,
                'message'=>$exception->getMessage()
            ]);
        }


    }

    public function orderCreator(User $user, Request $request, $pay_type_title, $has_needy)
    {
        $address_id = $request->get('address_id');

        //
        $response=$this->getUserBasket($request);

        //user address
        $address = UserAddress::find($address_id);
        //create order
        $order_number = $this->generateRandomString(3) . '-' . Carbon::now()->timestamp;
        $order = $user->orders()->create([
            'order_number' => $order_number,
            'paid_price' => $response['paid_price'],
            'sponsor_total_price' => '0',
            'total_price' => $response['total_price'],
            'status' => '0',
            'pay_status' => '0',
            'state' => $address->state,
            'receiver' => $address->receiver,
            'mobile' => $address->mobile,
            'city' => $address->city,
            'postal_code' => $address->postal_code,
            'address' => $address->address,
            'send_type_title' => $response['send_type']['title'],
            'send_type_price' => $response['send_type']['price'],
            'pay_type_title' => $pay_type_title,
            'has_needy' => $has_needy,
        ]);
        if ($order) {
            //delete all sessions

            foreach ($response['products'] as $product) {
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
//            $request->session()->forget([$this->UB]);
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

}
