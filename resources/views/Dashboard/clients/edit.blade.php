@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Edit {{ $clientToEdit->client_Names }}</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('clientUpdate' , $clientToEdit->id) }}" method="POST">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Client Names</label>
                                <input type="text" class="form-control border-2" name="clientNames" value="{{ $clientToEdit->client_Names }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Client Email</label>
                                <input type="text" class="form-control border-2" name="clientEmail" value="{{ $clientToEdit->email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Client Address</label>
                                <input type="text" class="form-control border-2" name="clientAddress" value="{{ $clientToEdit->Address }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                               <label class="form-label">Client Tin</label>
                               <input type="text" class="form-control border-2" name="clientTin" value="{{ $clientToEdit->Tin }}">
                           </div>
                           <div class="form-group">
                               <label class="form-label">Contact Name</label>
                               <input type="text" class="form-control border-2" name="contactName" value="{{ $clientToEdit->contact_Names }}">
                           </div>
                           <div class="form-group">
                               <label class="form-label">Contact Phone Number</label>
                               <input type="text" class="form-control border-2" name="clientPhoneNo" value="{{ $clientToEdit->phone_No }}">
                           </div>

                       </div>
                        </div>
                        <button class="btn btn-success" type="submit">Update Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
