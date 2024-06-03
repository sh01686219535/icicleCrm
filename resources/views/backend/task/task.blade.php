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
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" >
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h2>Task</h2>
                        </div>

                        <div class="add-btn m-3">
                            <a class="add-btn" href="{{ route('tasks.create') }}"><i class="fas fa-plus"></i></a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Suspect</th>
                                    <th>Phone</th>
                                    <th>Today's Update</th>
                                    <th>Today's Update Date</th>
                                    <th>Next Action</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($task as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->employee->name ?? ''  }}</td>
                                    <td>{{ $value->lead->full_name ?? '' }}</td>
                                    <td>{{ $value->lead->phone_number ?? '' }}</td>
                                    <td>{{ $value->todays_update }}</td>
                                    <td>{{ $value->created_at->format('d-M-y') }}</td>
                                    <td>{{ $value->next_action }}</td>
                                    <td>{{ $value->status }}</td>
                                    <td>
                                        <a href="{{route('tasks.edit',$value->id)}}" style="display:inline-block;" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('tasks.coment.details',$value->id)}}" style="display:inline-block;" class="btn btn-primary"><i class="fas fa-receipt"></i></a>
                                        <!-- <form action="{{ route('tasks.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form> -->
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

{{-- end modal --}}

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush
