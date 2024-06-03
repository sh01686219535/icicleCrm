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

    .mpl {
        display: flex;
        justify-content: space-between;
        width: 100%;
        align-items: center;
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
                        @php
                        $userRole = Auth::guard('admin')->user()->user_role;
                        if ($userRole == 2 || $userRole == 3) {
                    @endphp

                        <div class="area-h3 mpl" class="area-h3" style="display: flex; align-items: center; justify-content: space-between;">
                            <h2>Prospect To Client list</h2>
                            <a class="btn btn-primary" href="{{ route('lead.investor.excel') }}">Excel</a>
                        </div>

                    @php
                        }
                    @endphp
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Agreed Price</th>
                                    <th>Booking Amount</th>
                                    <th>Per inst. Amount</th>
                                    <th>Comments</th>
                                    <th>Image</th>
                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody> @foreach($clientList as $investors)
                                <tr>
                                    <td>{{$investors->serial_number}}</td>
                                    <td>{{$investors->name}}</td>
                                    <td>{{$investors->phone}}</td>
                                    <td>{{$investors->allow_amount}}</td>
                                    <td>{{$investors->down_payment}}</td>
                                    <td>{{$investors->inst_per_month}}</td>
                                    <td>{{Str::limit($investors->comments,10)}}</td>
                                    <td>
                                        <img src="{{asset($investors->user_image)}}" width="50" height="50" alt="">
                                    </td>

                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <td width="100%" style="white-space:nowrap;">
                                        <a class="btn btn-secondary" href="{{ route('investor_org_show',$investors->id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-info" href="{{ route('investor_show',$investors->id) }}"><i class="fas fa-edit"></i></a>

                                        <a class="btn btn-primary" href="{{ route('investor.list',$investors->id) }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-dark" href="{{ route('bookingPdf',$investors->id) }}"><i class="fas fa-receipt"></i></a>

                                        <a class="btn btn-warning" href="{{ route('investorPayment.pdf',$investors->id) }}"><i class="fa-solid fa-list"></i></a>

                                        {{-- <a class="btn btn-danger " id="delete" href="{{ route('investor_delete',$investors->id) }}"><i class="fas fa-trash"></i></a> --}}
                                    </td>
                                    @endif
                                </tr> @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->


<!-- Modal -->

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush
