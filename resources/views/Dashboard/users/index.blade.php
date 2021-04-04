@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg) @if(Session::has($msg))

        <div class="alert alert-{{ $msg }}  alert-dismissible fade show" role="alert">
            {{ Session::get($msg) }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
                 </button>
        </div>
        @endif
       @endforeach
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">All Available Users</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getNewUserRegistrationPage') }}"  class="btn btn-primary">Register New User</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">First Name</th>
                                <th class="border-bottom-0">Last Name</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Role</th>
                                <th class="border-bottom-0">Account Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allUsers as $item)
                            @if(Auth::user()->id !==$item->id)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->first_Name }}</td>
                                <td>{{ $item->last_Name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    {{-- {{ $item->status === "ACTIVE" ? <span class="badge badge-success">Active</span> }} --}}
                                    @if($item->status === "ACTIVE")
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Blocked</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{ route('userEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  @if($item->status === "ACTIVE")
                                  <a href="{{ route('userUpdateStatus',$item->id) }}" class="btn btn-danger btn-sm">Disable Account</a>
                                  @else
                                  <a href="{{ route('userUpdateStatus',$item->id) }}" class="btn btn-success btn-sm">Enable Account</a>
                                  @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
