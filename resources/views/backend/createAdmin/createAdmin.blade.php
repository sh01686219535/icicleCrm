@extends('backend.partials.app')
@section('title')
Add Module
@endsection
@section('content')
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-head mx-5 my-3 customer-card">
                    <div class="left">
                        <h3>Admin Create</h3>
                    </div>
                    <div class="search">
                        <a href="{{ route('adminList') }}" class="btn btn-primary" title="Add Category">
                            <i class="fa-sharp fa-solid fa-list"></i>
                            Admin List</a>
                    </div>
                </div>
            </div>
            @include('error')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('adminCreate') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-12 col-md-12 col-xl-12" style="display:flex">
                                <div class="col-lg-6 col-md-6 col-xl-6 m-1">
                                    <div class="form-group">
                                        <label for="name"><strong>Name</strong></label>
                                        <input type="text" id="name" name="name" placeholder="Admin Name" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><strong>Email</strong></label>
                                        <input type="text" id="email" name="email" placeholder="Admin Email" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile"><strong>Mobile</strong></label>
                                        <input type="text" id="phone" name="phone" placeholder="Admin Mobile Number" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><strong>Password</strong></label>
                                        <input type="password" id="password" name="password" placeholder="Admin Password" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="designation"><strong>Designation</strong></label>
                                        <select id="designation" name="designation" class="form-control my-2">
                                            <option value="">Select Designation</option>
                                            <option value="Chief_Marketing_Officer">Chief Marketing Officer</option>
                                            <option value="general_manager">General Manager</option>
                                            <option value="cmo">C.M.O</option>
                                            <option value="Sr_Manager">Asst. Manager(Team Leader) </option>
                                            <option value="senior_manager">Senior Manager </option>
                                            <option value="Manager">Manager </option>
                                            <option value="Deputy_Manager">Deputy Manager </option>
                                            <option value="Senior_Asst_Manager">Senior Asst Manager</option>
                                            <option value="Sr_Asst_Manager">Sr. Asst. Manager</option>
                                            <option value="Asst_Manager">Asst. Manager</option>
                                            <option value="Sr_Executive">Sr. Executive</option>
                                            <option value="Executive">Executive</option>
                                            <option value="digital_marketing_team">Digital Marketing Team</option>
                                            <option value="acc&other">ACC. & Other</option>
                                            <option value="crm_team">CRM Team</option>
                                            <option value="admin">Admin</option>
                                            <option value="super_admin">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="team"><strong>Team</strong></label>
                                        <select id="team" name="team" class="form-control my-2">
                                            <option value="">Select team</option>
                                            <option value="A:(MERCURY)">A:(MERCURY)</option>
                                            <option value="A:(NEPTUNE)">A:(NEPTUNE)</option>
                                            <option value="A:(PLUTO)">A:(PLUTO)</option>
                                            <option value="B(FIGHTERS)">B(FIGHTERS)</option>
                                            <option value="B:(DOMINATORS)">B:(DOMINATORS)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="team"><strong>Reporting Boss</strong></label>
                                        <select id="team" name="report_to" class="form-control my-2">
                                            <option value="">Select Reporting Boss</option>
                                            <option value="Top_Management">Top Management</option>
                                            <option value="CMO">CMO</option>
                                            <option value="Team_Leader">Team Leader</option>
                                            <option value="GM">GM</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="teamLeader">Choose a Team Leader:</label>
                                        <select id="teamLeader" name="teamLeader_id" class="form-control">
                                            <option value="">Select Team Leader</option>
                                            @foreach($teamLeader as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xl-6 m-1">
                                    <div class="form-group">
                                        <label for="user_role" class="my-1">Choose a Role:</label>
                                        <select id="user_role" name="user_role" class="form-control">
                                            @foreach($adminCreate as $roles)
                                            <option value="{{$roles->id}}">{{ $roles->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="target_money" class="my-1"><strong>Target Booking Money</strong></label>
                                        <input type="number" id="target_money" name="target_money" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="target_S_to_C"><strong>Target Lead to Investor</strong></label>
                                        <input type="text" id="target_S_to_C" name="target_S_to_C" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="target_installment"><strong>Target Installment Money</strong></label>
                                        <input type="text" id="target_installment" name="target_installment" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="booking_ratio"><strong>Booking Ratio</strong></label>
                                        <input type="text" id="booking_ratio" name="booking_ratio" class="form-control my-2">

                                    </div>
                                    <div class="form-group">
                                        <label for="installment_ratio"><strong>Installment Ratio</strong></label>

                                        <input type="text" id="installment_ratio" name="installment_ratio" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="cmo">Choose a CMO</label>
                                        <select id="cmo" name="cmo" class="form-control">
                                            <option value="">Select CMO</option>
                                            @foreach($cmo as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gm">Choose a GM</label>
                                        <select id="gm" name="gm" class="form-control">
                                            <option value="">Select GM</option>
                                            @foreach($gm as $item)
                                            <option value="{{$item->id}}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12">
                                <input type="submit" value="Submit" class="btn btn-primary my-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#user_role').change(function() {
            var user_role = $(this).val();

            $.ajax({

                url: '/ratio'
                , type: 'get'
                , dataType: 'json'
                , data: 'user_role=' + user_role
                , success: function(data) {
                    console.log(data)
                    $('#booking_ratio').val(data[0]);
                    $('#installment_ratio').val(data[1]);
                }
                , error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

</script>
@endpush
