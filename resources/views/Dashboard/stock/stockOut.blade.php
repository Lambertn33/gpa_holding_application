@extends('Dashboard.layouts.Layout')

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Stock Out for {{ $stock }}</div>

            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Quantity</th>
                                <th class="border-bottom-0">Client</th>
                                <th class="border-bottom-0">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allInvoicesContainingThisProduct as $item)
                            <tr>
                              @foreach ($item->products as $product)
                              <td>{{$product->pivot->quantity }}</td>
                              @endforeach
                               <td>{{$item->client }}</td>
                               <td>{{$item->date }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <a href="{{ route('getAllStock') }}" class="btn btn-primary">Back</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
