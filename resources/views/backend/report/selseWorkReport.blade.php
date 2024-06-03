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
    h3, h1, h2, h5, h6, p, td, table, tr span{
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
                            <h2>Task Report</h2>
                        </div>
                    </div>
                    <div class="report mb-5">

                            <form action="/task/report" method="GET">
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
                                    <th>SI</th>

                                    <th>Suspect</th>
                                    <th>Suspect Assist</th>
                                    <th>Received Amount</th>
                                    <th>Number Of Lead</th>
                                    <th>Review</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($task as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>

                                    <td>{{ $value->lead->full_name ?? '' }}</td>
                                    <td>{{ $value->lead->employee->name }}</td>
                                    <td>{{ $value->received_amount }}</td>
                                    <td>{{ $value->numberOfLead }}</td>
                                    <td>{{ Str::limit($value->review,20) }}</td>
                                    <td>{{ Str::limit($value->description,20) }}</td>
                                    <td>
                                        <a href="{{route('tasks.edit',$value->id)}}" style="display:inline-block;" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('tasks.destroy', $value->id) }}" style="display:inline-block;" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" id="delete"><i class="fas fa-trash"></i></button>
                                        </form>
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
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush
