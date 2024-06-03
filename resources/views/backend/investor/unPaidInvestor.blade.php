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
</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 d-flex" style="justify-content:space-between;width:98%;">
                            <h2>UnPaid Investor List</h2>
                            <a href="{{route('unpaid.pdf')}}" class="btn btn-primary" style="font-size:22px;"><i class="fas fa-print"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Phone</th>
                                    <th>Number of Ownership</th>
                                    <th>Agreed Price</th>
                                    <th>Main Amount</th>
                                    <th>No of Installment</th>
                                    <th>From Month</th>
                                    <th>To Month</th>
                                    <th>Inst per month</th>

                            </thead>
                            <tbody>
                                @php
                                $totalInstPerAmount = 0;
                                @endphp
                                @foreach($investorPay as $investors)
                                <tr>
                                    <td>{{$investors->serial_number}}</td>
                                    <td>{{$investors->phone}}</td>
                                    <td>{{$investors->no_ownership}}</td>
                                    <td>{{$investors->agreed_price}}</td>
                                    <td>{{$investors->main_amount}}</td>
                                    <td>{{$investors->no_of_installment}}</td>
                                    <td>{{$investors->start_from}}</td>
                                    <td>{{$investors->start_to}}</td>
                                    <td>{{$investors->inst_per_month}}</td>
                                </tr>
                                @php
                                $totalInstPerAmount += $investors->inst_per_month;
                                @endphp
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">Total Unpaid Amount</td>
                                    <td colspan="2">Total = {{$totalInstPerAmount}}Tk.</td>
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