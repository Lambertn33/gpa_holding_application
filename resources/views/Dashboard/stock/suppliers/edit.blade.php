@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">edit {{ $supplierToEdit->names }}</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('supplierUpdate',$supplierToEdit->id) }}" method="POST">
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
                                <label class="form-label">Supplier Names</label>
                                <input type="text" class="form-control border-2" name="supplierNames" value="{{ $supplierToEdit->names}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Supplier Address</label>
                                <input type="text" class="form-control border-2" name="supplierAddress" value="{{ $supplierToEdit->address}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Supplier Number</label>
                                <input type="text" class="form-control border-2" name="supplierPhoneNo" value="{{ $supplierToEdit->phone_No}}">
                            </div>
                            <button class="btn btn-success" type="submit">Update Supplier</button>
                         </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
