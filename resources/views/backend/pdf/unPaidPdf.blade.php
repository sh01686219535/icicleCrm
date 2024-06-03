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

                            <div class="row my-2 justify-content-center">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-sm" style="border:1px solid #bfbfbf;">
                                        <thead  class="text-white" style="border:1px solid #bfbfbf;background:#d7d7d7;">
                                            <tr>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Serial No</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Phone</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">No. of Ownership</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Agreed Price</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Main Amount</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">No of Installment</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">From Month</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">To Month</th>
                                                <th style="border:1px solid #bfbfbf; font-size:12px;">Inst per month</th>

                                        </thead>
                                        <tbody>
                                            @php
                                            $totalInstPerAmount = 0;
                                            @endphp
                                            @foreach($investorPay as $investors)
                                            <tr style="border:1px solid #bfbfbf;">
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->serial_number}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->phone}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->no_ownership}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->agreed_price}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->main_amount}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->no_of_installment}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->start_from}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->start_to}}</td>
                                                <td style="border:1px solid #bfbfbf; font-size:12px;">{{$investors->inst_per_month}}</td>
                                            </tr>
                                            @php
                                            $totalInstPerAmount += $investors->inst_per_month;
                                            @endphp
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" style="border:1px solid #bfbfbf; font-size:12px;">Total Unpaid Amount</td>
                                                <td colspan="2" style="border:1px solid #bfbfbf; font-size:12px;">Total = {{$totalInstPerAmount}}Tk.</td>
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
                                            <b>Address: Galan, Rathura, Purbachal New Town. </b>
                                            <b>Phone: 01401102144. </b>
                                            <b>Email: crm@chutibd.com</b>
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