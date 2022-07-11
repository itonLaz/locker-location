@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => 'Roles',
        'description' => '',
        'class' => 'col-lg-12'
    ])   
    
    @include('roles.modal')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Roles</h3>
                            </div>
                            <div class="col-4 text-right">
                                @can('add roles')
                                <a href="{{ route('profile.create') }}" class="btn btn-sm btn-primary">Add Role</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Creation Date</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }} </td>
                                        <td>{{ $role->created_at }}</td>
                                        <td> <button type="button" data-role_id="{{ $role->id }}" class="btn btn-sm btn-outline-info view_permissions" @cannot('view roles') disabled @endcan>View</button></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger" @cannot('delete roles') disabled @endcan>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
