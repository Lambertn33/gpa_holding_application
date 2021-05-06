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
                <div class="card-title text-lg text-blue-500">All Available Receipts</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getClientToMakeReceipt') }}" class="btn btn-primary">Add New Receipt</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Client Names</th>
                                <th class="border-bottom-0">date</th>
                                <th class="border-bottom-0">Total</th>
                                <th class="border-bottom-0">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allReceipts as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->client }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->products->sum('pivot.total_cost') }}</td>
                                <td>
                                    <a href="{{ route('viewReceipt',$item->id) }}" class="btn btn-primary btn-sm">view<a>
                                    <a href="{{ route('deleteReceipt',$item->id) }}" class="btn btn-danger btn-sm">delete<a>
                                        <a href="{{ route('printReceiptPDF',$item->id) }}" target="_blank" class="btn btn-info btn-sm">print<a>
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
