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
        $data['users'] = User::orderBy('created_at', 'desc')->with('roles')->get();
        
        foreach($data['users'] as $key => $user) {
            $role = $user->roles->first();
            $data['users'][$key]['role_id'] = $role->id;
            $data['users'][$key]['role_name'] = $role->name;
        }

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
