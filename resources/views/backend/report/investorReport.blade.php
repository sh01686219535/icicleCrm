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
    p,
    td,
    th,
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
    .dt-button{
        background: darkturquoise !important;
        color: white !important;
        padding: 6px 24px !important;
        border-radius: 8px !important;
    }
</style>
<!-- <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h2>Client Report</h2>
                        </div>
                    </div>
                    <div class="report mb-5">
                        <form action="/postInvestorReport" method="GET">

                            <div class="col-md-12 d-flex">
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="from_date">
                                </div>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="to_date">
                                </div>

                                <div class="col-lg-2 col-xl-2 col-md-2 col-sm-2 col-2">
                                    <input class="btn btn-secondary mx-2" type="submit" value="Search">

                                </div>
                                  <div class="col-lg-1 col-xl-1 col-md-1 col-sm-1 col-1">
                                    <a href="{{route('investor-export')}}" class="btn btn-primary">Excel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>SI</th>
                                    <th>File Number</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Present Address</th>
                                    <th>Permanent Address</th>
                                    <th>Share Type</th>
                                    <th>Unit</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Paid</th>
                                    <th>Unpaid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($investor as $item)
                                <tr>
                                    <td>{{$item->serial_number}}</td>
                                    <td>{{$item->fileNumber}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->present_address}}</td>
                                    <td>{{$item->permanent_address}}</td>
                                    <td>{{$item->category_ownership}}</td>
                                    <td>{{$item->no_ownership}}</td>
                                    <td>{{$item->ownership_size}}</td>
                                    <td>{{$item->allow_amount}}</td>
                                    <td>
                                       
                                        <?php
                                        $investorPays = App\Models\InvestorPay::where('investor_id', $item->id)->select('booking_money', 'total')->get();
                                        $combinedSum = $investorPays->reduce(function ($carry, $items) {
                                        return $carry + $items->booking_money + $items->total;
                                        }, 0);
                                        $downPayment = is_numeric($item->down_payment) ? $item->down_payment : 0;
                                        $total = $combinedSum + $downPayment;
                                        $unPaidAmount = $item->allow_amount - $total;
                                        ?>
                                        {{ $total }}
                                    </td>

                                    <td>

                                        {{ $unPaidAmount }}
                                    </td>
                                </tr>
                                @endforeach
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
<!-- <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script> -->

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<!-- <script>
    new DataTable('#example', {
        select: true
    });
</script> -->
<script>
 new DataTable('#example', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'pdf', 'print']
        }
    }
});
</script>
@endpush