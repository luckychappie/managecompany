@extends('layouts.backend')

@section('content')
<div class="px-0 px-sm-1 pt-2">
    <nav aria-label="breadcrumb" class="shadow-sm">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('employees.index')}}" class="text-gold"><h5> Employees</h5></a></li>
      </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-md">
                <form action="{{route('employees.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="card-header bg-gold text-white"><strong> Add New Employee </strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="companies_id">Company</label>
                                <select name="companies_id" class="form-select form-control {{ $errors->has('companies_id') ? ' is-invalid' : '' }}" id="companies_id" >
                                  <option value="">Choose company</option>
                                  <?php foreach ($companies as $key => $company): ?>
                                        <option value="{{$company->id}}" {{old('companies_id') == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                  <?php endforeach ?>
                                </select>
                                @if ($errors->has('companies_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('companies_id') }}
                                    </div>
                                @endif
                            </div>
                             <div class="col-md-6">
                                <label for="department">Department</label>
                                <input type="text" name="department" class="form-control {{ $errors->has('department') ? ' is-invalid' : '' }}" value="{{ old('department')}}" id="department" placeholder="Department name">
                                @if ($errors->has('department'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('department') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="first_name">Employee First Name</label>
                                <input type="text" name="first_name" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name')}}" id="first_name" placeholder="First name">
                                @if ($errors->has('first_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('first_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Employee Last Name</label>
                                <input type="text" name="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name')}}" id="last_name" placeholder="Last name">
                                @if ($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mt-4">
                                <label for="phone_number">Phone Number</label>
                                <input type="text"  name="phone_number" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{ old('phone_number')}}" id="phone_number" placeholder="Phone Number">
                                @if ($errors->has('phone_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone_number') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mt-4">
                                <label for="email">Email</label>
                                <input type="text"  name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email')}}" id="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="staff_id">Staff ID</label>
                                <input type="text"  name="staff_id" class="form-control {{ $errors->has('staff_id') ? ' is-invalid' : '' }}" value="{{ old('staff_id')}}" id="staff_id" placeholder="eg., i002">
                                @if ($errors->has('staff_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('staff_id') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="address">Address</label>
                                <textarea name="address" class="form-control" id="address" placeholder="address"> {{ old('address')}} </textarea>
                               
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary px-3 mr-2" type="submit"><i class="fa fa-chevron-left"></i> Back</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>

@endsection
