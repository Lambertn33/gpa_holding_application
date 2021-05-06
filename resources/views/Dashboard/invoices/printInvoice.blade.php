<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Invoice</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card" id="card" style="border:none">
                    <div class="card-header" style="padding-bottom: 10px;
                    border-bottom:1px solid gray;
                     background-color:#fff;
                    ">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('/Images/LOGO_LARGE.JPG') }}" alt="">
                            </div>
                            <div class="col-md-6">
                                <span style="float: right;
                                 font-size:23px;
                                 font-weight:lighter
                                 ">GPA HOLDINGS Ltd</span>
                                <br>
                                <span style="float: right;
                                 margin-left:60px;
                                 font-size:15px;
                                 font-weight:lighter
                                ">
                                    PO Box: 5007 Kigali-Rwanda
                                 </span>
                                <br>
                                <span style="float: right;
                                 margin-left:45px;
                                 font-size:15px;
                                 font-weight:lighter
                                ">
                                Phones: +250 789905054
                                 </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6" style="float:left">
                                <div style="border-left:
                                 8px solid #000;
                                ">
                                    <div style="margin-left:6px">
                                        <span style="font-size:15px">INVOICE TO:</span>
                                        <br>
                                        <span style="font-size:20px;font-weight:lighter">
                                        <b>{{ $invoiceToPrint->client }}</b>
                                    </span>
                                        <br>
                                        <span style="font-size:20px;font-weight:lighter">
                                       TIN: <b>{{ $clientTin }}</b>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <span style="float:right;font-weight:lighter">
                                  Date of Invoice: {{ $invoiceToPrint->date }}
                              </span>
                                <br>
                                <span style="float:right;font-weight:lighter">
                                  Due date: {{ $invoiceDueDate }}
                              </span>
                                <br> @if($invoiceToPrint->status == "NOT PAID")
                                <span style="float:right" class="text-danger">
                                    <b>Status: Pending</b>
                                </span> @else
                                <span style="float:right" class="text-success">
                                    <b>Status: Paid</b>
                                </span> @endif
                            </div>
                        </div>
                        <div class="row" data-html2canvas-ignore="true">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right" id="print">PRINT</button>
                            </div>
                        </div>
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-12">
                                <span style='font-family: "Times New Roman", Times, serif;font-weight:lighter;'>Reference to your Purchasing Order, GPA Holdings Ltd invoices the following:</span>
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0" scope="col">#</th>
                                            <th class="border-bottom-0" scope="col">Product</th>
                                            <th class="border-bottom-0" scope="col">description</th>
                                            <th class="border-bottom-0" scope="col">quantity</th>
                                            <th class="border-bottom-0" scope="col">unit price</th>
                                            <th class="border-bottom-0" scope="col">total price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1 ?> @foreach ($invoiceToPrint->products as $product)
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
                                        <tr>
                                            <td colspan="5">Sub total (Vat Excl)</td>
                                            <td><b>{{ $totalAmountWithoutEightheenPercent }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">VAT (18%)</td>
                                            <td><b>{{ $eighteenPercent }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">Grand Total ( VAT INCL)</td>
                                            <td><b>{{ $invoiceToPrint->products->sum('pivot.total_cost') }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-6">
                                <div style="border:2px solid #000;
                                 padding-top:5px;
                                 padding-left:20px;
                                 border-radius:15px;
                                ">
                                    <span style="font-weight:lighter;">
                                       <b style="font-weight:bold"><u> Bank Details</u></b>
                                    </span>
                                    <br>
                                    <span style="font-weight:lighter;">
                                       <b style="font-weight:bold"> Branch Name:</b> Kigali Heights
                                    </span>
                                    <br>
                                    <span style="font-weight:lighter;">
                                       <b style="font-weight:bold"> Account Name:</b> GPA Holdings-AFRIKOA
                                    </span>
                                    <br>
                                    <span style="font-weight:lighter;">
                                       <b style="font-weight:bold"> Account Number:</b> 00261-06985608-50
                                    </span>
                                    <br>
                                    <span style="font-weight:lighter;">
                                       <b style="font-weight:bold"> Swift Code:</b> BKIGRWRW
                                    </span>
                                    <br>
                                    <br>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <span style="font-weight:bold;float:right;">
                                    Angelique Umutoni
                                 </span><br>
                                <span style="font-weight:bold;float:right;">
                                    Sales & Marketing Manager
                                 </span><br>
                                <span style="font-weight:bold;float:right;">
                                    GPA Holdings Ltd
                                 </span>

                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="margin-top:50px;border:2px solid grey; border-radius:15px;padding:7px;">
                                <div class="col-md-6">
                                    <span style="font-weight:lighter;float:left;">
                                        PO Box: 5007 Kigali-Rwanda
                                     </span><br>
                                    <span style="font-weight:lighter;float:left;">
                                        Kigali Heights 6th floor
                                     </span><br>
                                    <span style="font-weight:lighter;float:left;">
                                        Phones: +250 789905054
                                     </span>
                                </div>
                                <div class="col-md-6">
                                    <span style="font-weight:lighter;float:right;">
                                        gpaholdingsltd@gmail.com
                                     </span><br>
                                    <span style="font-weight:lighter;float:right;">
                                        Website: www.gpaholdingsltd.com
                                     </span><br>
                                    <span style="font-weight:lighter;float:right;">
                                        TIN/VAT: 107707503
                                     </span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script>
    window.onload = function() {
        document.getElementById('print').addEventListener('click', () => {
            let card = this.document.getElementById('card')
            var opt = {
                margin:       0,
                filename:     'invoice.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale:1 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
               };
            html2pdf().from(card).set(opt).save();
        })
    }
</script>

</html>
