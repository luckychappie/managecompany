@extends('layouts.backend')

@section('content')
<div class="container">

    <nav aria-label="breadcrumb" class="shadow-sm mb-2">
        <ol class="breadcrumb bg-white">
            <li class="d-flex"><h5>Admin</h5> </li>
            <li class="breadcrumb-item ms-auto"><a href="{{route('backend.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin</li>
        </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm" >
                <div class="card-header bg-danger text-white d-flex justify-content-between align-middle">
                    <h6 class="font-weight-bold mt-1"><i class="bi bi-md bi-plus-lg me-2"></i>{{ __('Update Admin') }}</h6>
                    <div>
                        <a href="{{route('backend.user.index')}}" class="text-white"><i class="bi bi-list-ul"></i> Admin List</a>
                        <a href="{{route('backend.user.create')}}" class="text-white ms-3"><i class="bi bi-plus-lg"></i> Create New</a>
                    </div>
                </div>


                <div>
                    <form class="was-validated" action="{{route('backend.user.update', $user->id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="card-body">
                          
                            <div class="row mt-4">
                                <label class="col-sm-2 required" for="name"> Name </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control col-10 {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name"  value="{{old('name', $user->name)}}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                             <div class="row mt-3">
                                <label class="col-sm-2" for="name">Email </label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control col-10 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{old('email', $user->email)}}" >
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-2 required" for="name">Phone Number </label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" class="form-control col-10 {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" id="phone_number" value="{{old('phone_number', $user->phone_number)}}" required>
                                    @if ($errors->has('phone_number'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone_number') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-check mt-4">
                              <input name="role" class="form-check-input" type="checkbox" value="1" id="role" {{old('role', $user->role)=="1" ? 'checked' : ''}}>
                              <label class="form-check-label" for="role">
                                Is Admin? <small class="text-muted ml-3">[ Admin has permission to create, update & delete user account. ]</small>
                              </label>
                            </div>
                            <div class="form-check mt-3">
                              <input name="status" class="form-check-input" type="checkbox" value="1" id="status" {{old('status', $user->status)=="1" ? 'checked' : '' }}>
                              <label class="form-check-label" for="status">
                                Is Active to Show?
                              </label>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <a href="{{route('backend.user.index')}}" class="btn btn-secondary px-4 mr-2" type="submit"><i class="fa fa-chevron-left"></i> Back</a>
                            <button class="btn btn-primary px-4" type="submit"><i class="fa fa-save"></i> Save</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
