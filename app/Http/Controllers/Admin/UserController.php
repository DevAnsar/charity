<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->list){
            $request->list='needy';
        }
        $list=$request->list;

        $all_roles_in_database = Role::all()->pluck('name')->toArray();

        if ($list!='all' && $list!='unauth_needy'){
            if (in_array($list,$all_roles_in_database)){
            $users = User::role($request->list)->latest()->get();
            }else{
                $users = User::latest()->get();
            }
        }else{

            if ($list=='unauth_needy'){
                $users = User::where('needy','=',1)->where('hasNeedy','=',0)->latest()->get();
            }else{
                $users = User::latest()->get();
            }
        }


        foreach ($users as $user) {
            $user['role'] = $this->getArrayColumn($user->roles()->get(), 'name');
        }
        return view('admin.settings.users.index', compact('users','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return view('admin.settings.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $input = $request->all();

        $input['roles'] = isset($input['selected_roles']) ? explode(',', $input['selected_roles']) : [];
        $input['password'] = Hash::make($input['password']);
        $input['api_token'] = Str::random(60);

        try {
            $user = User::create($input);
            $user->syncRoles($input['roles']);

            if (isset($input['avatar']) && $input['avatar']) {
                $cacheUpload = Upload::query()->where('uuid', $input['avatar'])->first();
                $mediaItem = $cacheUpload->getMedia('avatar')->first();
                $mediaItem->copy($user, 'avatar');
            }
//            event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Alert::success('', 'کاربر  با موفقیت افزوده  شد');

        return redirect(route('panel.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (empty($user)) {
//            Flash::error('Permission not found');
            return redirect(route('panel.users.index'));
        }
        $roles = Role::select('id', 'name')->get();
        $rolesSelected = $user->roles()->select('id', 'name')->get();

        return view('admin.settings.users.edit', compact('user', 'roles', 'rolesSelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
//        return $request->all();
        $user = User::find($id);
        $roles=[
            'name'=>'required',
        ];
        if ($request->email == $user->email){
            $roles=array_merge($roles,['email'=>'nullable|email']);
        }else{
            $roles=array_merge($roles,['email'=>'nullable|email|unique:users']);
        }

        if ($request->mobile == $user->mobile){
            $roles=array_merge($roles,['mobile'=>'required|size:11']);
        }else{
            $roles=array_merge($roles,['mobile'=>'required|size:11|unique:users']);
        }
        $this->validate($request,$roles);


        $input = $request->all();
        $input['roles'] = isset($input['selected_roles']) ? explode(',', $input['selected_roles']) : [];
        if (empty($input['password'])) {
            unset($input['password']);
        } else {
            $input['password'] = Hash::make($input['password']);
        }

        try {

            $user->update($input);
            if (empty($user)) {
//                Flash::error('User not found');
                return redirect(route('panel.users.index'));
            }
            if ($request->file('avatar')) {
                $image_url=$this->uploadImage($request->file('avatar'),"/users/$user->id/avatar");
                if ($user->image){
                    Storage::delete($user->image->url);
                    $user->image()->update(['url'=>$image_url]);
                }else{
                    $user->image()->create(['url'=>$image_url]);
                }

            }
            $needy_role=Role::whereName('needy')->first();
//
//            if ($request->input('hasNeedy')=='1') {
//
//                if (!in_array($needy_role->id,$input['roles'])){
//                    $input['roles'][]=$needy_role->id;
//                }
//            }else{
//                if (in_array($needy_role->id,$input['roles'])){
//                    $_roles=[];
//                    foreach ($input['roles'] as $item){
//                        if ($item != $needy_role->id){
//                            $_roles[]=$item;
//                        }
//                    }
//                    $input['roles']=$_roles;
//                }
//            }

            if (in_array($needy_role->id, $input['roles'])) {
                $user->update(['hasNeedy'=>true]);
            }else{
                if ($user->hasNeedy){
                    $user->update(['hasNeedy'=>false]);
                }
            }

            $user->syncRoles($input['roles']);

            $user->needyData()->update([
                'discount_percent'=>$request->discount_percent,
                'charge_inventory'=>$request->charge_inventory,
            ]);
//            event(new UserRoleChangedEvent($user));
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }


        Alert::success('', 'ویرایش با موفقیت انجام شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('panel.users.index'));
        }
        $user->delete($id);
        Alert::success('', 'کاربر با موفقیت حذف شد');
        return redirect(route('panel.users.index'));
    }

    /**
     * Remove Media of User
     * @param Request $request
     */
    public function removeMedia(Request $request)
    {
        if (auth()->user()->can('medias.delete')) {
            $input = $request->all();
            $user = User::find(($input['id']));
            try {
                if ($user->hasMedia($input['collection'])) {
                    $user->getFirstMedia($input['collection'])->delete();
                }
            } catch (\Exception $e) {
//                Log::error($e->getMessage());
            }
        }
    }
}
