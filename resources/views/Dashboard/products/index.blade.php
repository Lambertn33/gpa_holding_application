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
    <div class="col-md-12 col-lg-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">All Available Products</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getNewProductRegistrationPage') }}"  class="btn btn-primary">Register New Product</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Product Name</th>
                                <th class="border-bottom-0">Product Details</th>
                                <th class="border-bottom-0">Product Price</th>
                                <th class="border-bottom-0">Product Category</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allProducts as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->details }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                  <a href="{{ route('productEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <a href="{{ route("productDeletion",$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
