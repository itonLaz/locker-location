<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\RoleHasPermission;
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
        $data['permissions'] = $this->getAllPermission();
        return view('permissions.index', $data);
    }

    public function role_permissions($id)
    {
        $data = [];
        $pivot_value = RoleHasPermission::where('role_id', $id)->pluck('permission_id');
        $permissions = Permission::whereIn('id', $pivot_value)->get()->pluck('id');
        
        $data['role_permissions'] = $permissions;
        $data['all_permissions'] = $this->getAllPermission();
        return $data;
    }

    private function getAllPermission()
    {
        return Permission::all();
    }
}
