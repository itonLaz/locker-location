@extends('layouts.app', ['titel' => __('User List')])

@section('content')
    @include('users.partials.header', [
            'title' => __('Hello') . ' '. auth()->user()->name,
            'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
            'class' => 'col-lg-7'
        ])

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Users</h3>
                        </div>
                        <div class="col-4 text-right">
                            @can('add users')
                            <a href="{{ route('profile.create') }}" class="btn btn-sm btn-primary">Add user</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }} </td>
                                    <td>{{ $user->email }} </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>Buttons</td>
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