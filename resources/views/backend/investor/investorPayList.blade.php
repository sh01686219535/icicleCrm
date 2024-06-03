@extends('backend.partials.app')
@section('content')
@push('css')
<style>
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
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" >
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 d-flex" style="justify-content:space-between;width:98%;">
                            <h2>Payment List</h2>
                            <a href="{{route('investorPayment.pdf',$investorId)}}" class="btn btn-primary" style="font-size:22px;"><i class="fas fa-print"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Client Number</th>
                                    <th>Name</th>
                                    <th>From Month</th>
                                    <th>To Month</th>
                                    <th>total</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalAmount = 0;
                                @endphp
                                @foreach($investorPay as $investors)
                                <tr>
                                    <td>{{$investors->investor->serial_number ?? ''}}</td>
                                    <td>{{$investors->investor->name ?? ''}}</td>
                                    <td>{{$investors->start_month}}</td>
                                    <td>{{$investors->end_month}}</td>
                                    <td>{{$investors->total}}</td>
                                    @php
                                    $totalAmount += $investors->total;
                                    @endphp
                                    <!-- <td>
                                        {{-- <a class="btn btn-danger " id="delete" href="{{ route('investorPay_delete',$investors->id) }}"><i class="fas fa-trash"></i></a> --}}
                                        <a class="btn btn-primary" href="{{ route('investorPay_print',$investors->id) }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-info" href="{{ route('investorPay_view',$investors->id) }}"><i class="fas fa-eye"></i></a>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4"></td>
                                    <td>={{$totalAmount}} Tk.</td>
                                </tr>
                            </tfoot>
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