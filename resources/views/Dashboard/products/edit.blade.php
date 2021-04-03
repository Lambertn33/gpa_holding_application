@extends('Dashboard.layouts.Layout')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Edit {{ $productToEdit->name }} Product</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('productUpdate',$productToEdit->id) }}" method="POST">
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
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control border-2" name="productName" value="{{ $productToEdit->name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Product Price</label>
                                <input type="text" class="form-control border-2" name="productPrice" value="{{ $productToEdit->price }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product category</label>
                                 <select name="productCategory" class="form-control">
                                     <option selected disabled>Select Category...</option>
                                     @foreach ($allCategories as $item)
                                         <option selected="{{ $item->id === $productToEdit->id ? "true":"" }}" value="{{ $item->id }}">{{ $item->name }}</option>
                                     @endforeach
                                 </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Enter Product Details</label>
                                <textarea class="form-control border-2 text-center" rows="5" name="productDetails">
                                    {{ $productToEdit->details }}
                                </textarea>
                            </div>
                            <button class="btn btn-success" type="submit">Update Product</button>
                         </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
