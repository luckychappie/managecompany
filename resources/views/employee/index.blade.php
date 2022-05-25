@extends('layouts.backend')

@section('content')
<div class="px-0 px-sm-1 pt-2">
    <nav aria-label="breadcrumb" class="shadow-sm">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item d-flex"><a href="" class="text-gold d-flex"><h5> Employees</h5> <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-plus"></i> Add New Employee</a></a></li>
      </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <form action="{{route('employees.index')}}" method="get">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <select name="companies_id" class="form-select form-control">
                                  <option value="">Choose company</option>
                                  <?php foreach ($companies as $key => $company): ?>
                                        <option value="{{$company->id}}" {{ app('request')->input('companies_id') == $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                  <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="keyword" value="{{ app('request')->input('keyword') }}" class="form-control ml-2" placeholder="Search by keyword...">
                                
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Search</button>
                                <a href="{{route('employees.index')}}" class="btn btn-success ml-1"><i class="fa fa-refresh" title="Refresh"></i> Clear</a>
                                <a href="/employees/export" class="btn btn-primary ml-1"><i class="fa fa-table" title="Refresh"></i> Export CSV</a>

                            </div>
                            
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>StaffID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="category_table">
                            @foreach($employees as $key => $e)
                                <tr>
                                    <td><?= $e->staff_id ?></td>
                                    <td><?= $e->first_name .' '. $e->last_name ?></td>
                                    <td><?= $e->department ?></td>
                                    <td><?= $e->company ? $e->company->name : '-' ?></td>
                                    <td><?= $e->email ?></td>
                                    <td><?= $e->phone_number ?></td>
                                    <td><?= $e->address ?></td>
                                    <td>
                                        <a href="{{route('employees.edit',$e->id)}}" class="btn btn-xs btn-primary" ><i class="ti-pencil-alt"></i> Edit </a>
                                        <button  class="btn btn-danger btn-xs delete-btn" data-id="{{$e->id}}">
                                          <i class="ti-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $employees->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<!--Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <form id="deleteForm" action="" method="post">
        {{ csrf_field() }}
        {{ method_field('Delete') }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <h5>Are you sure to delete this company?</h5>
              </div>
              <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Confirm & Delete</button>
              </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.delete-btn', function() {
           $('#deleteModal').modal('show');
           $('#deleteForm').prop('action', '/admin/employees/'+$(this).data('id'));
        });
    </script>

@endsection