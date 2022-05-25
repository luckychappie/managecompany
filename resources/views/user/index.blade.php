@extends('layouts.backend')

@section('content')
<div class="px-0 px-sm-1 pt-2">
    <nav aria-label="breadcrumb" class="shadow-sm">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item d-flex"><a href="" class="text-gold d-flex"><h5> Admin/Staff</h5> <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-plus"></i> Add New Admin/Staff</a></a></li>
      </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="category_table">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->role == 1 ? 'Admin' : 'Staff' ?></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
