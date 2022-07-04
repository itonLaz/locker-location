<?php

namespace App\Http\Controllers;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the roles
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        // $id = 1;
        // $data = [];
        // $data['roles'] = Role::whereHas('permission', function($q) use ($id){
        //     $q->where('id', $id);
        // })->get();
        // echo '<pre>'; print_r($data);
        // exit();
        $data['roles'] = Role::all();
        // dd($data);
        return view('roles.index', $data);
    }
}
