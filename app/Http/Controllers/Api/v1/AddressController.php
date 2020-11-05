<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $addresses = $user->addresses()->oldest()->get();

        return response()->json([
            'addresses' => $addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'receiver' => 'required',
            'mobile' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable',
        ]);
        $user = auth()->user();

        $city = City::find($request->city_id);
        $state = $city->parent;

        $address = $user->addresses()->create(array_merge($request->all(), [
            'is_default' => true,
            'state' => $state->title,
            'state_id' => $state->id,
            'city' => $city->title
        ]));

        $user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);

        return response()->json([
            'status' => true,
            'addresses' => $user->addresses()->oldest()->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAddress $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\UserAddress $userAddress
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, UserAddress $userAddress)
    {

        $this->validate($request, [
            'receiver' => 'required',
            'mobile' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable',
        ]);

        $user = auth()->user();
        $city = City::find($request->city_id);
        $state = $city->parent;

        $userAddress->update(array_merge($request->all(), [
            'is_default' => true,
            'state' => $state->title,
            'state_id' => $state->id,
            'city' => $city->title
        ]));

        $user->addresses()
            ->where('id', '!=', $userAddress->id)
            ->update(['is_default' => false]);

        return response()->json([
            'status' => true,
            'addresses' =>$user->addresses()->oldest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress $userAddress
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(UserAddress $userAddress)
    {
        $user = auth()->user();
        $default = false;
        if ($userAddress->is_default) {
            $default = true;
        };

        $userAddress->delete();

        if ($default) {
            $address=$user->addresses()->latest()->first();
            if ($address){
                $address->update(['is_default' => true]);
            }
        }
        return response()->json([
            'status' => true,
            'addresses' =>$user->addresses()->oldest()->get(),
        ]);
    }
}
