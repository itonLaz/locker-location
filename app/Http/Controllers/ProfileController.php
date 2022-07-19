<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
// use App\Models\Role;
use Spatie\Permission\Models\Role;
use App\Models\User;

class ProfileController extends Controller
{   
    /**
     * Show the form for creating new profile.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['roles'] = Role::all();
        // dd($all_users_with_all_their_roles = User::with('roles')->get());
        // $user = User::find(7);
        // echo'<pre>'; print_r($user->getAllPermissions());
        // exit();
        return view('profile.create', $data);
    }
    
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $data['roles'] = Role::all();
        return view('profile.edit', $data);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_profile' => __('You are not allowed to change data for a default user.')]);
        }

        auth()->user()->update($request->all());

        //update current user's Role
        $user = User::find(auth()->user()->id);
        $user->syncRoles([$request->role]);
        
        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for a default user.')]);
        }

        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
