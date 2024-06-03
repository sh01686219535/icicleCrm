@extends('backend.partials.app')
@section('title')
Admin Target Assign
@endsection
@push('css')
<style>
    th {
        color: #fff !important;
    }

    tr:nth-child(odd) td:hover {
        color: white;
      
    }

    tr:nth-child(even) td:hover {
        color: white;
    }
</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-head">
                    <h2 class="text-center my-3">Assign Target</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('store.assign.target')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="teamLead">Team Leader</label>
                                    <select name="teamLeader_id" id="teamLead" class="form-control my-2">
                                        <option value="">Select Team Leader</option>
                                        @foreach($teamLeader as $item)
                                        <option value="{{$item->id}}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="amount">Target Money</label>
                                    <input type="text" name="targetAmount" id="amount" class="form-control my-2" placeholder="Enter Target Amount">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="amount">Target Date</label>
                                    <input type="date" name="targetDate" id="amount" class="form-control my-2">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <!-- //table show -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="example">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Team Leader Name</th>
                                    <th>Target Amount</th>
                                    <th>Target Month</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($target as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $value->teamLeader->name ?? '' }}</td>
                                    <td>{{ $value->targetAmount }}</td>
                                    <td>{{Carbon\Carbon::parse($value->targetDate)->format('d-M-y') }}</td>

                                    <td>
                                        <a href="{{route('target.admin.edit',$value->id)}}" title="Edit" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('target.admin.delete',$value->id)}}" title="Delete" class="btn btn-danger" id="delete"><i class="fa fa-trash"></i></a>
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
@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });
</script>
@endpush