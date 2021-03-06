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
                <div class="card-title text-lg text-blue-500">All Available Proforma</div>

            </div>
            <div class="card-body pt-0">
                <a href="{{ route('getClientToMakeProforma') }}" class="btn btn-primary">Add New Proforma</a>
                <br>
                <br>
                <div class="table-responsive">
                    <table id="example" class="table table-bordered key-buttons text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">Client Names</th>
                                <th class="border-bottom-0">date</th>
                                <th class="border-bottom-0">status</th>
                                <th class="border-bottom-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1 ?>
                            @foreach ($allProformas as $item)
                            <tr>
                                <td>{{ $counter }}</td>
                                <?php $counter++ ?>
                                <td>{{ $item->client->client_Names }}</td>
                                 <td>{{ $item->date }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if($item->status == "NOT PAID")


                                    <button type="button" data-toggle="modal" data-target="#modal-payment" class="btn btn-success btn-sm">Make Proforma Paid</button>
                                                                          {{-- Start of The Modal --}}
                <div class="modal fade" id="modal-payment" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog  " role="document">
                        <div class="modal-content shadow border-0">
                            <div class="modal-body p-0">
                                <div class="mb-0">
                                    <div class="card-body px-lg-5 py-lg-5">
                                        <form action="{{ route('changeProformaStatus') }}" method="POST">
                                            <input type="hidden" name="_method" value="put">
                                            @csrf
                                            <input type="hidden" name="proformaId" value="{{  $item->id }}">
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
                                                <button type="submit" id="payment_submit" class="btn ripple btn-success my-4">Make Proforma Paid</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- End of The Modal --}}

                                 @else

                                 <span>
                                     <?php $form_class = $item->id ?>
                                     <a href="" onclick="var result = confirm('Are you sure you want to Make This proforma Unpaid?'); if( result ){ event.preventDefault(); document.getElementById('{{ $form_class }}').submit(); }" class="btn btn-info btn-sm">make Proforma Unpaid
                                     </a>
                                    <form id="{{ $form_class }}" style="display: none" action="{{ route('changeProformaStatus') }}" method="POST">
                                        <input type="hidden" name="_method" value="put">
                                        @csrf
                                        <input type="hidden" name="proformaId" value="{{ $item->id }}"/>
                                    </form>
                                 </span>

                                @endif
                                    <a href="{{ route('viewProforma',$item->id) }}" class="btn btn-primary btn-sm">view<a>
                                    <a href="{{ route('deleteProforma',$item->id) }}" class="btn btn-danger btn-sm">delete<a>
                                     <a href="{{ route('changeProformaToInvoice',$item->id) }}" class="btn btn-warning btn-sm">Make Invoice<a>
                                     <a href="{{ route('printProformaPDF',$item->id) }}" target="_blank" class="btn btn-info btn-sm">print<a>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
     $('#payment_submit').prop("disabled",true)
     $('#paymentStatus').change(function(){
        if($(this).val() !='NULL'){
           $('#payment_submit').prop("disabled",false)
        }
     })
    })
</script>

