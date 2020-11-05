<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {


        if (auth()->user()->hasRole('admin')) {

            if (!$request->list) {
                $request->list = 'all';
            }
            $list = $request->list;

            if ($list == 'all') {
                $orders = Order::oldest()->latest()->get();
            } elseif ($list == 'unpaid') {
                $orders = Order::whereStatus('0')->where('pay_status',false)->latest()->get();
            } elseif ($list == 'open') {
                $orders = Order::whereStatus('0')->where('pay_status',true)->where('has_needy',false)->latest()->get();
            } elseif ($list == 'open_needy') {
                $orders = Order::whereStatus('0')->where('pay_status',true)->where('has_needy',true)->latest()->get();
            } elseif ($list == 'processing') {
                $orders = Order::whereStatus('1')->latest()->get();
            } elseif ($list == 'posted') {
                $orders = Order::whereStatus('2')->latest()->get();
            } elseif ($list == 'delivered') {
                $orders = Order::whereStatus('3')->latest()->get();
            } elseif ($list == 'cancel') {
                $orders = Order::whereStatus('-1')->latest()->get();
            } else {
                $orders = Order::oldest()->latest()->get();
            }

        }
        elseif (auth()->user()->hasRole('helper')) {

            if (!$request->list) {
                $request->list = 'open_needy';
            }
            $list = $request->list;

            if ($list == 'all') {
                $this->authorize(403);
            } elseif ($list == 'unpaid') {
                $this->authorize(403);
            } elseif ($list == 'open') {
                $this->authorize(403);
            } elseif ($list == 'open_needy') {
                $orders = Order::whereStatus('0')->where('pay_status',true)->where('has_needy',true)->latest()->get();
            } elseif ($list == 'processing') {

                $sponsor_orders = auth()->user()->sponsored_order_fields()->pluck('order_id')->unique()->toArray();
                $orders = Order::whereStatus('1')->whereIn('id', $sponsor_orders)->oldest()->get();

            } elseif ($list == 'posted') {

                $sponsor_orders = auth()->user()->sponsored_order_fields()->pluck('order_id')->unique()->toArray();
                $orders = Order::whereStatus('2')->whereIN('id', $sponsor_orders)->oldest()->get();

            } elseif ($list == 'delivered') {

                $sponsor_orders = auth()->user()->sponsored_order_fields()->pluck('order_id')->unique()->toArray();
                $orders = Order::whereStatus('3')->whereIN('id', $sponsor_orders)->oldest()->get();

            } else {
                $this->authorize(403);
            }

        }
        elseif (auth()->user()->hasRole('store')) {

            if (!$request->list) {
                $request->list = 'all';
            }
            $list = $request->list;

            if ($list == 'all') {

                $orders_id = DB::table('orders')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'unpaid') {


                $orders_id = DB::table('orders')
                    ->where('pay_status','=','0')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'open') {

                $orders_id = DB::table('orders')
                    ->where('orders.status','=','0')
                    ->where('pay_status','=',true)
                    ->where('has_needy','=','0')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->select('products.user_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'open_needy') {

                $orders_id = DB::table('orders')
                    ->where('pay_status','=','1')
                    ->where('orders.status','=','0')
                    ->where('has_needy','=','1')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'processing') {

                $orders_id = DB::table('orders')
                    ->where('pay_status','=','1')
                    ->where('orders.status','=','1')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'posted') {

                $orders_id = DB::table('orders')
                    ->where('pay_status','=','1')
                    ->where('orders.status','=','2')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } elseif ($list == 'delivered') {

                $orders_id = DB::table('orders')
                    ->where('pay_status','=','1')
                    ->where('orders.status','=','3')
                    ->join('order_products', 'orders.id', '=', 'order_products.order_id')
                    ->join('products', 'products.id', '=', 'order_products.product_id')
                    ->where('products.user_id', '=', auth()->user()->id)
                    ->pluck('orders.id')->toArray();

            } else {
                $this->authorize(403);
            }
            $orders=Order::whereIn('id',array_unique($orders_id))->get();
        }
        elseif (auth()->user()->hasRole('needy') ) {

            if (!$request->list) {
                $request->list = 'all';
            }
            $list = $request->list;

            if ($list == 'all') {
                $orders = Order::where('user_id','=',auth()->user()->id)->latest()->get();
            }else{
                $this->authorize(403);
            }
        }

//        return $orders;
        return view('admin.orders.index', compact('orders', 'list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order $order
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order,Request $request)
    {
        $user=auth()->user();
        if ($user->hasRole('admin') || $user->hasRole('store') || $user->hasRole('helper')){


        }elseif (auth()->user()->hasRole('needy')){
            if ($order->user_id != auth()->user()->id){
                abort(403);
            }
        }
//        return $order->payments;
        $payment=$order->payments()->latest()->first();
        $list=$request->list;
        return view('admin.orders.show', compact('order','payment','list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update([
            'status'=>$request->status
        ]);
        Alert::success('', 'سفارش با موفقیت ویرایش  شد');
        return redirect(route('panel.orders.index', ['list' => $request->list]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendStatusUpdate(Request $request, Order $order)
    {
        $this->validate($request,[
            'send_status'=>'required',
        ]);
        $order->update([
            'status'=>$request->send_status
        ]);
        Alert::success('', 'سفارش با موفقیت ویرایش  شد');
        return redirect(route('panel.orders.index', ['list' => $request->list]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder(Order $order)
    {
//        return $order->products_fields;
        $order->update([
            'status'=>'-1'
        ]);
        foreach ($order->products_fields as $product_field){
//            return $product_field;
            if ($product_field){
                $product=$product_field->product;
                if ($product){
                    $product->update([
                        'stock'=>$product->stock + $product_field->quantity
                    ]);
                }
            }
        }

        Alert::success('', 'سفارش با موفقیت ویرایش  شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function pay_leftOver_price(Order $order, Request $request)
    {
//        return $request->input('left_over_price');
        $this->validate($request, [
            'left_over_price' => 'required',
        ]);

        if ($order->sponsor_total_price + $request->input('left_over_price') <= $order->total_price) {
            $order->sponsors()->create([
                'user_id' => auth()->user()->id,
                'total_price' => $order->total_price,
                'amount' => $request->input('left_over_price'),
            ]);
            $order->update([
                'sponsor_total_price' => $order->sponsor_total_price + $request->input('left_over_price')
            ]);
            Alert::success('', 'مبلغ اهدایی ثبت شد');
        } else {
            Alert::success('', 'مبلغ اهدایی بیش از مبلغ باقی مانده از سفارش میباشد');
        }
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order $order
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function pay_leftOver_price_from_wallet(Order $order, Request $request)
    {

        $this->validate($request, [
            'left_over_price' => 'required',
        ]);

        $auth_user=auth()->user();
        if ($auth_user->hasRole('helper')){

        }else{
            return response()->json([
                'status'=>false,
                'message'=>'شما دسترسی به این بخش را ندارید'
            ]);
        }

        if ($auth_user->checkWallet($request->input('left_over_price'))){

            if ($order->sponsor_total_price + $request->input('left_over_price') <= $order->total_price) {
                $order->sponsors()->create([
                    'user_id' => $auth_user->id,
                    'total_price' => $order->total_price,
                    'amount' => $request->input('left_over_price'),
                ]);
                $order->update([
                    'sponsor_total_price' => $order->sponsor_total_price + $request->input('left_over_price')
                ]);
                $auth_user->update([
                    'wallet'=>$auth_user->wallet - $request->input('left_over_price')
                ]);

                Alert::success('', 'مبلغ اهدایی واریز شد');
                return response()->json([
                    'status'=>true,
                    'message'=>'مبلغ اهدایی واریز شد'
                ]);
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'مبلغ اهدایی بیش از مبلغ باقی مانده از سفارش میباشد'
                ]);
            }

        }else{
            return response()->json([
                'status'=>false,
                'message'=>'مبلغ اهدایی بیش از مبلغ موجود در کیف پول میباشد'
            ]);
        }


    }
}
