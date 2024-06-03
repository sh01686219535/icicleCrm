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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body" style="background: #a8cc66;">
                    @include('error')
                    <div class="customer-card">
                        <h2 class="modal-title" id="exampleModalLabel">Update Lead</h2>
                        <a href="{{route('lead')}}" class="btn btn-primary">Suspect List</a>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-2">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" value="{{$lead->full_name}}" name="full_name" id="name" placeholder="Enter Name" readonly>
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" value="{{$lead->email}}" name="email" id="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone</label>
                            <input class="form-control" type="text"  name="phone_number" id="phone" placeholder="Enter Phone">
                        </div>

                        <div class="form-group my-2">
                            <label for="designation">Job Title</label>
                            <input class="form-control" type="text" value="{{$lead->job_title}}" name="job_title" id="Profession" placeholder="Enter Profession">
                        </div>
                        <div class="form-group my-2">
                            <label for="city">City</label>
                            <input class="form-control" type="text" value="{{$lead->city}}" name="city" id="city" placeholder="Enter city">
                        </div>
                        <div class="form-group my-2">
                            <label for="project_name">Comments</label>
                            <input class="form-control" value="{{$lead->comments}}" type="text" name="comments" id="project_name" placeholder="Enter Project Name">
                        </div>
                        <div class="form-group my-2">
                            <label for="sales_officer">Sales Officer</label>
                            <select class="select2-multiple form-control" name="sales_officer" id="sales_officer">
                                <option value="">Select Sales Officer</option>
                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $employee->id ==  $lead->sales_officer ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group my-2">
                            <label for="team_leader">Team Leader</label>
                            <select class="form-control" name="team_leader" id="team_leader">
                                <option value="">Select Team Leader</option>
                                @foreach($teamLeaders as $team)
                                <option value="{{$team->id}}" {{ $team->id == $lead->team_leader ? 'selected' : '' }}>{{ $team->name }}</option>
                                @endforeach
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        $('#sales_officer').select2();
        $('#team_leader').select2();
    });
</script> --}}
@endpush
