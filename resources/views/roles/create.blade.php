@extends('layouts.app', ['title' => __('Roles')])

@section('content')
    @include('users.partials.header', [
        'title' => 'Create Role',
        'description' => '',
        'class' => 'col-lg-12'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-3">
                        </div>
                        <div class="col-6">
                            <form role="form" method="POST" action="{{ route('role.insert') }}">
                                @csrf
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        @foreach($permissions as $permission)
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input" name="permissions[]" id="{{ $permission->id}}" value="{{ $permission->name }}" type="checkbox">
                                                <label class="custom-control-label" for="{{ $permission->id }}"> {{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Create role') }}</button>
                                </div>

                            </form>
                        </div>
                        
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
