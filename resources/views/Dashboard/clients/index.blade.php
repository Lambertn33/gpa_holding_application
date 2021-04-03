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
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">All Available Clients</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getNewClientRegistrationPage') }}"  class="btn btn-primary">Register New Client</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Client Names</th>
                                <th class="border-bottom-0">Client Tin</th>
                                <th class="border-bottom-0">Contact Name</th>
                                <th class="border-bottom-0">Address</th>
                                <th class="border-bottom-0">Phone No</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allClients as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->client_Names }}</td>
                                <td>{{ $item->Tin }}</td>
                                <td>{{ $item->contact_Names }}</td>
                                <td>{{ $item->Address }}</td>
                                <td>{{ $item->phone_No }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                  <a href="{{ route('clientEditPage',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <a href="{{ route('clientDeletion',$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
