@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Register new Stock
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="alert alert-info  alert-dismissible fade show" role="alert">
                    <span><b>Note:</b>if the product hasn't been recorded before,it will require the supplier,buying price and entry date</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                         </button>
                </div>
                <form action="{{ route('NewStockRegistration') }}" method="POST">
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
                                <label class="form-label">Select Product</label>
                                 <select class="form-control" name="stockProduct" id="productChoice">
                                  <option value="" selected disabled>choose product..</option>
                                  @foreach ($allProducts as $item)
                                  <option value="{{ $item->name }}">{{ $item->name }}</option>
                                  @endforeach
                                 </select>
                                 @csrf
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Quantity</label>
                                <input type="text" class="form-control border-2" name="stockQuantity" value="{{ old('stockQuantity') }}">
                            </div>
                            <div id="newStock">
                                <div class="form-group">
                                    <label class="form-label">Select Supplier</label>
                                     <select class="form-control" name="stockSupplier">
                                      <option value="" selected disabled>choose supplier..</option>
                                      @foreach ($allSuppliers as $item)
                                      <option value="{{ $item->names }}">{{ $item->names}}</option>
                                      @endforeach
                                     </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Enter Buying Price</label>
                                    <input type="text" class="form-control border-2" name="stockBuyingPrice" value="{{ old('stockBuyingPrice') }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Select Entry date</label>
                                    <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control border-2" name="stockEntryDate" value="{{ old('stockEntryDate') }}">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Register New Stock</button>
                            <a href="{{ route('getAllStock') }}" class="btn btn-primary">Back</a>
                         </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     $(document).ready(function(){
        $('#quantity').prop("disabled",true);
        $('#newStock').hide();
        $('#productChoice').change(function(){
           var productId = $(this).val();
           var token = $('input[name="_token"]').val()
           $.ajax({
               url:"{{ route('checkIfProductExistsInStock') }}",
               type:"POST",
               data:{
               _token:token,
               productId:productId
               },
               success:function(result){
                if(result === "Doesn't Exist"){
                    $('#newStock').show();
                }else{
                    $('#newStock').hide();
                }
               }
           })

        })
    })
</script>

