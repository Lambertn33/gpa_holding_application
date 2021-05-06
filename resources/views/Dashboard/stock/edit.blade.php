@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Edit Stock</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('stockUpdate',$stockToEdit->id) }}" method="POST">
                    <input type="hidden" name="_method" value="put">
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
                                 <select class="form-control" name="stockProduct">
                                  <option value="" selected disabled>choose product..</option>
                                  @foreach ($allProducts as $item)
                                  <option selected="{{ $stockToEdit->product === $item->name ? "true":"false" }}" value="{{ $item->name }}">{{ $item->name }}</option>
                                  @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Select Supplier</label>
                                 <select class="form-control" name="stockSupplier">
                                  @foreach ($allSuppliers as $item)
                                  <option selected="{{ $stockToEdit->supplier === $item->names ? "true":"false" }}" value="{{ $item->names }}">{{ $item->names}}</option>
                                  @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Buying Price</label>
                                <input type="text" class="form-control border-2" name="stockBuyingPrice" value="{{ $stockToEdit->buying_price }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Select Entry date</label>
                                <input type="date" max="<?php echo date("Y-m-d"); ?>" class="form-control border-2" name="stockEntryDate" value="{{ $stockToEdit->date }}">
                            </div>
                            <button class="btn btn-success" type="submit">Update Stock</button>
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
