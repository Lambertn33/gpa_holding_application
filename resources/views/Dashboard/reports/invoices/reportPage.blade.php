<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoices Report</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1" style="padding:20px" id="card">
                <div class="card"  style="border:2px solid #000">
                    <div class="card-header" style="padding-bottom: 10px;
                    border-bottom:1px solid gray;
                     background-color:#fff;
                    ">
                     @php
                    $message="";
                    if($year && !$month ){
                        $message = 'Invoices Report of the Year '. $year .'';
                    }elseif($year && $month){
                        switch ($month) {
                            case '01':
                                 $monthInWords = 'January';
                                break;
                            case '02':
                                 $monthInWords = 'February';
                                break;
                            case '03':
                                 $monthInWords = 'March';
                                break;
                            case '04':
                                 $monthInWords = 'April';
                                break;
                            case '05':
                                 $monthInWords = 'May';
                                break;
                            case '06':
                                 $monthInWords = 'June';
                                break;
                            case '07':
                                 $monthInWords = 'July';
                                break;
                            case '08':
                                 $monthInWords = 'August';
                                break;
                            case '09':
                                 $monthInWords = 'September';
                                break;
                            case '10':
                                 $monthInWords = 'October';
                                break;
                            case '11':
                                 $monthInWords = 'November';
                                break;
                            case '12':
                                 $monthInWords = 'December';
                                break;

                            default:
                                # code...
                                break;
                        }
                        $message = 'Invoices Report of the Period of '. $monthInWords .' '. $year .'';
                    }elseif($startingDate && $endingDate)
                    $message = 'Invoices Report of the Period from '. $startingDate .' to '. $endingDate .'';

                     @endphp
                      <div class="row">
                          <div class="col-md-3">
                            <img src="{{ url('/Images/LOGO.JPG') }}" alt="">
                          </div>
                          <div class="col-md-9">
                            <h5 class="text-center" style="margin-top:8px">{{ $message }}</h5>
                          </div>
                      </div>
                    </div>
                    <div class="card-body">
                        @if (count($invoiceToReport) > 0)
                        <div class="row" data-html2canvas-ignore="true">
                            <div class="col-md-12">
                                <button class="btn btn-primary float-right" id="print">PRINT</button>
                            </div>
                        </div>
                        @endif
                        <div class="row" style="margin-top:50px">
                            <div class="col-md-12">
                                <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0" scope="col">#</th>
                                            <th class="border-bottom-0" scope="col">Client</th>
                                            <th class="border-bottom-0" scope="col">Date</th>
                                            <th class="border-bottom-0" scope="col">Status</th>
                                            <th class="border-bottom-0" scope="col">Total Cash()</th>
                                            <th class="border-bottom-0" scope="col">VAT()</th>
                                            <th class="border-bottom-0" scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 1 ?>
                                        <?php $principalTotal = 0?>
                                        <?php $principalTax = 0?>
                                        <?php $principalSubTotal = 0?>
                                        @foreach ($invoiceToReport as $report)
                                        @php
                                           $grandTotalAmount = $report->products()->sum('total_cost');
                                           $eighteenPercent = round($grandTotalAmount * 0.18);
                                           $totalAmount = $grandTotalAmount - $eighteenPercent;
                                           $principalTotal = $principalTotal + $grandTotalAmount;
                                           $principalSubTotal = $principalSubTotal + $totalAmount;
                                           $principalTax = $principalTax + $eighteenPercent;
                                       @endphp
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <?php $counter++ ?>
                                            <td>{{ $report->client }}</td>
                                            <td>{{ $report->date }}</td>
                                            <td>{{ $report->status }}</td>
                                            <td>{{ $totalAmount }}</td>
                                            <td>{{ $eighteenPercent }}</td>
                                            <td>{{ $grandTotalAmount }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Total</td>
                                            <td><b>{{ $principalSubTotal }}</b></td>
                                            <td><b>{{ $principalTax }}</b></td>
                                            <td><b>{{ $principalTotal }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
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
                filename:     'invoice_report.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale:1 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
               };
            html2pdf().from(card).set(opt).save();
        })
    }
</script>

</html>
