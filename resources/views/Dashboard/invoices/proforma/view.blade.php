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
                <div class="card-title text-lg text-blue-500">All Available Proforma for {{ $clientToView->client_Names }}</div>

            </div>
            <div class="card-body pt-0">
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($clientToView->proformas as $item)
                            <td>{{ $counter }}</td>
                            <?php $counter++ ?>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <a href="" class="btn btn-success">Print Proforma</a>
                            </td>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection