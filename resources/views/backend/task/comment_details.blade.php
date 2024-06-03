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
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h2>Task comment's Details</h2>
                        </div>

                        <div class=" m-3">
                            <a class="btn btn-primary" href="/tasks">Task List</a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>

                                <tr>
                                    <th>SI</th>
                                    <th>Lead User</th>
                                    <th>Phone Number</th>
                                    <th>Next Action</th>
                                    <th>Next Action Date</th>
                                    <th>Today's Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($taskCommnts as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->lead->full_name ?? ''  }}</td>
                                    <td>{{ $value->lead->phone_number ?? ''  }}</td>
                                    <td>{{ $value->next_action}}</td>
                                    <td>{{ $value->next_action_date }}</td>
                                    <td>{{ $value->todays_update }}</td>
                                    <!-- <td>{{ $value->emplyoee->name  ?? ''}}</td> -->
                                    <!-- <td>
                                        <a href="{{route('tasks.edit',$value->id)}}" style="display:inline-block;" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('tasks.coment.details',$value->id)}}" style="display:inline-block;" class="btn btn-primary"><i class="fas fa-receipt"></i></a>
                                         <form action="{{ route('tasks.destroy', $value->id) }}" method="POST">
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