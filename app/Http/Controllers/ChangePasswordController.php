<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('change_password.index');
    }

    /**
     * Do Change Password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doChange(Request $request)
    {
        $request->validate([
            'oldPassword'       => 'required',
            'newPassword'       => 'required|same:confirmPassword',
            'confirmPassword'   => 'required|same:newPassword'
        ]);

        $user = User::find(session()->get('id'));

        if ( Hash::check($request->oldPassword, $user->password) ) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return redirect()->route('dashboard.index')->with('success', 'Password Berhasil di Ganti');
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }
    }
}
