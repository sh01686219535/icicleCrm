<!doctype html>
<html lang="en">
<style>
    @page {
        size: a4 landscape;
    }

</style>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Money Receipt</title>
</head>
<body>
    <div style="margin:50px auto;width:1000px;border:1px solid #ddd;padding:5px;border-radius:10px;">
        <div style="margin:0 0 30px 0">
            <div style="width: 20%;display:inline-block;margin-top:33px;">
                <img height="150px" width="150px" src="{{ asset('backend/img/logo.png')}}" alt="chuti.png">
            </div>
            <div style="width: 24%;display:inline-block;">
                <h3 style="font-size: 20px">MR No: {{ $investorPay->id ?? '' }}</h3>
            </div>
            <div style="width: 28%;margin:15px 0 0 0;display:inline-block;">
                <a style="background: #b5c720;
                    padding: 13px 29px;
                    font-size: 25px;
                    font-weight: 800;
                    color: #fff;
                    border-radius: 33px;
                    border: 3px solid darkgray;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">Money Receipt</a>
            </div>
            <div style="width: 24%;text-align:center;display:inline-block;">
                <h3 style="font-size: 20px">Date: {{ $investorPay->created_at->format('d-M-Y') }}</h3>
            </div>

        </div>
        <div style="margin:0 auto;width:88%;">
            <div>
                <p style="font-size: 20px;line-height:2;">Received with thanks form Mr/Ms <strong>@if ($investorPay->investor->name ?? 0){{ $investorPay->investor->name ?? 0}} @else ............................ @endif</strong> against Ownership Id/Membership<br>
                    No : <strong>@if ($investorPay->investor->serial_number ){{ $investorPay->investor->serial_number }} @else ............................ @endif</strong> File Number: <strong>@if ($investorPay->investor->fileNumber ){{ $investorPay->investor->fileNumber }} @else ............................ @endif</strong> Unit :<strong>@if ($investorPay->investor->no_ownership ){{ $investorPay->investor->no_ownership }} @else ............................ @endif</strong>Project of Chuti Resort Purbachal :<strong>@if ($investorPay->investor->project_name ){{ $investorPay->investor->project_name }} @else ........................................ @endif</strong><br>
                    Tk. <strong>@if ($investorPay->total ){{ $investorPay->total}} Tk. @else ............................ @endif</strong>as installment No. <strong>@if ($investorPay->number_installment_upcomming ){{ $investorPay->number_installment_upcomming }} @else ............................ @endif</strong>Date: <strong>@if ($investorPay->created_at ){{ $investorPay->created_at->format('d-M-Y')}} @else ............................ @endif</strong><br>
                    by Cash/ Cheque/ Online Payment : <strong>@if($investorPay->payment_type){{ $investorPay->payment_type }}@else.................
                        @endif</strong> Chq No : <strong>@if ($investorPay->chqNo){{ $investorPay->chqNo }}@else ............@endif</strong><br>
                    Bank : <strong>@if ($investorPay->bank_name ){{ $investorPay->bank_name}} @else ............................ @endif</strong> Branch : <strong>@if ($investorPay->branch_name ){{ $investorPay->branch_name}} @else ............................ @endif</strong><br>
                    Taka(Word) : <strong>@if ($investorPay->per_int_amount_word ){{ $investorPay->per_int_amount_word}} @else ............................ @endif</strong></p>
            </div>
        </div>
        <div style="margin:40px 0 5px 0">
            <div style="">
                <div style="width: 20%;display:inline-block;">
                    <hr>
                    <p style="font-size: 18px;font-weight: 600;margin-top:-5px;text-align:center">Prepared by</p>
                </div>
                <div style="width: 59%;display:inline-block;">
                    <p style="font-size: 16px;font-weight: 500;text-align:center">
                        This money receipt will be valid subject to encashment of Cheque/P.O/D.D etc.
                    </p>
                </div>
                <div style="width: 20%;display:inline-block;">
                    <hr>
                    <p style="font-size: 18px;font-weight: 600;margin-top:-5px;text-align:center">Authorised by</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
