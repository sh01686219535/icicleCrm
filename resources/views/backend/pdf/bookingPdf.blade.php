
<!doctype html>
<html lang="en">
    <style>
        @page{
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
                <h3 style="font-size: 20px">MR No: {{ $investor->fileName ?? '' }}</h3>
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
                <h3 style="font-size: 20px">Date: {{ $investor->created_at->format('Y-m-d') }}</h3>
            </div>

        </div>
        <div style="margin:0 auto;width:88%;">
            <div >
                <p style="font-size: 20px;line-height:2;">Received with thanks form Mr/Ms <strong>@if ($investor->name   ){{ $investor->name }} @else ............................ @endif</strong> against Ownership Id/Membership<br>
                No : <strong>@if ($investor->serial_number   ){{ $investor->serial_number }} @else ............................ @endif</strong> File Number @if ($investor->fileNumber   ){{ $investor->fileNumber }} @else ............................ @endif Unit :<strong>@if ($investor->no_ownership   ){{ $investor->no_ownership }} @else ............................ @endif</strong>Project of {{$investor->project_name}}<strong>@if ($investor->project_name)@else ........................................ @endif</strong><br>
                Tk.  <strong>@if ($investor->down_payment ){{ $investor->down_payment}} Tk. @else ............................ @endif</strong>as booking money<br>
               by Cash/ Cheque/ Online Payment <strong>@if($investor->payment_type2){{ $investor->payment_type2 }}@else.................
               @endif</strong> Date: <strong>@if ($investor->down_payment_date ){{ $date}}  @else ............................ @endif</strong><br>
               Bank : <strong>@if ($investor->bank_name ){{ $investor->bank_name}}  @else ............................ @endif</strong>       Branch : <strong>@if ($investor->branch_name ){{ $investor->branch_name}}  @else ............................ @endif</strong></strong>Chq No : <strong>@if ($investor->chq){{ $investor->chq }}@else ............@endif</strong><br>
                Taka(Word) : <strong>@if ($investor->down_payment_inWord ){{ $investor->down_payment_inWord}}  @else ............................ @endif</strong></p>
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
                <div  style="width: 20%;display:inline-block;">
                    <hr>
                    <p style="font-size: 18px;font-weight: 600;margin-top:-5px;text-align:center">Authorised by</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
