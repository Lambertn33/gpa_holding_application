@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Register new Proforma</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('saveClientToMakeProforma') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Client</label>
                                <select name="client" class="form-control">
                                    <option selected disabled>Select Client...</option>
                                    @foreach ($allClients as $item)
                                    <option value="{{ $item->id }}">{{ $item->client_Names }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="submit">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

