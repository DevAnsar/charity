<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use PhpParser\Comment;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $last_orders = $user->orders()->latest()->take(3)->get();
        $last_favorites=$user->favorites()->latest()->take(5)->with('product')->with('product.main_image')->get();
        return view('store.profile.index', compact('user', 'last_orders','last_favorites'));
    }

    public function orders()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->get();
        return view('store.profile.orders', compact('user', 'orders'));
    }

    public function orders_show(Order $order)
    {
//        return $order->products_fields;
        $user = auth()->user();
        if ($order->user_id != $user->id) {
            return abort('403');
        }
        return view('store.profile.order_details', compact('user', 'order'));
    }


    /**
     * @param Order $order
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function orders_send_type_update(Order $order,Request $request)
    {

        $this->validate($request,[
            'send_status'=>'required',
        ]);
        $user = auth()->user();
        if ($order->user_id != $user->id) {
            return abort('403');
        }
        $order->update([
            'status'=>$request->send_status
        ]);
        Alert::success('', 'سفارش با موفقیت ویرایش  شد');
        return back();

    }


    public function get_address()
    {
//        return $order->products_fields;
        $user = auth()->user();
        $addresses = $user->addresses()->latest()->get();
        return view('store.profile.addresses', compact('user', 'addresses'));
    }



    public function addNewAddress(Request $request)
    {
//        return $request->all();
        $user = auth()->user();

        $city = City::find($request->city_id);
        $state = $city->parent;

        $address = $user->addresses()->create(array_merge($request->all(), [
            'is_default' => true,
            'state' => $state->title,
            'city' => $city->title
        ]));

        if (!$request->session()->has('default_address')) {
            $request->session()->put('default_address', $address->id);
        } else {
            $request->session()->put('default_address', $address->id);
        }
        $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);

        Alert::success('', 'آدرس با موفقیت افزوده شد');
        return redirect(route('site.profile.addresses'));
    }

    /**
     * @param UserAddress $userAddress
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function address_delete(UserAddress $userAddress){

        $userAddress->delete();
       return back();
    }

    public function address_update(UserAddress $userAddress,Request $request){
        $city = City::find($request->city_id);
        $state = $city->parent;
       $userAddress->update(array_merge($request->all(),[
           'state' => $state->title,
           'city' => $city->title
       ]));
       return redirect(route('site.profile.addresses'));
    }


    public function get_favorites()
    {
//        return $order->products_fields;
        $user = auth()->user();
        $favorites = $user->favorites()->with('product')->with('product.main_image')->latest()->get();
        return view('store.profile.favorites', compact('user', 'favorites'));
    }
    public function favorites_delete(Favorite $favorite)
    {

//        return $favorite;
        $favorite->delete();
        return back();
    }


    public function get_additional_info()
    {
//        return $order->products_fields;
        $user = auth()->user();
        return view('store.profile.additional_info', compact('user'));
    }
    public function additional_info_update(Request $request)
    {

        $user=auth()->user();
        if ($request->file('avatar')){
            $url=$this->uploadImage($request->file('avatar'),"/users/$user->id/avatar");
            if ($user->image){
                $user->image()->update(['url'=>$url]);
            }else{
                $user->image()->create(['url'=>$url]);
            }
        }
        $user->update($request->all());

        return redirect(route('site.profile.index'));
    }

    public function comments(){

        $user = auth()->user();
        $comments = $user->productReviews()->with('product')->with('product.main_image')->latest()->get();
        return view('store.profile.comments', compact('user', 'comments'));

    }

    /**
     * @param ProductReview $productReview
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function comments_destroy(ProductReview $productReview){

        $productReview->delete();
        return back();
    }
}
