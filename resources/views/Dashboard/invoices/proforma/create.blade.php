@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">{{ $clientToMakeProforma->client->client_Names }} Proforma </div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('NewProformaRegistration') }}" method="POST">
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
                        <input type="hidden" name="clientId" value="{{ $clientToMakeProforma->id }}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Client</label>
                                 <input class="form-control border-2" type="text" name="" value="{{ $clientToMakeProforma->client->client_Names }}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Date</label>
                                 <input class="form-control border-2" type="text" name="" value="{{ $clientToMakeProforma->date }}" readonly>

                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Product</label>
                                <select name="product" class="form-control">
                                     <option selected disabled>Select Product...</option>
                                     @foreach ($allProducts as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                    </select>
                             </div>
                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Enter Proforma Description</label>
                                <textarea class="form-control border-2" rows="3" name="description"></textarea>
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Quantity</label>
                                <input type="number" oninput="handleValueChange()" min="0" id="quantity" class="form-control border-2" name="quantity" value="{{ old('quantity') }}">
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Unit Cost</label>
                                <input type="number" class="form-control border-2" min="0" oninput="handleValueChange()" min="0" id="unit_cost" name="unitCost" value="{{ old('unitCost') }}">
                            </div>
                         </div>
                         <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Cost</label>
                                <input type="text" class="form-control border-2" readonly id="total_cost" name="totalCost" value="{{ old('totalCost') }}">
                            </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" type="submit">Add to Proforma</button>
                        <a href="{{ route('confirmProforma',$clientToMakeProforma->id) }}" class="btn btn-success btn-sm">Confirm Proforma</a>
                        <br>
                        <a href="{{ route('deleteProforma',$clientToMakeProforma->id) }}" class="btn btn-danger btn-sm">Delete Proforma</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <div class="col-md-8">
       <div class="card">
        <div class="card-header">
            <div class="card-title text-lg text-blue-500">Proforma Records</div>

        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table id="example" class="table table-bordered  text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">#</th>
                            <th class="border-bottom-0">Product Name</th>
                            <th class="border-bottom-0">Quantity</th>
                            <th class="border-bottom-0">Unit Cost</th>
                            <th class="border-bottom-0">Total Cost</th>
                            <th class="border-bottom-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1 ?>
                        @foreach ($clientToMakeProforma->products as $item)
                        <tr>
                            <td>{{ $counter }}</td>
                            <?php $counter++ ?>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>{{ $item->pivot->unit_cost }}</td>
                            <td>{{ $item->pivot->total_cost }}</td>
                            {{-- <td>
                             <form action="{{ route('deleteInvoiceItem') }}" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $item->id }}">
                                <input type="hidden" name="invoiceId" value="{{ $clientToMakeInvoice->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                             </form>
                            <td> --}}
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <br>
                <h4>Grand Total : {{ $clientToMakeProforma->products->sum('pivot.total_cost') }}</h4>
            </div>
        </div>
       </div>
     </div>
</div>
<script>
    document.getElementById('unit_cost').value = 0
    document.getElementById('quantity').value = 0
    document.getElementById('total_cost').value = parseInt(document.getElementById('unit_cost').value) * parseInt(document.getElementById('quantity').value)
    function handleValueChange(){
        var unitCost= unit_cost.value
        var Quantity= quantity.value
        var totalCost = parseInt(unitCost) * parseInt(Quantity)
        if(Number.isNaN(totalCost)){
            totalCost = 0
        }
        document.getElementById('total_cost').value = totalCost
    }
</script>
@endsection

