<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('Dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-header" style="background-color:#fff;color:gray;">
            <div class="" style="float: right">
                <h4>GPA HOLDINGS Ltd</h4>
                <br>
                <span>PO Box: 5007 Kigali-Rwanda</span>
                <br>
                <span>Phone: +250 789905054</span>
            </div>
      </div>
      <br>
      <hr>
      <br>
      <div style="margin-top: 15%">
        <div class="" style="float: left">
            <h4>Invoice To:{{ $invoiceToPrint->client }}</h4>
        </div>
        <div class="" style="float: right">
            <span>Date of Invoice:{{ $invoiceToPrint->date }}</span>
            <br>
            @if($invoiceToPrint->status ==="PAID")
            <span class="text-success">Status:<b>Completed</b></span>
            @else
            <span class="text-danger">Status:<b>Pending</b></span>
            @endif
        </div>
      </div>

      <br>
  </div>
  <br><br><br>
  <table class="table table-bordered key-buttons text-nowrap">
    <thead>
        <tr>
            <th class="border-bottom-0">#</th>
            <th class="border-bottom-0">Product</th>
            <th class="border-bottom-0">description</th>
            <th class="border-bottom-0">quantity</th>
            <th class="border-bottom-0">unit price</th>
            <th class="border-bottom-0">total price</th>
        </tr>
    </thead>

    <?php $counter = 1 ?>
    @foreach ($invoiceToPrint->products as $product)
     <tr>
        <td>{{ $counter }}</td>
        <?php $counter++ ?>
        <td>{{ $product->name }}</td>
        <td>{{ $product->pivot->description }}</td>
        <td>{{ $product->pivot->quantity }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->pivot->total_cost }}</td>
     </tr>
    @endforeach
</table>
</body>
<script src="{{ public_path('Dashboard/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ public_path('Dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

</html>
