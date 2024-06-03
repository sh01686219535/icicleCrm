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
                            <h2>SGL list</h2>
                            <a class="btn btn-primary" href="{{ route('sgl.excel') }}">Excel</a>
                        </div>

                        @php
                        }
                        @endphp
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    @php
                                    if (Auth::guard('admin')->user()->user_role == '5') {

                                    } else {
                                    echo '<th>Phone</th>';
                                    }
                                    @endphp

                                    <th>Job Title</th>
                                    <th>City</th>
                                    <th>Sales Officer</th>

                                    <th>Team Leader</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1
                                @endphp
                                @foreach($sglLead as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->full_name }}</td>
                                    <td>{{ $value->email }}</td>

                                    @if (Auth::guard('admin')->user()->user_role == '5')

                                    @else
                                    <td>{{ $value->phone_number }}</td>

                                    @endif


                                    <td>{{ $value->job_title }}</td>
                                    <td>{{ $value->city }}</td>
                                    <td>
                                        @foreach (explode(',', $value->sales_officer) as $item)
                                        @php
                                        $employee = \App\Models\Employee::find($item);
                                        @endphp

                                        @if ($employee)
                                        {{ $employee->name }}
                                        @if (!$loop->last)
                                        ,
                                        @endif
                                        @endif
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach (explode(',', $value->team_leader) as $item)
                                        @php
                                        $teamLeader = \App\Models\TeamLeader::find($item);
                                        @endphp

                                        @if ($teamLeader)
                                        {{ $teamLeader->name }}
                                        @if (!$loop->last)
                                        ,
                                        @endif
                                        @endif
                                        @endforeach
                                        {{-- {{ $value->teamLeader->name ?? '' }} --}}
                                    </td>
                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->comments }}</td>
                                    @if(Auth::guard('admin')->user()->can('view-junk-suspect-list'))
                                    <td>

                                        <a class="btn btn-info" href="{{ route('sgl.edit', $value->id) }}"><i class="fas fa-edit"></i></a>

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