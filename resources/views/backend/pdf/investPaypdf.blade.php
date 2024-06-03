<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Invoice Print</title>
    <style>
        @page {
            sheet-size: A4;
            background-color: azure;
            vertical-align: top;
            margin-top: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-bottom: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-left: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-right: 0cm;
            /* <any of the usual CSS values for margins> */

            margin-header: 0;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0;
            /* <any of the usual CSS values for margins> */
            marks: none;
            /crop | cross | none/
        }

        @media print {

            .btn-print,
            .btn-pdf {
                display: none;
            }

            .signature-section {
                display: block;
            }

        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-baseline col-md-12 col-sm-12">
                            <div class="col-xl-9 col-md-9 col-sm-9">
                                 <img height="120px" width="150" src="{{ asset('backend/img/logo.png') }}" alt="" /> 
                            </div>
                            <hr>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-xl-8 col-md-7 col-sm-7 col-auto">
                                    <ul class="list-unstyled">
                                        <div style="width:55%;display:inline-block;">
                                            <li class="text-muted"><b>Investor ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $investor->serial_number  }}</li>
                                            <li class="text-muted"><b>File Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;{{ $investor->fileNumber  }}</li>
                                            <li class="text-muted"><b>Investor Name &nbsp;:&nbsp;</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->name  }}</li>
                                            <li class="text-muted"><b>Mobile No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->phone  }}</li>
                                            <li class="text-muted"><b>Project Name&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->project_name  }}</li>
                                            <li class="text-muted"><b>Project Address:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->project_address  }}</li>
                                            <li class="text-muted"><b>Total Unit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->no_ownership  }}</li>

                                        </div>
                                        <div style="width:38%;display:inline-block;">
                                            <li class="text-muted"><b>Total Installment &nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->no_of_installment  }}</li>
                                            <li class="text-muted"><b>Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><span style="color:#5d9fc5 ;"></span>{{ $investor->ownership_size  }}</li>
                                            <li class="text-muted"><b>Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->category_ownership  }}</li>
                                            <li class="text-muted"><b>Ins. per amount :</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->inst_per_month  }}Tk.</li>
                                            <li class="text-muted"><b>Total Price &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->agreed_price  }}Tk.</li>
                                            <li class="text-muted"><b>Discount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->special_discount  }}Tk.</li>
                                            <li class="text-muted"><b>Allow Amount &nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->allow_amount  }}Tk.</li>
                                            <li class="text-muted"><b>Main Amount &nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $investor->main_amount  }}Tk.</li>

                                        </div>

                                    </ul>

                                </div>


                            </div>
                            <div class="row my-2 justify-content-center">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-sm" style="border:1px solid #bfbfbf;">

                                        <thead class="text-white" style="border:1px solid #bfbfbf;background:#d7d7d7;">
                                            <tr>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Ins.No</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Payment Date</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">From Month</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">To Month</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Total</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Remarks</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Description </th>

                                        </thead>
                                        <tbody>
                                            <tr style="border:1px solid #bfbfbf;">
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{ \Carbon\Carbon::parse($investor->down_payment_date )->format('d-M-Y')}}
                                                </td>
                                                <td colspan="2" style="text-align:center;border:1px solid #bfbfbf; font-size:12px;">Booking Money</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{ $investor->down_payment }}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{ $investorPaid->description ?? '' }}</td>
                                            </tr>


                                            //ssskls
                                            <tr style="border:1px solid #bfbfbf;">

                                                @foreach ($investorPay as $investors )
                                                @if($investors->booking_money)
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>


                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{($investors->created_at->format('d-M-Y') )}}
                                                </td>
                                                <td colspan="2" style="text-align:center;border:1px solid #bfbfbf; font-size:12px;">Down Payment</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{ $investors->booking_money }}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                @endif
                                                @endforeach
                                            </tr>

                                            @php
                                            $totalAmount = 0;
                                            $totalExtraAmount = 0;


                                            function getMonthCountWithHyphen($startDate, $endDate) {
                                            $start = new DateTime($startDate);
                                            $end = new DateTime($endDate);

                                            $interval = $start->diff($end);

                                            $months = (($interval->y) * 12) + ($interval->m);

                                            $result = "";
                                            for ($i = 0; $i <= $months; $i++) { if ($i> 0) {
                                                $result .= "-";
                                                }
                                                $result .= $start->format('M Y');
                                                $start->modify('+1 month');
                                                }

                                                return $months+1;
                                                }

                                                @endphp



                                                @foreach($investorschedule as $investors)
                                                <tr style="border:1px solid #bfbfbf;">
                                                    <td style="border:1px solid #bfbfbf; font-size:12px;">
                                                        @php
                                                        $startMonth = $investors->start_month;
                                                        $endMonth = $investors->end_month;
                                                        $result = getMonthCountWithHyphen($startMonth, $endMonth);
                                                        $prevpay=APP\MODELS\InvestorPay::where('id', '<', $investors->id)->orderBy('id','desc')->first();

                                                            if($prevpay)
                                                            {
                                                            $previnstallment=$prevpay->number_installment_upcomming;

                                                            }else{
                                                            $previnstallment=0;
                                                            }


                                                            $invcount=APP\MODELS\InvestorPay::where('id', '<', $investors->id)->orderBy('id','desc')->count();
                                                                if($invcount==0){
                                                                for ($i = 1; $i <= $result; $i++) { if ($i>1 && $i < $result) { continue; } echo $i; if ($i < $result) { echo "-" ; } } } else{ for ($i=$previnstallment+1; $i <=$result+$previnstallment; $i++) { if ($i>$previnstallment+1 && $i < $result+$previnstallment) { continue; } echo $i; if ($i < $result+$previnstallment) { echo "-" ; } } } @endphp </td>

                                                    <td style="border:1px solid #bfbfbf; font-size:12px;">{{ $investors->created_at->format('d-M-Y') }}
                                                    </td>

                                                    <td style="border:1px solid #bfbfbf; font-size:12px;"> {{ \Carbon\Carbon::parse($investors->start_month)->format('M-Y') }}</td>
                                                    <td style="border:1px solid #bfbfbf; font-size:12px;"> {{ \Carbon\Carbon::parse($investors->end_month)->format('M-Y') }}</td>
                                                    <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->total}}</td>
                                                    <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->extra_pay}}</td>
                                                    <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->description}}</td>
                                                </tr>
                                                @php
                                                $totalAmount += $investors->total;
                                                $totalExtraAmount +=$investors->extra_pay;
                                                @endphp
                                                @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">Total Amount</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"> = {{$totalAmount}}Tk.</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">= {{ $totalExtraAmount }}Tk.</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                            </tr>
                                        </tfoot>

                                        <tfoot>
                                            <tr>
                                                <td colspan="3" style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">Total Amount with Booking money</td>

                                                <td style="border:1px solid #bfbfbf; font-size:12px;"> = {{$totalAmount + $investor->down_payment + $test ?? ''}}Tk.</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>
                                                <!-- {{$totalExtraAmount + $investor->down_payment + $test}}Tk. -->
                                                <td style="border:1px solid #bfbfbf; font-size:12px;"></td>

                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                            <div style="width: 800px;margin: 0 auto;">
                                <div class="text" style="margin-top:80px;">
                                    <div style="float:left;width:200px;text-align:center;">
                                        <hr style="font-size:14px;">
                                        <h5 style="font-size:14px;">Applicant Signature</h5>
                                    </div>
                                    <div class=" " style="float:right;width:170px;text-align:center;margin-right:80px;">
                                        <hr style="font-size:14px;">
                                        <h5 style="font-size:14px; text-align:center">Authorised Signature</h5>
                                    </div>
                                </div>
                                <div class="footer text-align:center " style="margin-top:10px;">
                                    <div style="text-align: center">
                                        <div colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                                            <strong style="display:block;margin:0 0 10px 0;"></strong>
                                            <b>Address: Millenium Castle, Level: 07, House:47, Road:27, Block:A, Banani , Dhaka-1213.</b> <br> <b>Phone: 01401102144. Email:crm@chutibd.com</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
</body>

</html>