<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

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

    public function show_form()
    {
        $data['permissions'] = Permission::all();

        return view('roles.create', $data);
    }
    
    public function insert_role(Request $request)
    {
        
        $role = Role::create(['name' => $request->name]);
        // dd($request->name);

        foreach ($request->permissions as $value) {
            $role->givePermissionTo($value);
        }

        echo 'done'; exit();
    }
    
}
