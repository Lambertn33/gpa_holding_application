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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Proforma Reports</div>

            </div>
            <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Period</label>
                                <select id="periodChoice" class="form-control">
                                    <option selected disabled>select Period</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>

                                </select>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" id="weeklyReport" style="display:none">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Weekly Reports</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('queryProformasReport') }}" method="POST" target="_blank">
                    @csrf
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="form-label">Starting date</label>
                            <input type="date" name="startingDate" class="form-control" max="<?php echo date('Y-m-d')?>"  required>
                         </div>
                      </div>
                             <button class="btn btn-primary">Check Reports</button>
                            </div>
                        </div>
                    </form>
            </div>

        <div class="card" id="monthlyReport" style="display:none">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Monthly Reports</div>

            </div>
            <div class="card-body pt-0">
                <form action="{{ route('queryProformasReport') }}" method="POST" target="_blank">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Select the Month</label>
                                <select name="month" class="form-control">
                                    <option selected disabled>Select Month...</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>

                                </select>
                             </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="form-label">Enter The Year</label>
                            <input type="number" class="form-control" min="1990" max="<?php echo date('Y')?>" placeholder="enter the year eg 2021" name="year" required>
                         </div>
                      </div>
                             <button class="btn btn-primary">Check Reports</button>
                            </div>
                        </div>
                    </form>
            </div>
        <div class="card" id="yearlyReport" style="display:none">
            <div class="card-header">
                <div class="card-title text-lg text-blue-500">Yearly Reports</div>

            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('queryProformasReport') }}" method="POST" target="_blank">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Enter The Year</label>
                                <input type="number" class="form-control" min="1990" max="<?php echo date('Y')?>" placeholder="enter the year eg 2021" name="year" required>
                             </div>
                             <button class="btn btn-primary">Check Reports</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
         $('#periodChoice').change(function(){
             if($(this).val() == "weekly"){
                 $('#weeklyReport').css("display","block")
                 $('#monthlyReport').css("display","none")
                 $('#yearlyReport').css("display","none")
             }else if($(this).val() == "monthly"){
                 $('#weeklyReport').css("display","none")
                 $('#monthlyReport').css("display","block")
                 $('#yearlyReport').css("display","none")

             }
             else if($(this).val() == "yearly"){
                 $('#weeklyReport').css("display","none")
                 $('#monthlyReport').css("display","none")
                 $('#yearlyReport').css("display","block")

             }
         })
    });
</script>
