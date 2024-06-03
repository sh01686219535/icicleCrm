@extends('backend.partials.app')
@push('css')
<style>
    .bacground {
        background: beige;
    }

    /* .dashboar_box {
        background: #b90172;


    } */
    h3,
    span {
        color: #fff;
    }

    .mainbtn {
        width: 80px;
        height: 80px;
        background: #30cb97;
        border-radius: 11px;
        text-align: center;
        display: inline-block;
    }

    .icon_sus {
        display: inline-block;
        font-size: 44px;
        color: #601111;
    }

    .text_btn {
        padding: 5px 78px;
        margin: 18px 0 0 0;
    }
</style>
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y ">
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12 order-1">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #d65b09">
                            <a href="{{route('investorList')}}">
                                <span>Total Client</span>
                                <h3 class="card-title text-nowrap mb-1">{{ $investor }} Person</h3>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ml-5">
                    <div class="card">
                        <div class="card-body" style="background: #15d5d5">
                            <span>Total Booking Money</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $bookingMoney }} Tk.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ml-5">
                    <div class="card">
                        <div class="card-body" style="background: #454645">
                            <span>Booking Money in </strong>{{ $currentMonthName }}</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $bookingMoneyMonthly }} Tk.</h3>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #018012">
                            <span>Total Receivable</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $totalAmount }} Tk.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #008c91">
                            <span>Total Revenue</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $totalIncome }} Tk.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #ce2b02">
                            <span>Total Due</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $total_unpaid }} Tk.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #013cb9">
                            <span>Receivable In <strong>{{ $currentMonthName }}</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $investors }} Tk.</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mb-4">
                    <div class="card">
                        <div class="card-body" style="background: #8501b9">
                            <span>Revenue In <strong>{{ $currentMonthName }}</strong></span>
                            <h3 class="card-title text-nowrap mb-1">{{ $monthlyPaid }} Tk.</h3>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4 col-6 ">
                    <div class="card">
                        <div class="card-body" style="background: #b90172">
                            <a href="{{route('unpaidInvestor')}}">
                                <span>Unpaid In <strong>{{ $currentMonthName }}</strong></span>
                                <h3 class="card-title text-nowrap mb-1">{{ $monthlyUnpaid }} Tk.</h3>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn">
                                <a href="{{ route('lead') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-street-view"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">Suspect</h6>
                            <a href="{{ route('lead') }}" class="btn btn-info text_btn">{{ $lead }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn" style="background:#1dc332 !important">
                                <a href="{{ route('active.suspect.list') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-hand-pointer"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">Active Prospect</h6>
                            <a href="{{ route('active.suspect.list') }}" class="btn btn-info text_btn">{{ $sglLead }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn" style="background: #d4df27">
                                <a href="{{ route('client.suspect.list') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-exchange-alt"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">Prospect to Client</h6>
                            <a href="{{ route('client.suspect.list') }}" class="btn btn-info text_btn">{{ $clientList }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn" style="background: #eb7fff !important">
                                <a href="{{ route('mpl.list') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-tasks"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">MPL</h6>
                            <a href="{{ route('mpl.list') }}" class="btn btn-info text_btn">{{ $mplLead }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 my-4" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn" style="background:#e59736">
                                <a href="{{ route('sgl.list') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-user-ninja"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">SGL</h6>
                            <a href="{{ route('sgl.list') }}" class="btn btn-info text_btn">{{ $sglLead }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xl-3 my-4" style="text-align:
                center">
                    <div class="card">
                        <div class="card-body">
                            <div class="mainbtn" style="background: #d12727 !important">
                                <a href="{{ route('junk.suspect.list') }}" class="icon_sus" style="color: #fff !important"><i class="fas fa-times-circle"></i></a>
                            </div>
                            <h6 style="margin:10px 0 0 0 ">Junk Prospect</h6>
                            <a href="{{ route('junk.suspect.list') }}" class="btn btn-info text_btn">{{$junkLead}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 my-4" style="text-align:
                center">

                    <div class="card">
                        <div class="card-body">
                            <h2>Total Target Money</h2>
                            <div class="div">
                                <h4> Target Money in {{ $currentMonthName }} = {{ $targetMoney }}Tk.</h4>
                                <h4> Revenue in {{ $currentMonthName }} = {{ $employeeTarget }}Tk.</h4>
                                <h4> Unpaid in {{ $currentMonthName }} = {{ $unpaidAmount }}Tk.</h4> 
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 my-4" style="text-align:
                center">

                    <div class="card">
                        <div class="card-body">
                            <h2>Team A Target Money</h2>
                            <div class="div">
                                <h4> Target Money in {{ $currentMonthName }} = {{ $targetMoneyCmo }}Tk.</h4>
                                <h4> Revenue in {{ $currentMonthName }} = {{ $employeeTargetCmo }}Tk.</h4>
                                <h4> Unpaid in {{ $currentMonthName }} = {{ $unpaidAmountCmo }}Tk.</h4> 
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 my-4" style="text-align:
                center">

                    <div class="card">
                        <div class="card-body">
                            <h2>Team B Target Money</h2>
                            <div class="div">
                                <h4> Target Money in {{ $currentMonthName }} = {{ $targetMoneyGm }}Tk.</h4>
                                <h4> Revenue in {{ $currentMonthName }} = {{ $employeeTargetGm }}Tk.</h4>
                                <h4> Unpaid in {{ $currentMonthName }} = {{ $unpaidAmountGm }}Tk.</h4> 
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Total Revenue -->
    </div>

</div>
<!-- / Content -->
@endsection