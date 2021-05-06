@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">{{ $clientToMakeInvoice->client }} Invoice </div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('NewInvoiceRegistration') }}" method="POST">
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
                        <input type="hidden" name="clientId" value="{{ $clientToMakeInvoice->id }}">
                        <input type="hidden" name="remainingStock" id="remainingStock">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Client</label>
                                 <input class="form-control border-2" type="text" name="" value="{{ $clientToMakeInvoice->client }}" readonly>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Date</label>
                                 <input class="form-control border-2" type="text" name="" value="{{ $clientToMakeInvoice->date }}" readonly>

                            </div>
                        </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Product</label>

                                    <select name="product" class="form-control" id="productChoice">
                                        <option selected disabled>Select Product...</option>
                                        @foreach ($allProducts as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @csrf
                         </div>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Enter Invoice Description</label>
                                <textarea class="form-control border-2" rows="3" name="description"></textarea>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Quantity</label>
                                <input type="number"  min="1" id="quantity"  class="form-control border-2" name="quantity" value="{{ old('quantity') }}">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Unit Cost</label>
                                <input type="number" readonly class="form-control border-2" id="unit_cost" name="unitCost" value="{{ old('unitCost') }}">
                            </div>
                         </div>
                         <span class="text-danger" style="margin-left:10px" id="remainingQuantity"></span>
                         <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Total Cost</label>
                                <input type="text" class="form-control border-2" readonly id="total_cost" name="totalCost" value="{{ old('totalCost') }}">
                            </div>
                         </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-sm" type="submit">Add to Invoice</button>
                        <a href="{{ route('confirmInvoice',$clientToMakeInvoice->id) }}" class="btn btn-success btn-sm">Confirm Invoice</a>
                        <br>
                        <a href="{{ route('deleteInvoice',$clientToMakeInvoice->id) }}" class="btn btn-danger btn-sm">Delete Invoice</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <div class="col-md-8">
       <div class="card">
        <div class="card-header">
            <div class="card-title text-lg text-blue-500">Invoice Records</div>

        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered  text-nowrap">
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
                        @foreach ($clientToMakeInvoice->products as $item)
                        <tr>
                            <td>{{ $counter }}</td>
                            <?php $counter++ ?>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>{{ $item->pivot->unit_cost }}</td>
                            <td>{{ $item->pivot->total_cost }}</td>
                            <td>
                             <form action="{{ route('deleteInvoiceItem') }}" method="post">
                                @csrf
                                <input type="hidden" name="productId" value="{{ $item->id }}">
                                <input type="hidden" name="invoiceId" value="{{ $clientToMakeInvoice->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                             </form>
                            <td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <br>
                <h4>Grand Total : {{ $clientToMakeInvoice->products->sum('pivot.total_cost') }}</h4>
            </div>
        </div>
       </div>
     </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#quantity').prop("disabled",true);
        $('#productChoice').change(function(){
           var productId = $(this).val();
           var token = $('input[name="_token"]').val()
           $.ajax({
               url:"{{ route('saveProductToMakeInvoice') }}",
               type:"POST",
               data:{
               _token:token,
               productId:productId
               },
               success:function(result){
                $('#unit_cost').val(result)
                $('#quantity').prop("disabled",false);
                $('#quantity').val(1)
                $('#total_cost').val(result)
               }
           })
           $.ajax({
               url:"{{ route('checkStockAvailability') }}",
               type:"POST",
               data:{
               _token:token,
               productId:productId
               },
               success:function(result){
                $('#remainingQuantity').html('remaining quantity ' + result)
                $('#remainingStock').val(result)
               }
           })

        })
        $('#quantity').on('input',function(){
            var quantity = $(this).val()
            var unit_price = $('#unit_cost').val()
            var total = parseInt(quantity * unit_price)
            $('#total_cost').val(total)
        })
    })
</script>
