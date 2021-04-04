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
                <div class="card-title text-lg text-blue-500">All Available Stock</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getNewStockRegistrationPage') }}"  class="btn btn-primary">Register New Stock</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Product Name</th>
                                <th class="border-bottom-0">Supplier Names</th>
                                <th class="border-bottom-0">Quantity</th>
                                <th class="border-bottom-0">Selling Price</th>
                                <th class="border-bottom-0">Buying Price</th>
                                <th class="border-bottom-0">Entry Date</th>
                                <th class="border-bottom-0">Entry By</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allStock as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->product }}</td>
                                <td>{{ $item->supplier }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->buying_price }}</td>
                                <td>{{ $item->date }}</td>
                                <td></td>
                                <td>
                                  <a href="{{ route('stockEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <a href="{{ route('stockDeletion',$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
