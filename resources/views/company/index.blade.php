@extends('layouts.backend')

@section('content')
<div class="px-0 px-sm-1 pt-2">
    <nav aria-label="breadcrumb" class="shadow-sm">
      <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="" class="text-gold"><h5> Companies</h5></a></li>
      </ol>
    </nav>
    <div>@include('elements/toastmsg')</div>
    <div class="row justify-content-center">
        <div class="<?= Auth::user()->role == 1 ? 'col-md-7' : 'col-12' ?> ">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <!-- <th>Total Employee</th> -->
                                <th>Email</th>
                                <th>Address</th>
                                <?php if (Auth::user()->role == 1): ?>
                                <th>Action</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody id="category_table">
                            @foreach($companies as $key => $c)
                                <tr id="row_{{$c->id}}">
                                    <td><?= ++$key ?></td>
                                    <td><a href="/admin/employees?companies_id=<?= $c->id ?>"> <?= $c->name ?></a></td>
                                    <!-- <td><?= 0 ?></td> -->
                                    <td><?= $c->email ?></td>
                                    <td><?= $c->address ?></td>
                                    <?php if (Auth::user()->role == 1): ?>
                                    <td>
                                        <a href="{{route('companies.edit',$c->id)}}" class="btn btn-xs btn-primary" ><i class="ti-pencil-alt"></i> Edit </a>
                                        <button  class="btn btn-danger btn-xs delete-btn" data-id="{{$c->id}}">
                                          <i class="ti-trash"></i> Delete
                                        </button>
                                    </td>

                                    <?php endif ?>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     {{ $companies->links()}}
                </div>
            </div>
        </div>
        <?php if (Auth::user()->role == 1): ?>
        <div class="col-md-5">
            <div class="card shadow-md">

                <form action="{{route('companies.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="card-header bg-gold text-white"><strong> Create Company </strong></div>
                    <div class="card-body">
                        
                        <div>
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name')}}" id="name" placeholder="Admin name">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="email">Email</label>
                            <input type="text"  name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email')}}" id="email" placeholder="Email">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" id="address" placeholder="address"> {{ old('address')}} </textarea>
                           
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
        <?php endif ?>
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
           $('#deleteForm').prop('action', '/admin/companies/'+$(this).data('id'));
        });
    </script>

@endsection