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
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                    @include('error')
                    <div class="customer-card">
                        <h2 class="modal-title" id="exampleModalLabel">Update Tasks</h2>

                    </div>
                    <form action="{{route('tasks.update',$task->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="lead">Lead User</label>
                            <select name="lead_user" id="lead" class="form-control">
                                <option value="">Select Lead User</option>
                                @foreach($leadUser as $leads)
                                <option value="{{$leads->id}}" {{ $leads->id == $task->lead_user ? 'selected' : '' }}>{{$leads->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="employee_name" >Employee Name</label>
                            <input type="text" value="{{ $task->employee_name }}" name="employee_name" class="form-control" id="employee_name">
                </div> --}}
                <div class="form-group">
                    <label for="todays_update">Todays Updated</label>
                    <input type="text" value="{{ $task->todays_update }}" name="todays_update" class="form-control" id="todays_update">
                </div>
                <div class="form-group">
                    <label for="next_action">Next Action</label>
                    <input type="text" value="{{ $task->next_action }}" name="next_action" class="form-control" id="next_action">
                </div>
                <div class="form-group">
                    <label for="next_action_date">Next Action Date</label>
                    <input type="date" name="next_action_date" class="form-control" id="next_action_date">
                </div>
                <div class="form-group my-2">
                    <label for="description">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="{{ $task->status }}">{{ $task->status }}</option>
                        <option value="Interested">Interested</option>
                        <option value="Not Interested">Not Interested</option>
                        <option value="Not Receive">Not Receive</option>
                        <option value="Appointment Schedule">Appointment Schedule</option>
                        <option value="Sure Secure">Sure Secure</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!--/ Hoverable Table rows -->

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

@endpush