<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Symfony\Component\HttpFoundation\makeDisposition;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification= [
            'message'=>'Admin Logout Successfully',
            'alert_type'=>'success'
        ] ;

        return redirect('/login')->with($notification);
    }

    public function profile()
    {

        $user_id = Auth::user()->id;
        $adminData = User::find($user_id);
        return view('admin.admin_profile_view', compact('adminData'));

    }

    public function editProfile()
    {
        $user_id = Auth::user()->id;
        $editData = User::find($user_id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function storeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);

         $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
        ]);

        if (!empty($data)) {
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;

            if ($request->file('profile_image')) {
                $file = $request->file('profile_image');
                $file_name = date('YmdHi').round(100). $file->getClientOriginalName();
                $file->move(public_path('upload/admin_images'), $file_name);
                $data['profile_image']=$file_name;
            }
            $data->save();
            $notification= [
                'message'=>'Admin Profile Update Successfully',
                'alert_type'=>'success'
            ] ;
            return redirect()->route('admin.profile')->with($notification);
        }else{
            $notification=[
                'message'=>`Admin Profile don't Update Successfully`,
                'alert_type'=>'warning'
            ] ;
            return redirect()->route('admin.profile')->with($notification);
        }

    }

    public function changePassword()
    {
        return view('admin.admin_change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $hash_had_password = Auth::user()->password;

        if (Hash::check($request->current_password, $hash_had_password)) {

            $user = User::find(Auth::id());
            $user->password = bcrypt($request->new_password);
            $user->save();

            session()->flash('message', 'Password update successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old  Password  is not match');
            return redirect()->back();
        }
    }
}
