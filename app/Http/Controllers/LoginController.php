<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * Fo Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doLogin(Request $request)
    {
        $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ( $user && (Hash::check($request->password, $user->password)) ) {

            session([
                'id'            => $user->id,
                'name'          => $user->name,
                'username'      => $user->username,
                'role'          => $user->role,
                'division_id'   => $user->division_id
            ]);

            if (Hash::check('password', $user->password)) {
                return redirect()->route('change_password');
            } else {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username atau Password Salah');
        }
    }

    public function logout()
    {
        Session::forget(['id', 'name', 'username', 'role', 'division_id']);

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}
