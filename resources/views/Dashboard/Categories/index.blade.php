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
    <div class="col-md-12 col-lg-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">All Available Categories</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getNewCategoryRegistrationPage') }}"  class="btn btn-primary">Register New Category</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Category Name</th>
                                <th class="border-bottom-0">Category Details</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allCategories as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->details }}</td>
                                <td>
                                  <a href="{{ route('categoryEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <a href="{{ route('categoryDeletion',$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
