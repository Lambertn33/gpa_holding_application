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
                                <th class="border-bottom-0">Product Name</th>
                                <th class="border-bottom-0">Supplier Names</th>
                                <th class="border-bottom-0">Available Quantity</th>
                                <th class="border-bottom-0">Selling Price</th>
                                <th class="border-bottom-0">Buying Price</th>
                                <th class="border-bottom-0">Entry Date</th>
                                <th class="border-bottom-0">Entry By</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allStock as $item)
                            <tr>
                                <td>{{ $item->product }}</td>
                                <td>{{ $item->supplier }}</td>
                                <td>{{ $item->remainingQuantity }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->buying_price }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->entry_by }}</td>
                                <td>
                                  <a href="{{ route('stockEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <a href="{{ route('stockDeletion',$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                  <a href="" href="#" data-toggle="modal" data-target="#modal-view-{{$item->id}}" class="btn btn-info btn-sm">In</a>
                                  <a href="{{ route('checkStockOut',$item->id) }}" class="btn btn-success btn-sm">Out</a>
                                  <div id="modal-view-{{$item->id}}" class="modal fade">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header pd-x-20">
                                                <h6 class="modal-title">Stock In Record for {{ $item->product }}</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pd-20">
                                              <div class="table-responsive">
                                                <table  class="table table-bordered  text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">Recorded Quantity</th>
                                                            <th class="border-bottom-0">Recorded Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $counter = 1 ?>
                                                          @foreach ($item->stock_records as $record)
                                                          <tr>
                                                            <td>{{ $counter }}</td>
                                                            <?php $counter++ ?>
                                                            <td>{{ $record->recorded_quantity }}</td>
                                                            <td>{{ $record->date }}</td>
                                                          </tr>
                                                          @endforeach
                                                    </tbody>
                                                </table>
                                                <h4>Total:{{ $item->stock_records->sum('recorded_quantity') }}</h4>
                                              </div>
                                            </div><!-- modal-body -->
                                        </div>
                                    </div><!-- modal-dialog -->
                                </div>
                                <input type="hidden" name="id" value={{ $item->id }}>
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

