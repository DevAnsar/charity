<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class IndexController extends Controller
{
    public function dashboard(){


//        $role = Role::create(['name' => 'admin']);
//        $permission = Permission::create(['name' => 'panel.permissions.index']);
//        $role->givePermissionTo($permission);
//        auth()->user()->assignRole('admin');
//        dd(auth()->user()->can('panel.dashboard'));

//        $role = Role::findByName('admin');
//        $permission = Permission::create(['name' => 'panel.app-settings']);
//        $role->givePermissionTo($permission);
//        dd(auth()->user()->can('panel.app-settings'));
        return view('admin.dashboard');
    }

    public function uploadImageSubject()
    {
        $this->validate(\request(), [
            'upload' => 'required|mimes:jpeg,png,jpg',
        ]);
        $year = Carbon::now()->year;
        $imagePath = "/upload/images/{$year}/";

        $file = \request()->file('upload');
        $fileName = $file->getclientOriginalName();

        if (file_exists(public_path($imagePath) . $fileName)) {
            $fileName = Carbon::now()->timestamp . $fileName;
        }
        $file->move(public_path($imagePath), $fileName);
        $url = $imagePath . $fileName;
        return "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";
    }
}
