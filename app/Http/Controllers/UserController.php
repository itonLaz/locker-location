<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $data['users'] = User::orderBy('created_at', 'desc')->get();

        // $all_users_with_all_their_roles = User::with('permissions')->get();
        // dd($all_users_with_all_their_roles);
        
        return view('users.index', $data);
    }

    public function show_register_form()
    {
        // dd('test');
        if(View::exists('profile.register')){
            return view('profile.register');
        }
    }

    public function process_signup(Request $request)
    {
        // $this->validate($request, [ 
        //     'username' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|confirmed|min:6',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
            'created_at' => now(),
            'created_at' => now(),

        ]);

        $user->assignRole($request->role);

        return response()->json(
            [
                'success' => true,
                'message' => 'Registration is completed'
            ]
        );

    }
}
