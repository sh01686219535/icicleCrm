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

    h3,
    h6 {
        color: #ffffff;
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
                                    @if ($auth->image)
                                    <img src="{{asset($auth->image)}}" alt="" style="width:100px;height:100px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display:block;margin:0 auto;" class="image-style mb-3">
                                    @else
                                    <img style="width:100px;height:100px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);display:block;margin:0 auto;" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                    @endif
                                </div>
                                <h5 style="text-align:center;"><strong>{{ $auth->name }}</strong></h5>
                            </div>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info my-3" style="color:#ffffff;">Booking Register</a>
                            @foreach($booking as $item)
                            @if($item->status == 'pending')
                            <button class="btn btn-primary my-2">{{ $item->status }}</button>
                            @else
                            @endif
                            @endforeach
                        </div>
                        <div class="col-md-10 col-sm-10 col-lg-10 d-flex" style="margin: 0 5px 10px 0;">
                            <div class="col-md-12 col-sm-12 col-lg-12 d-flex" style="margin: 0 5px 0 0">
                                <div class="col-lg-6 col-md-6 col-sm-6 " style="margin:0 5px 0 0">
                                    <div class="card mr-2">
                                        <div class="card-body">
                                            <p><b>Client Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->serial_number }}</p>
                                            <p><b>Ownership Size &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: </b>{{ $investor->ownership_size }}</p>
                                            <p><b>Category Ownership &nbsp;: </b>{{ $investor->category_ownership }}</p>
                                            <p><b>Ownership Number &nbsp;&nbsp;&nbsp;: </b>{{ $investor->no_ownership }}</p>
                                            <p><b>Installment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>
                                                @if($investor->installment)
                                                {{ $investor->installment }}
                                                @elseif($investor->quarterly)
                                                {{ $investor->quarterly }}
                                                @elseif($investor->half_yearly)
                                                {{ $investor->half_yearly }}
                                                @elseif($investor->yearly)
                                                {{ $investor->yearly }}
                                                @elseif($investor->at_a_time)
                                                {{ $investor->at_a_time }}
                                                @endif
                                            </p>
                                            <p><b>Inst. Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->no_of_installment }}</p>
                                            <p><b>Inst. Per Month &nbsp;: </b>{{ $investor->inst_per_month }}</p>
                                            <p><b>Start Month &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->start_from }}</p>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="card mr-2">
                                        <div class="card-body">

                                            <p><b>End Month &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->start_to }}</p>

                                            <p><b>Agreed Amount &nbsp;&nbsp;&nbsp;: </b>{{ $investor->agreed_price }}</p>
                                            <p><b>Booking Amount &nbsp;&nbsp;: </b>{{ $investor->down_payment }}</p>
                                            <p><b>Discount Amount &nbsp;: </b>{{ $investor->special_discount }}</p>
                                            <p><b>Total Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->main_amount }}</p>
                                            <p><b>Project Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $investor->project_name }}</p>
                                            <p><b>Project Address&nbsp;: </b>{{ $investor->project_address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="card-body text-center">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card" style="background: #86b52e;">
                        <h3 id="todayWork" class="mt-3">Todays Done Work List</h3>
                        <br>
                        <div class="todays">

                        </div>
                    </div>
                </div>

                <div class="col-md-6 mx-auto" >
                    <div class="card" style="background: #86b52e;">
                        <h3 id="toDo" class="mt-3">Todays Work List</h3>
                        <br>
                        <div class="next">

                        </div>
                    </div>
                </div>
            </div>

        </div> -->



    </div>
</div>
<!--/ Hoverable Table rows -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{route('booking.register')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="person"><strong>Total Person</strong></label>
                        <input type="number" name="person" placeholder="Enter Person" id="person" class="form-control" />
                    </div>
                    <div class="form-group my-2">
                        <label for="start_date"><strong>Start Date</strong></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" />
                    </div>
                    <div class="form-group my-2">
                        <label for="end_date"><strong>End Date</strong></label>
                        <input type="date" name="end_date" id="end_date" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>
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
</script>
@endpush
