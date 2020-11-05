<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Product;
use App\Models\SendType;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public $UB = 'user.baskets';

    public function index(Request $request)
    {
        $default_address = auth()->user()->addresses()->where('is_default', true)->first();

        $send_types = SendType::whereStatus(1)->get();

        if (!$request->session()->has('send_factor')) {
            $request->session()->put('send_factor', '0');
        }

        if (!$request->session()->has('default_address')) {

            if ($default_address) {
                $request->session()->put('default_address', $default_address->id);
            } else {
                $request->session()->put('default_address', 0);
            }
        }

        if (!$request->session()->has('send_type')) {
            $request->session()->put('send_type', $send_types[0]->id);
        }


        $oldBasket = session()->get($this->UB);
        $basket = [];
        foreach ($oldBasket as $item) {
            $basket[] = $item['product_id'];
        }

//        $default_address=session()->get('default_address');
        $send_type = session()->get('send_type');
        $send_factor = session()->get('send_factor');
        $products = Product::whereIn('id', $basket)->with('main_image')->get();

        $addresses = auth()->user()->addresses;

        $cities=City::where('parent_id','=',0)->with('children')->get();
        return view('store.shopping', compact('products', 'addresses', 'default_address', 'send_type', 'send_factor', 'send_types','cities'));
    }

    public function get_province(){
        return response()->json([
           'states'=>City::whereParent_id(0)->get()
        ]);
    }
    public function get_city($state_id){

        $state=City::find($state_id);
        return response()->json([
           'city'=>$state->children
        ]);
    }
    public function addNewAddress(Request $request)
    {
        $user = auth()->user();
        $city = City::find($request->city_id);
        $state = $city->parent;

        $id=$request->get('id',0);
        if($id==0)
        {
            $address = $user->addresses()->create(array_merge($request->all(), ['state'=>$state->title,'city'=>$city->title,'is_default' => true]));
        }
        else{
            $address=UserAddress::where(['id'=>$id,'user_id'=>$user->id])->first();
            if($address)
            {
                $address->update(array_merge($request->all(), ['state'=>$state->title,'city'=>$city->title,'is_default' => true]));
            }
            else{
                return 'error';
            }
        }




        if (!$request->session()->has('default_address')) {
            $request->session()->put('default_address', $address->id);
        } else {
            $request->session()->put('default_address', $address->id);
        }


        $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        return response()->json([
            'status' => true,
            'address' => $address
        ]);
    }
    public function RemoveAddress($address_id){
        $user = auth()->user();
        $address=UserAddress::where(['id'=>$address_id,'user_id'=>$user->id])->first();
        if($address)
        {
            $default = false;
            if ($address->is_default) {
                $default = true;
            };
            $address->delete();

            if ($default) {
                $address=$user->addresses()->latest()->first();
                if ($address){
                    $address->update(['is_default' => true]);
                }
            }
        }
    }
    public function changeAddress(Request $request)
    {
        $user = auth()->user();

        $address = UserAddress::find($request->id);
        if ($address->user_id == $user->id) {
            $address->update(['is_default' => true]);

//            return $address;
            if (!$request->session()->has('default_address')) {
                $request->session()->put('default_address', $address->id);

            } else {
                $request->session()->put('default_address', $address->id);

            }


            $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            return response()->json([
                'status' => true,
//            'address' => $address
            ]);
        } else {
            return response()->json([
                'status' => false,
//            'address' => $address
            ]);
        }
    }
    public function changeSendType(Request $request)
    {
//        $user = auth()->user();

        $send_type = SendType::find($request->id);
        if ($send_type) {

//            return $address;
            if (!$request->session()->has('send_type')) {
                $request->session()->put('send_type', $request->id);
            } else {
                $request->session()->put('send_type', $request->id);
            }

            return response()->json([
                'status' => true,
//            'address' => $address
            ]);
        } else {
            return response()->json([
                'status' => false,
//            'address' => $address
            ]);
        }
    }
}
