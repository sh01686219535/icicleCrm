@extends('backend.partials.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div id="exampleModal">
    @include('error')
    <form action="{{ route('tasks.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group my-2">
                    </div>

                    <div class="col-md-12 col-sm-12 col-lg-12 col-12" style="display:flex;flex-wrap:wrap;">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="lead">Today's Lead User</label>
                                <select name="lead_user" id="lead" class="form-control">
                                    <option value="">Select Lead User</option>
                                    @foreach($leadUser as $leads)
                                    <option value="{{$leads->id}}">{{$leads->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-6">
                            <div class="form-group">
                                <label for="lead">Existing Lead User</label>
                                <select name="exist_lead_user" id="existing_lead" class="form-control">
                                    <option value="">Select Lead User</option>
                                    @foreach($exitigleadUser as $leads)
                                    <option value="{{$leads->id}}">{{$leads->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 colsm-12 col-12" style="display:flex;flex-wrap:wrap;">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group ">
                                <label for="lead">Lead User</label>
                                <input type="text" id="lead_assist" name="lead_phone" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group ">
                                <label for="lead">Lead Email</label>
                                <input type="text" id="teamEmail" name="teamEmail" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group ">
                                <label for="lead">Job Title</label>
                                <input type="text" id="job_title" name="teamEmail" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group ">
                                <label for="lead">City</label>
                                <input type="text" id="city" name="teamEmail" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-lg-4">
                            <div class="form-group ">
                                <label for="lead">Team Leader</label>
                                <input type="text" id="team_leader" name="team_leader" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="todays_update">Todays Updated</label>
                        <input type="text" name="todays_update" class="form-control" id="todays_update">
                    </div>
                    <div class="form-group">
                        <label for="next_action">Next Action</label>
                        <input type="text" name="next_action" class="form-control" id="next_action">
                    </div>
                    <div class="form-group">
                        <label for="next_action_date">Next Action Date</label>
                        <input type="date" name="next_action_date" class="form-control" id="next_action_date">
                    </div>
                    <div class="form-group my-2">
                        <label for="description">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Interested">Interested</option>
                            <option value="Not Interested">Not Interested</option>
                            <option value="Not Receive">Not Receive</option>
                            <option value="Appointment Schedule">Appointment Schedule</option>
                            <option value="Sure Secure">Sure Secure</option>
                            <option value="Critical">Critical</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

    </form>
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lead').change(function() {
            var lead = $(this).val();
            $.ajax({
                url: '/getAssist',
                type: 'get',
                dataType: 'json',
                data: 'lead=' + lead,
                success: function(data) {
                    $('#lead_assist').val(data[0]);
                    $('#team_leader').val(data[1]);
                    $('#teamEmail').val(data[2]);
                    $('#job_title').val(data[3]);
                    $('#city').val(data[4]);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    // teamleader
    $(document).ready(function() {
        $('#lead').change(function() {
            var lead = $(this).val();
            $.ajax({
                url: '/getTeamLeader',
                type: 'get',
                dataType: 'json',
                data: 'lead=' + lead,
                success: function(data) {
                    $('#teamLeader').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        //existing_lead
        $('#existing_lead').change(function() {
            var lead = $(this).val();
            $.ajax({
                url: '/getExitingAssist',
                type: 'get',
                dataType: 'json',
                data: 'lead=' + lead,
                success: function(data) {
                    $('#lead_assist').val(data[0]);
                    $('#team_leader').val(data[1]);
                    $('#teamEmail').val(data[2]);
                    $('#job_title').val(data[3]);
                    $('#city').val(data[4]);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#lead').select2();
        $('#existing_lead').select2();
    });
</script>

@endpush