@extends('layouts.backend')

@section('content')
<div class="px-0 px-sm-1 pt-2">
    <nav aria-label="breadcrumb" class="shadow-sm">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('companies.index')}}" class="text-gold"><h5> Companies</h5></a></li>
      </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>
    <div class="row justify-content-center">
       
        <div class="col-md-12">
            <div class="card shadow-md">

                <form action="{{route('companies.update', $company)}}" method="post">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    <div class="card-header bg-gold text-white"><strong> Edit Company </strong></div>
                    <div class="card-body">
                        
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name',$company->name)}}" id="name" placeholder="Admin name">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="email">Email</label>
                            <input type="text"  name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{old('email',$company->email)}}" id="email" placeholder="Email">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" placeholder="address"> {{old('address',$company->address)}} </textarea>
                           
                        </div>
                        
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('companies.index') }}" class="btn btn-secondary px-3 mr-2" type="submit"><i class="fa fa-chevron-left"></i> Back</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
