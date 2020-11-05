<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class UserController extends Controller
{
//    use AuthenticatesUsers;
    public $UB = 'user.baskets';

    public function get_basket()
    {

//        session()->forget($this->UB);
        if (!session()->has($this->UB)) {
            session()->put($this->UB, []);
        }
        return session()->get($this->UB);
    }

    public function add_basket(Request $request)
    {
        $product = Product::whereId($request->product_id)->first();
        if (!$product) {
            return response()->json(['status' => false]);
        }
        $oldBasket = session()->get($this->UB);

        $product_has_in_basket = false;
        $basket = [];
        foreach ($oldBasket as $item) {
            if ($item['product_id'] == $product->id) {
                $product_has_in_basket = true;
            }
            $item_product = Product::whereId($item['product_id'])->first();
            if ($item_product) {
                $basket[] = [
                    'product_id' => $item_product->id,
                    'title' => $item_product->title,
                    'price' => $item_product->price,
                    'image' => $item_product->images()->where('isMain', 1)->first()->url,
                    'count' => $item['count'] + 1,
                    'discount' => $item_product->discount
                ];
            }
        }

        if (!$product_has_in_basket) {

            $basket[] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'image' => $product->images()->where('isMain', 1)->first()->url,
                'count' => 1,
                'discount' => $product->discount
            ];
        }
        $request->session()->put($this->UB, $basket);

        return response()->json([
            'status' => true,
            'basket' => $basket
        ]);
    }

    public function delete_basket(Request $request)
    {
        $product = Product::whereId($request->product_id)->first();
        if (!$product) {
            return response()->json(['status' => false]);
        }
        $oldBasket = session()->get($this->UB);

        $basket = [];
        foreach ($oldBasket as $item) {
            if ($item['product_id'] != $product->id) {
                $basket[] = $item;
            }

        }

        $request->session()->put($this->UB, $basket);

        return response()->json([
            'status' => true,
            'basket' => $basket
        ]);
    }

    public function setBasket(Request $request)
    {

//        return $request->basket;
        $request->session()->put($this->UB, $request->basket);

        return response()->json([
            'status' => true,
        ]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send_code(Request $request)
    {


        if (!isset($request->mobile)) {
            return response()->json(['status' => false, 'message' => 'mobile required'], 200);
        }

        $mobile = $this->convertPersianToEnglish($request->mobile);
        $loginCode = $this->generateRandomNumber(5);
        $password = Hash::make(env('JWT_SECRET'));

        $user = User::whereMobile($mobile)->first();

        if ($user) {

            $user->update(['login_code' => $loginCode, 'password' => $password]);

        } else {

//            $this->validate($request,[
//                'mobile'=>'required|size=11|unique:users'
//            ]);
//            return 'asdasd';
            $name = 'u_' . $this->generateRandomNumber(6);


            $user = new User();
            $user->name = $name;
            $user->mobile = $mobile;
            $user->login_code = $loginCode;
            $user->save();

//            $user = User::create([
//                'name' => $name,
//                'mobile' => $mobile,
//                'password' => $password,
//                'login_code' => $loginCode,
//                'is_registered'=>false
//            ]);
        }
//        Smsirlaravel::send("کد ورود:$loginCode",$user->mobile);
        Smsirlaravel::sendVerification($loginCode, $user->mobile, true);
//        Smsirlaravel::ultraFastSend(['VerificationCode' => $loginCode], 28443, $user->mobile);

//        return 'ok';
        return response()->json(['status' => true, 'registered' => $user->is_registered]);
    }


    public function login(Request $request)
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $login_code = $this->convertPersianToEnglish($request->login_code);
        $mobile = $this->convertPersianToEnglish($request->mobile);

        $user = User::where(['mobile' => $mobile, 'login_code' => $login_code])->first();

        if ($user) {

            if ($user->is_registered) {
//                return $request;
                $credentials = [
                    'mobile' => $mobile,
                    'password' => env('JWT_SECRET'),
                ];
                if (auth()->attempt($credentials)) {
                    return response()->json([
                        'status' => true,
                        'registered' => $user->is_registered,
                    ]);
                }
            } else {
                return response()->json([
                    'status' => true,
                    'registered' => $user->is_registered,
                ]);
            }


        } else {
            return response()->json([
                'status' => false,
                'message' => ''
            ]);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    /**
     * Show the application's login form.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        if (!$request->_redirect) {
            $request->_redirect = '/';
        }
        return view('auth.login', ['redirect' => $request->_redirect]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'family' => 'required',
        ]);

        $login_code = $this->convertPersianToEnglish($request->login_code);
        $mobile = $this->convertPersianToEnglish($request->mobile);

        $user = User::where(['mobile' => $mobile, 'login_code' => $login_code])->first();

        if ($user) {
            $needy = false;
            $store = false;
            $helper = false;

            $user_types = $request->input('user_types');
            $user_types_arr = explode(',', $user_types);
            if (in_array('needy', $user_types_arr)) {
                 $needy = true;

                $this->validate($request,[
                    'needy_file'=>'nullable|mimes:png,jpg,jpeg,pdf',
                    'code_melli' => 'required',
                    'date_of_birth' =>'required',
                    'state_id' => 'required',
                    'city_id' =>'required',
                    'is_married' =>'required',
                    'number_of_child' =>'required',
                    'is_employed' =>'required',
                    'health_status' =>'required',
                    'covered' =>'required',
                    'housing_situation' =>'required',
                    'tell' =>'nullable',
                    'address' =>'required',
                ]);
            }
            if (in_array('store', $user_types_arr)) {
                $store = true;
            }
            if (in_array('helper', $user_types_arr)) {
                $helper = true;
            }

            $user->update([
                'name' => $request->input('name'),
                'family' => $request->input('family'),
                'needy' => $needy,
                'store' => $store,
                'helper' => $helper,
                'is_registered' => true
            ]);

            if ($needy) {
                $url = '';
                if ($request->file('needy_file')) {
                    $url = $this->uploadFile($request->file('needy_file'), "/files/users/$user->id");
//                $user->files()->create(['url' => $url]);
                }

                $needyData = [
                    'code_melli' => $request->code_melli,
                    'date_of_birth' => $request->date_of_birth,
                    'state_id' => $request->state_id,
                    'city_id' => $request->city_id,
                    'is_married' => $request->is_married,
                    'number_of_child' => $request->number_of_child,
                    'is_employed' => $request->is_employed,
                    'health_status' => $request->health_status,
                    'covered' => $request->covered,
                    'housing_situation' => $request->housing_situation,
                    'tell' => $request->tell,
                    'address' => $request->address,
                    'evidence' => $url
                ];

                if ($user->needyData) {

                    $user->needyData()->update($needyData);
                } else {
//                    return $user->needyData();
                    $user->needyData()->create($needyData);
                }
            }

            auth()->loginUsingId($user->id);
//            $this->guard()->login($user);

            return response()->json([
                'status' => true,
            ]);

        } else {
            return response()->json([
                'status' => false,
                'message' => 'user not find!'
            ]);
        }
    }
}
