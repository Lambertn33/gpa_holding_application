@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-6">
      <div class="card">
          <div class="card-header">
            <div class="card-title text-lg text-blue-500">View Invoice</div>
        </div>
        <div class="card-body pt-0">
              <button type="button" data-toggle="modal" data-target="#modal-form" class="btn btn-primary btn-sm"> Add More Products</button>
              <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content shadow border-0">
                        <div class="modal-body p-0">
                            <div class="mb-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center mb-4 h4">
                                        Add More Product to This Invoice
                                    </div>
                                    <form action="{{ route('addProductToExistingInvoice') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="invoiceId" value="{{  $invoiceToView->id }}">
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
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Quantity</label>
                                                <input type="number"  min="1" id="quantity"  class="form-control border-2" name="quantity" value="{{ old('quantity') }}">
                                            </div>
                                         </div>
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Unit Cost</label>
                                                <input type="number" readonly class="form-control border-2" id="unit_cost" name="unitCost" value="{{ old('unitCost') }}">
                                            </div>
                                         </div>
                                         <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Total Cost</label>
                                                <input type="text" class="form-control border-2" readonly id="total_cost" name="totalCost" value="{{ old('totalCost') }}">
                                            </div>
                                         </div>

                                        <div class="text-center">
                                            <button type="submit" id="submitBtn" class="btn ripple btn-primary my-4">Add Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- End of The Modal --}}
            <div class="table-responsive">
                <table  class="table table-bordered key-buttons text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-bottom-0">Client Names</th>
                            <th class="border-bottom-0">Status</th>
                            <th class="border-bottom-0">date</th>
                            <th class="border-bottom-0">Total</th>
                            <th class="border-bottom-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $invoiceToView->client }}</td>
                            <td>{{ $invoiceToView->status }}</td>
                            <td>{{ $invoiceToView->date }}</td>
                            <td>{{ $invoiceToView->products->sum('pivot.total_cost') }}</td>
                            @if($invoiceToView->status == "NOT PAID")
                             <td>

                                <button type="button" data-toggle="modal" data-target="#modal-payment" class="btn btn-success btn-sm">Make Invoice Paid</button>
                                                                      {{-- Start of The Modal --}}
            <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog  " role="document">
                    <div class="modal-content shadow border-0">
                        <div class="modal-body p-0">
                            <div class="mb-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <form action="{{ route('changeInvoiceStatus') }}" method="POST">
                                        <input type="hidden" name="_method" value="put">
                                        @csrf
                                        <input type="hidden" name="invoiceId" value="{{  $invoiceToView->id }}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Select Payment Status</label>

                                                    <select id="paymentStatus" name="paymentStatus" class="form-control">
                                                        <option selected disabled>Select Payment Status</option>
                                                        <option value="PAID BY CASH">PAID BY CASH</option>
                                                        <option value="PAID BY BANK">PAID BY BANK</option>
                                                        <option value="PAID BY MOBILE MONEY">PAID BY MOBILE MONEY</option>
                                                    </select>
                                                </div>
                                                @csrf
                                         </div>
                                        <div class="text-center">
                                            <button type="submit" id="payment_submit" class="btn ripple btn-success my-4">Make Invoice Paid</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- End of The Modal --}}
                             </td>
                             @else
                             <td>
                                <form action="{{ route('changeInvoiceStatus') }}" method="POST">
                                    <input type="hidden" name="_method" value="put">
                                    @csrf
                                    <input type="hidden" name="invoiceId" value="{{ $invoiceToView->id }}"/>
                                    <button type="submit" class="btn btn-danger btn-sm">make Invoice Unpaid</button>
                                </form>
                             </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('getAllInvoices') }}" class="btn btn-primary btn-sm">Back to Invoices</a>
                <br/>
                <br/>
            </div>
          </div>
      </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
              <div class="card-title text-lg text-blue-500">Invoice Details</div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Product</th>
                                <th class="border-bottom-0">description</th>
                                <th class="border-bottom-0">quantity</th>
                                <th class="border-bottom-0">unit price</th>
                                <th class="border-bottom-0">total price</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>

                        <?php $counter = 1 ?>
                        @foreach ($invoiceToView->products as $product)
                         <tr>
                            <td>{{ $counter }}</td>
                            <?php $counter++ ?>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->description }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->pivot->total_cost }}</td>
                            <td>
                                <form action="{{ route('deleteInvoiceItem') }}" method="post">
                                   @csrf
                                   <input type="hidden" name="productId" value="{{ $product->id }}">
                                   <input type="hidden" name="invoiceId" value="{{ $invoiceToView->id }}">
                                   <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                               <td>
                         </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#payment_submit').prop("disabled",true)
     $('#paymentStatus').change(function(){
        if($(this).val() !='NULL'){
           $('#payment_submit').prop("disabled",false)
        }
     })
        $('#quantity').prop("disabled",true);
        $('#submitBtn').prop("disabled",true);
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
                $('#submitBtn').prop("disabled",false);
                $('#quantity').val(1)
                $('#total_cost').val(result)
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
