@extends('layouts.backend')

@section('content')
<div class="container">

    <nav aria-label="breadcrumb" class="shadow-sm mb-2">
        <ol class="breadcrumb bg-white">
            <li class="d-flex"><h5>Training Center</h5> </li>
            <li class="breadcrumb-item ms-auto"><a href="{{route('backend.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Training Center</li>
        </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm" >
                <div class="card-header bg-danger text-white d-flex justify-content-between">
                    <h6 class="font-weight-bold mt-1"><i class="bi bi-md bi-plus-lg me-2"></i>{{ __('Create admin account') }}</h6>
                    <a href="{{route('backend.user.index')}}" class="text-white"><i class="bi bi-list-ul"></i> Admin List</a>
                </div>


                <div>
                    <form class="was-validated" action="{{route('backend.user.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            
                            <div class="row mt-4">
                                <label class="col-sm-2 required" for="name">Name </label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control col-10 {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{ old('name')}}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-2 required" for="name">Email </label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control col-10 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email')}}" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-sm-2" for="name">Phone Number </label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone_number" class="form-control col-10" id="phone_number" value="{{ old('phone_number')}}">
                                </div>
                            </div>
                            <div class="form-check mt-4">
                              <input name="role" class="form-check-input" type="checkbox" value="1" id="role" {{old('role') == 1 ? 'checked' : ''}}>
                              <label class="form-check-label" for="role">
                                Is Admin? <small class="text-muted ml-3">[ Admin has permission to create, update & delete user account. ]</small>
                              </label>
                            </div>
                            <div class="form-check mt-3">
                              <input name="status" class="form-check-input" type="checkbox" value="1"  {{old('status') == 1 ? 'checked' : ''}} id="status">
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
