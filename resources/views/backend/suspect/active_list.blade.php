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
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        @php
                        $userRole = Auth::guard('admin')->user()->user_role;
                        if ($userRole == 2 || $userRole == 3) {
                        @endphp

                        <div class="area-h3 mpl" class="area-h3" style="display: flex; align-items: center; justify-content: space-between;">
                            <h2>Active Prospect list</h2>
                            <a class="btn btn-primary" href="{{ route('active.excel') }}">Excel</a>
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
                                    <th>Lead User</th>
                                    @php
                                    if (Auth::guard('admin')->user()->user_role == '5') {

                                    } else {
                                    echo '<th>Phone</th>';
                                    }
                                    @endphp
                                    <th>Today's Update</th>
                                    <th>Next Action</th>
                                    <th>Status</th>
                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($sglLead as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->employee_name  }}</td>
                                    <td>{{ $value->lead->full_name ?? '' }}</td>
                                    @if (Auth::guard('admin')->user()->user_role == '5')

                                    @else
                                    <td>{{ $value->lead->phone_number ?? '' }}</td>

                                    @endif

                                    <td>{{ $value->todays_update }}</td>
                                    <td>{{ $value->next_action }}</td>
                                    <td>{{ $value->status }}</td>
                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <td>
                                        <a class="btn btn-danger" id="delete" href="{{ route('leadDelete', $value->id) }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                    @endif
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