@extends('backend.partials.app')
@section('content')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .add-btn {
        width: 60px;
        height: 60px;
        background: #ef5252;
        display: inline-block;
        text-align: center;
        line-height: 60px;
        border-radius: 50%;
        font-size: 30px;
        color: aliceblue;
        cursor: pointer;
    }

    .customer-card {
        display: flex;
        justify-content: space-between;
    }

    .customer-container {
        margin: 0 0 310px 0;
    }


    h1,
    h2,
    h5,
    td,
    th,
    table,
    tr span {
        color: black
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

<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3">
                        <div class="col-sm-2 col-md-2 col-lg-2 ">
                            <div class="div" style="padding-right: 0 !important;background: beige;margin: 0 5px 10px 0;padding:2px 0">
                                <div class="profile">
                                    @if ($gm->image)
                                    <img src="{{asset($gm->image)}}" alt="" style="width:100px;height:100px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display:block;margin:0 auto;" class="image-style mb-3">
                                    @else
                                    <img style="width:100px;height:100px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display:block;margin:0 auto;" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                    @endif
                                </div>
                                <h5 style="text-align:center;"><b>{{ $gm->name }}</b></h5>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-10 col-lg-10 d-flex" style="margin: 0 5px 10px 0;">

                            <div class="col-md-6 col-sm-6 col-lg-6 d-flex">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 m-1" style="text-align:
                center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mainbtn" style="background:#1dc332 !important">
                                                <a class="icon_sus" href="{{route('team.investor')}}" style="color: #fff !important"><i class="fa-solid fa-warehouse"></i></a>
                                            </div>
                                            <h6 style="margin:10px 0 0 0 ">My Suspect</h6>
                                            <a href="{{route('team.investor')}}" class="btn btn-info text_btn" style="color: #fff !important">{{ $lead }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6" style="text-align:
                center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mainbtn" style="background:#007eff !important">
                                                <a href="{{ route('employee.list') }}" class="icon_sus" style="color: #fff !important"><i class="fa-solid fa-person"></i></a>
                                            </div>
                                            <h6 style="margin:10px 0 0 0 ">Sales Officer</h6>
                                            <a href="{{ route('employee.list') }}" class="btn btn-info text_btn">{{ $employee }}</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6" style="text-align:
                center">
                                     <div class="card">
                                        <div class="card-body">
                                            <div class="mainbtn" style="background:#007eff !important">
                                                <a href="" class="icon_sus" style="color: #fff !important"><i class="fa-solid fa-eye"></i></a>
                                            </div>
                                            <h6 style="margin:10px 0 0 0 ">Team Leader</h6>
                                            <a href="{{ route('teamLeader') }}" class="btn btn-info text_btn">{{ $teamLeaderCount }}</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
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
                        <a href="{{ route('active.suspect.list') }}" class="btn btn-info text_btn">{{$activeLead}}</a>
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
                        <a href="{{ route('client.suspect.list') }}" class="btn btn-info text_btn"></a>
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
                        <a href="{{ route('mpl.list') }}" class="btn btn-info text_btn">{{$mplLead}}</a>
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
                        <a href="{{ route('sgl.list') }}" class="btn btn-info text_btn">{{$sglLead}}</a>
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
                    {{-- @if($targetMoney && $employeeTarget && $unpaidAmount) --}}
                    <div class="card">
                        <div class="card-body">
                            <h2>Target Money</h2>
                            <div class="div">
                                <h4> Target Money in {{ $currentMonthName }} = {{ $targetMoney ?? 0 }}Tk.</h4>
                                <h4> Revenue in {{ $currentMonthName }} = {{ $employeeTarget ?? 0 }}Tk.</h4>
                                <h4> Unpaid in {{ $currentMonthName }} = {{ $unpaidAmount ?? 0 }}Tk.</h4>
                            </div>
                        </div>
                    </div>
                    {{-- @else
                    <div class="card">
                        <div class="card-body">
                            <h2>Target Money</h2>
                            <div class="div">
                                <h4> Target Money in {{ $currentMonthName }} = 0Tk.</h4>
                                <h4> Revenue in {{ $currentMonthName }} = 0Tk.</h4>
                                <h4> Unpaid in {{ $currentMonthName }} = 0Tk.</h4>
                            </div>
                        </div>
                    </div>
                @endif --}}

                </div>
            </div>
            </div>

        </div>




    </div>
</div>
<!--/ Hoverable Table rows -->


@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
    $(document).ready(function() {
        $('#booking').click(function() {
            $('.booking_money').css('display', 'block');
            $('.inst_money').css('display', 'none');
        });
        $('#inst').click(function() {
            $('.inst_money').css('display', 'block');
            $('.booking_money').css('display', 'none');
        });
    });

    // $(document).ready(function() {
    //     $('#todayWork').click(function() {
    //         $('.todays').css('display', 'block');
    //         $('.next').css('display', 'none');
    //     });
    //     $('#toDo').click(function() {
    //         $('.next').css('display', 'block');
    //         $('.todays').css('display', 'none');
    //     });
    // });
</script>
@endpush
