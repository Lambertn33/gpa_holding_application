@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Edit {{ $userToEdit->first_Name }} {{ $userToEdit->last_Name }}</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('userUpdate',$userToEdit->id) }}" method="POST">
                    <input type="hidden" name="_method" value="put">
                    @csrf
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
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <label class="form-label">User First Name</label>
                                <input type="text" class="form-control border-2" name="userFirstName" value="{{ $userToEdit->first_Name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Last Name</label>
                                <input type="text" class="form-control border-2" name="userLastName" value="{{ $userToEdit->last_Name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Email</label>
                                <input type="text" class="form-control border-2" name="userEmail" value="{{ $userToEdit->email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Role</label>
                                 <select name="userRole" class="form-control">
                                     <option selected disabled>Select Role...</option>
                                     <option value="Administrator">Administrator</option>
                                     <option value="User">User</option>
                                 </select>
                            </div>
                            <button class="btn btn-success" type="submit">Update User</button>
                         </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
