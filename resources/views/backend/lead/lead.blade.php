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

    h3,
    h1,
    h2,
    h5,
    h6,
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
                        <div class="area-h3">
                            <h2>Suspect List</h2>
                        </div>

                        <div class="add-btn">
                            <a class="add-btn" data-bs-toggle="modal" data-bs-target="#sharif"><i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @php
                    $user_role = Auth::guard('admin')->user()->user_role;
                    if ($user_role == 2 || $user_role == 3) {
                    @endphp
                    <div class="excel mb-2" style="text-align: end;">
                        <a class="btn btn-primary" href="{{ route('suspect.list.excel') }}">Excel</a>
                    </div>
                    @php
                    }
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Job Title</th>
                                    <th>City</th>
                                    <th>CMO</th>
                                    <th>GM</th>
                                    <th>Create Date</th>
                                    <th>Sales Officer</th>
                                    <th>Team Leader</th>
                                    <th>Status</th>
                                    <th>Source</th>
                                    <th>Comments</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @foreach ($lead as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->full_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        {{ $value->phone_number }}
                                    </td>
                                    <td>{{ $value->job_title }}</td>
                                    <td>{{ $value->city }}</td>
                                    <td>{{ $value->cmo }}</td>
                                    <td>{{ $value->gm }}</td>
                                    <td>{{ $value->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $value->employee->name ?? '' }}</td>
                                    <td>{{ $value->teamLeader->name ?? '' }}</td>

                                    <td>{{ $value->status }}</td>
                                    <td>{{ $value->source }}</td>
                                    <td>{{ $value->comments }}</td>

                                    <td>

                                        <a class="btn btn-info" href="{{ route('leadEdit', $value->id) }}"><i class="fas fa-edit"></i></a>
                                        @php
                                        $user_role = Auth::guard('admin')->user()->user_role;
                                        if ($user_role == 2 || $user_role == 3) {
                                        @endphp
                                        <a class="btn btn-danger" id="delete" href="{{ route('leadDelete', $value->id) }}"><i class="fas fa-trash"></i></a>
                                        @php
                                        }
                                        @endphp
                                 

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

<!-- Modal -->
<div class="modal fade" id="sharif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @include('error')
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Suspector</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group my-2">
                        <label for="excel">Excel</label>
                        <input class="form-control" type="file" name="import_file" id="import_file">
                    </div>
                    <hr>
                    <h6 class="text-center">Or</h6>
                    <div class="form-group mb-2">
                        <label for="full_name">Full Name</label>
                        <input class="form-control" type="text" name="full_name" id="full_name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone_number">Phone Number</label>
                        <input class="form-control" type="text" name="phone_number" id="phone_number">
                    </div>
                    <div class="form-group mb-2">
                        <label for="job_title">Job Title</label>
                        <input class="form-control" type="text" name="job_title" id="job_title">
                    </div>
                    <div class="form-group mb-2">
                        <label for="city">City</label>
                        <input class="form-control" type="text" name="city" id="city">
                    </div>
                    <div class="form-group mb-2">
                        <label for="cmo ">CMO</label>
                        <select style="width: 100%" class="form-control select2" name="cmo" id="cmo">
                            <option value="">Select CMO</option>
                            @foreach ($cmo as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="gm">GM</label>
                        <select style="width: 100%" class="form-control" name="gm" id="gm">
                            <option value="">Select GM</option>
                            @foreach ($gm as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="team_leader">Team Leader</label>
                        <select style="width: 100%" class="form-control" name="team_leader" id="team_leader">
                            <option value="">Select Team Leader</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="sales_officer ">Sales Officer</label>
                        <select style="width: 100%" class="form-control select2" name="sales_officer" id="sales_officer">
                            <option value="">Select Sales Officer</option>
                        </select>
                    </div>
                    <hr>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- end modal --}}
@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#sales_officer').select2();
    //     $('#team_leader').select2();
    // });
    // $(document).ready(function() {
    //     $("#sales_officer").select2({
    //         dropdownParent: $("#sharif .modal-content")
    //         , multiple: true
    //     });
    //     $("#team_leader").select2({
    //         dropdownParent: $("#sharif .modal-content")
    //         , multiple: true
    //     });

    // });
    //get CNO salesman
    $(document).ready(function() {
        $('#team_leader').change(function() {
            var team_leader = $(this).val();
            $.ajax({
                url: '/getTeamSales',
                type: 'post',
                dataType: 'json',
                data: 'team_leader=' + team_leader,
                success: function(data) {
                    $('#sales_officer').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    //get CMO TeamLeader
    $(document).ready(function() {
        $('#cmo').change(function() {
            var cmo = $(this).val();
            $.ajax({
                url: '/getTeam',
                type: 'post',
                dataType: 'json',
                data: 'cmo=' + cmo,
                success: function(data) {
                    $('#team_leader').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    // Get GM SalesPErson
    $(document).ready(function() {
        $('#team_leader').change(function() {
            var team_leader = $(this).val();
            console.log(team_leader);
            $.ajax({
                url: '/getGmSalesPerson',
                type: 'post',
                dataType: 'json',
                data: 'team_leader=' + team_leader,
                success: function(data) {
                    // console.log(data);
                    $('#sales_officer').html(data);
                },
                error: function(xhr, error, status) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    // Get GM TeamLeader
    $(document).ready(function() {
        $('#gm').change(function() {
            var gmId = $(this).val();
            $.ajax({
                url: '/getGmTeamLeader',
                type: 'post',
                dataType: 'json',
                data: 'gmId=' + gmId,
                success: function(data) {
                    $('#team_leader').html(data);
                },
                error: function(xhr, error, status) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        // Initialize Select2 when the document is ready
        initializeSelect2();

        // Reinitialize Select2 when the modal is shown
        $('#sharif').on('shown.bs.modal', function(e) {
            initializeSelect2();
        });

        // Initialize DataTable
        new DataTable('#example', {
            select: true
        });
    });
</script>
<!--  -->


<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush