@extends('backend.partials.app')
@section('content')
@push('css')
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

    h3,
    h1,
    h2,
    h5,
    h6,
    p,
    td,
    table,
    tr span {
        color: black
    }
    /* th {
        color: #fff !important;
    }

    tr:nth-child(odd) td:hover {
        color: white;
      
    }

    tr:nth-child(even) td:hover {
        color: white;
    } */
</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h2>Installment Due Report</h2>
                        </div>
                    </div>
                    <div class="report mb-5">
                        <form action="/dueReport" method="GET">

                            <div class="col-md-12 d-flex">
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="from_date">
                                </div>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="to_date">
                                </div>

                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3">
                                    <input class="btn btn-secondary mx-2" type="submit" value="Search">

                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>S/N</th>
                                    <th>File Number</th>
                                    <th>Serial Number</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Due Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php

                                $startdate=Carbon\Carbon::parse($start_date);
                                $enddate=Carbon\Carbon::parse($end_date);

                                function dateRangeWithinRange($start1, $end1, $start2, $end2) {

                                return ($start1 >= $start2 && $end1 <= $end2); } $i=1; foreach($investors as $inv) { $invstartdate=Carbon\Carbon::parse($inv->start_from);
                                    $invenddate=Carbon\Carbon::parse($inv->start_to);


                                    if (dateRangeWithinRange($startdate, $enddate,$invstartdate, $invenddate)) {

                                    $invPays=App\Models\InvestorPay::where('investor_id',$inv->id)->whereBetween('created_at',[$start_date,$end_date])->count();
                                    if($invPays){

                                    }else{
                                    $due=App\Models\Investor::where('id',$inv->id)->first();

                                    @endphp
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $due->fileNumber }}</td>
                                        <td>{{ $due->serial_number }}</td>
                                        <td>{{ $due->name }}</td>
                                        <td>{{ $due->phone }}</td>
                                        <td>{{ $due->inst_per_month }}</td>

                                    </tr>



                                    @php



                                    }





                                    } else {
                                    //echo $inv->id;
                                    //echo "not in range";
                                    }

                                    }


                                    @endphp

                            </tbody>

                        </table>
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
<script>
    new DataTable('#example', {
        select: true
    });

</script>
@endpush
