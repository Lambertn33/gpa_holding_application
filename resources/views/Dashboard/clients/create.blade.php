@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Register new Client</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('NewClientRegistration') }}" method="POST">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Enter Client Names</label>
                                <input type="text" class="form-control border-2" name="clientNames" value="{{ old('clientNames') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Client Email</label>
                                <input type="text" class="form-control border-2" name="clientEmail" value="{{ old('clientEmail') }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Client Address</label>
                                <input type="text" class="form-control border-2" name="clientAddress" value="{{ old('clientAddress') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                               <label class="form-label">Enter Client Tin</label>
                               <input type="text" class="form-control border-2" name="clientTin" value="{{ old('clientTin') }}">
                           </div>
                           <div class="form-group">
                               <label class="form-label">Enter Contact Name</label>
                               <input type="text" class="form-control border-2" name="contactName" value="{{ old('contactName') }}">
                           </div>
                           <div class="form-group">
                               <label class="form-label">Enter Contact Phone Number</label>
                               <input type="text" class="form-control border-2" name="clientPhoneNo" value="{{ old('clientPhoneNo') }}">
                           </div>

                       </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Register New Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
