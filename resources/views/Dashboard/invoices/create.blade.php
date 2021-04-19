@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Register new Invoice</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('NewInvoiceRegistration') }}" method="POST">
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
                                <label class="form-label">Select Client</label>
                                <select name="client" class="form-control">
                                    <option selected disabled>Select Client...</option>
                                    @foreach ($allClients as $item)
                                    <option value="{{ $item->client_Names }}">{{ $item->client_Names }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Select Product</label>
                                <select name="product" class="form-control">
                                     <option selected disabled>Select Product...</option>
                                     @foreach ($allProducts as $item)
                                     <option value="{{ $item->name }}">{{ $item->name }}</option>
                                     @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Enter Invoice Description</label>
                                    <textarea class="form-control border-2" rows="3" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" oninput="handleValueChange()" min="0" id="quantity" class="form-control border-2" name="quantity" value="{{ old('quantity') }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Unit Cost</label>
                                    <input type="number" class="form-control border-2" min="0" oninput="handleValueChange()" min="0" id="unit_cost" name="unitCost" value="{{ old('unitCost') }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Total Cost</label>
                                    <input type="text" class="form-control border-2" readonly id="total_cost" name="totalCost" value="{{ old('totalCost') }}">
                                </div>
                                <button class="btn btn-primary" type="submit">Register New Invoice</button>
                            </div>
                        </div>
                    </div>
                </form>
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

