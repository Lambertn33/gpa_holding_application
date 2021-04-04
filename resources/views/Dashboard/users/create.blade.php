@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Register new User</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('NewUserRegistration') }}" method="POST">
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
                                <label class="form-label">Enter User First Name</label>
                                <input type="text" class="form-control border-2" name="userFirstName" value="{{ old('userFirstName') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter User Last Name</label>
                                <input type="text" class="form-control border-2" name="userLastName" value="{{ old('userLastName') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter User Email</label>
                                <input type="text" class="form-control border-2" name="userEmail" value="{{ old('userEmail') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter User Password</label>
                                <input type="password" class="form-control border-2" name="userPassword" value="{{ old('userPassword') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Select User Role</label>
                                 <select name="userRole" class="form-control">
                                     <option selected disabled>Select Role...</option>
                                     <option value="Administrator">Administrator</option>
                                     <option value="User">User</option>
                                 </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Register New User</button>
                         </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
