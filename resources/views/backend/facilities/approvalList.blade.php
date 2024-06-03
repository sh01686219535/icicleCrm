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
                        <div class="area-h3">
                            <h2>Client Facilities Approve</h2>
                        </div>
                    </div>
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Client</th>
                                <th>Person</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Approval</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1
                            @endphp
                            @foreach($facilities as $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->investor->serial_number ?? ''}}</td>
                                <td>{{ $item->person }}</td>
                                <td>{{$item->start_date}}</td>
                                <td>{{$item->end_date}}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('approve_facilities',$item->id) }}" title="Delete" class="btn btn-info"><span class="btn btn-info">Approve</span></a>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('facilities_admin_show',$item->id) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger" id="delete" href="{{ route('facilitiesDelete',$item->id) }}"><i class="fas fa-trash"></i></a>
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
