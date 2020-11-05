<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SendType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SendTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sendTypes = SendType::latest()->get();
        return view('admin.contents.send_types.index', compact('sendTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contents.send_types.create');
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
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'status' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);
        $input = $request->all();

        try {
            $sendType = SendType::create($input);
            if ($request->file('image')) {
                $image_url = $this->uploadImage($request->file('image'), '/sendTypes');
                $sendType->image()->create(['url' => $image_url]);
            }


            Alert::success('', 'شیوه ی ارسال  با موفقیت افزوده  شد');
        } catch (ValidatorException $e) {
            Alert::warning('', 'متاسفانه مشکلی پیش آمد!');
        }

        return redirect(route('panel.sendTypes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SendType $sendType
     * @return \Illuminate\Http\Response
     */
    public function show(SendType $sendType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SendType $sendType
     * @return \Illuminate\Http\Response
     */
    public function edit(SendType $sendType)
    {
        return view('admin.contents.send_types.edit', compact('sendType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\SendType $sendType
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, SendType $sendType)
    {
        //        return $request->all();
        $this->validate($request, [
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'status' => 'required',
            'title' => 'required',
            'price' => 'required',
        ]);

        $input = $request->all();

        try {

            if ($request->file('image')) {
                $image_url = $this->uploadImage($request->file('image'), '/sendTypes');
                if ($sendType->image){
                    Storage::delete($sendType->image->url);
                    $sendType->image()->update(['url' => $image_url]);
                }else{
                    $sendType->image()->create(['url' => $image_url]);
                }

            }

            $sendType->update($input);
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect(route('panel.sendTypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SendType $sendType
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(SendType $sendType)
    {
        if ($sendType->image) {
            Storage::delete($sendType->image->url);
            $sendType->image()->delete();
        }
        $sendType->delete();
        Alert::success('', 'حذف با موفقیت انجام شد');

        return back();
    }
}
