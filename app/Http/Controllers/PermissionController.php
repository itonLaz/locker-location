<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions
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
        $data['permissions'] = Permission::all();
        return view('permissions.index', $data);
    }
}
