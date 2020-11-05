<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;


class AuthController extends Controller
{
    public $guard;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'send_code']]);
        $this->guard = 'api';
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

        $mobile=$this->convertPersianToEnglish($request->mobile);

        $loginCode = $this->generateRandomNumber(5);
        $password = Hash::make(env('JWT_SECRET'));

        $user = User::whereMobile($mobile)->first();

        if ($user) {

            $user->update(['login_code' => $loginCode, 'password' => $password]);

        } else {
            $loginCode = $this->generateRandomNumber(5);
            $name = 'u_' . $this->generateRandomNumber(6);
            $user = User::create([
                'name' => $name,
                'mobile' => $mobile,
                'password' => $password,
                'login_code' => $loginCode
            ]);
        }
        Smsirlaravel::sendVerification($loginCode, $user->mobile,true);
//        Smsirlaravel::ultraFastSend(['VerificationCode' => $loginCode], 28443, $user->mobile);

//        $message="کد ورود شما:  $loginCode";
//        Smsirlaravel::send($message,$user->mobile);
        return response()->json(['status' => true]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
//        return $request->all();
        $this->validate($request,[
            'name' => 'required',
            'family' => 'required',
        ]);

//        $login_code=$this->convertPersianToEnglish($request->login_code);
//        $mobile=$this->convertPersianToEnglish($request->mobile);
//        $user = User::where(['mobile' =>$mobile, 'login_code' =>$login_code])->first();
        $user=auth()->user();
        if ($user) {
//            $credentials = [
//                'mobile' =>$mobile,
//                'password' => env('JWT_SECRET'),
//            ];
//            if (!$token = auth($this->guard)->attempt($credentials)) {
//                return response()->json(['error' => 'Unauthorized'], 401);
//            }

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

            return response()->json([
                'status'=>true,
//                'message'=>'user not find!'
            ]);
//            return $this->respondWithToken($token,$user->is_registered);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'user not find!'
            ]);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @param null $is_registered
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token,$is_registered=null)
    {
        $data=[
            'status' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard)->factory()->getTTL() * 60
        ];

        if ($is_registered!=null){
            $data=array_merge($data,['is_registered'=>$is_registered]);
        }
        return response()->json($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'needy_file' => ['required_if:needy,true'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param User $user
     * @param  array $data
     * @return User
     */
    protected function create(User $user, array $data)
    {
        $user->update([
            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
            'needy' => isset($data['needy']) ? true : false,
        ]);
        return $user;
    }


    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {


        $login_code=$this->convertPersianToEnglish($request->login_code);
        $mobile=$this->convertPersianToEnglish($request->mobile);

        $user = User::where(['mobile' =>$mobile, 'login_code' =>$login_code])->first();

        if ($user) {

            $credentials = [
                'mobile' => $request->mobile,
                'password' => env('JWT_SECRET'),
            ];
            if (!$token = auth($this->guard)->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

//            return response()->;
            return $this->respondWithToken($token,$user->is_registered);
        }else{
            return response()->json([
                'status'=>false,
                'message'=>'user not find!'
            ]);
        }
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
//        return response()->json(auth($this->guard)->user());
        return response()->json([
            'user' => auth($this->guard)->user(),
            'needy' => auth($this->guard)->user()->hasRole('needy')
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout($this->guard);

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth($this->guard)->refresh());
    }
}
