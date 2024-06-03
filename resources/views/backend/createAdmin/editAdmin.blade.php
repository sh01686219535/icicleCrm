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
                        <h3>Admin Update</h3>
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

                    <form action="{{ route('editAdmin',$test->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12" style="display: flex">
                                <div class="col-lg-6 col-md-6 col-xl-6 col-sm-6 m-1">
                                    <div class="form-group">
                                        <label for="name"><strong>Name</strong></label>
                                        <input type="text" id="name" name="name" value="{{$test->name}}" placeholder="Admin Name" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><strong>Email</strong></label>
                                        <input type="text" id="email" name="email" value="{{$test->email}}" placeholder="Admin Email" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="name"><strong>Password</strong></label>
                                        <input type="password" id="password" name="password" placeholder="Admin Password" class="form-control my-2">
                                    </div>
                                    <div class="form-group">
                                        @if ($employee)
                                        <label for="mobile"><strong>Mobile</strong></label>
                                        <input type="text" id="phone" name="phone" value="{{$employee->phone}}" placeholder="Admin Mobile Number" class="form-control my-2">
                                        @elseif ($teamLeader)
                                        <label for="mobile"><strong>Mobile</strong></label>
                                        <input type="text" id="phone" name="phone" value="{{$teamLeader->phone ?? ''}}" placeholder="Admin Mobile Number" class="form-control my-2">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="designation"><strong>Designation</strong></label>
                                        <select id="designation" name="designation" class="form-control my-2">
                                            <option value="">Select Designation</option>
                                            <option value="Chief_Marketing_Officer" {{ $test->designation == 'Chief_Marketing_Officer' ? 'selected' : '' }}>Chief Marketing Officer</option>
                                            <option value="General_Manager" {{ $test->designation == 'General_Manager' ? 'selected' : '' }}>General Manager</option>
                                            <option value="cmo" {{ $test->designation == 'cmo' ? 'selected' : '' }}>C.M.O</option>
                                            <option value="Sr_Manager" {{ $test->designation == 'Sr_Manager' ? 'selected' : '' }}>Sr. Manager (Team Leader)</option>
                                            <option value="Manager" {{$test->designation == 'Manager' ? 'selected' : '' }}>Manager (Team Leader)</option>
                                            <option value="Deputy_Manager" {{ $test->designation == 'Deputy_Manager' ? 'selected' : '' }}>Deputy Manager (Team Leader)</option>
                                            <option value="Senior_Asst_Manager" {{ $test->designation == 'Senior_Asst_Manager' ? 'selected' : '' }}>Senior Asst Manager (Team Leader)</option>
                                            <option value="Sr_Asst_Manager" {{ $test->designation == 'Sr_Asst_Manager' ? 'selected' : '' }}>Sr. Asst. Manager</option>
                                            <option value="Asst_Manager" {{ $test->designation == 'Asst_Manager' ? 'selected' : '' }}>Asst. Manager</option>
                                            <option value="Sr_Executive" {{ $test->designation == 'Sr_Executive' ? 'selected' : '' }}>Sr. Executive</option>
                                            <option value="Executive" {{ $test->designation == 'Executive' ? 'selected' : '' }}>Executive</option>
                                            <option value="digital_marketing_team" {{$test->designation == 'digital_marketing_team' ? 'selected' : '' }}>Digital Marketing Team</option>
                                            <option value="acc&other" {{ $test->designation == 'acc&other' ? 'selected' : '' }}>ACC. & Other</option>
                                            <option value="crm_team" {{ $test->designation == 'crm_team' ? 'selected' : '' }}>CRM Team</option>
                                            <option value="admin" {{ $test->designation == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="super_admin" {{ $test->designation == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_role" class="my-1">Choose a Role:</label>
                                        <select id="user_role" name="user_role" class="form-control">
                                            @foreach($adminCreate as $roles)
                                            <option value="{{ $roles->id }}" {{ $test->user_role == $roles->id ? 'selected' : '' }}>
                                                {{ $roles->role_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="teamLeader" class="my-1">Choose a Team Leader:</label>
                                        <select id="teamLeader" name="teamLeader_id" class="form-control">
                                            @foreach($leader as $item)
                                            <option value="{{ $item->id }}" {{ $test->teamLeader_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-xl-6 col-sm-6 m-1">
                                    <div class="form-group">
                                        @if ($employee)
                                        <label for="target_money"><strong>Target Booking Money</strong></label>
                                        <input type="number" id="target_money" value="{{$employee->target_money}}" name="target_money" class="form-control my-2">
                                        @elseif($teamLeader)
                                        <label for="target_money"><strong>Target Booking Money</strong></label>
                                        <input type="number" id="target_money" value="{{$teamLeader->target_money}}" name="target_money" class="form-control my-2">
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        @if ($employee)
                                        <label for="target_S_to_C"><strong>Target Lead to Investor</strong></label>
                                        <input type="text" id="target_S_to_C" value="{{$employee->target_S_to_C ?? ''}}" name="target_S_to_C" class="form-control my-2">
                                        @elseif($teamLeader)
                                        <label for="target_S_to_C"><strong>Target Lead to Investor</strong></label>
                                        <input type="text" id="target_S_to_C" value="{{$employee->target_S_to_C ?? ''}}" name="target_S_to_C" class="form-control my-2">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if ($employee)
                                        <label for="target_installment"><strong>Target Installment Money</strong></label>
                                        <input type="text" id="target_installment" value="{{$employee->target_installment}}" name="target_installment" class="form-control my-2">
                                        @elseif($teamLeader)
                                        <label for="target_installment"><strong>Target Installment Money</strong></label>
                                        <input type="text" id="target_installment" value="{{$teamLeader->target_installment}}" name="target_installment" class="form-control my-2">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="booking_ratio" class="my-2"><strong>Booking Ratio</strong></label>
                                        <input type="text" id="booking_ratio" value="{{$test->booking_ratio}}" name="booking_ratio" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="installment_ratio" class="my-2"><strong>Installment Ratio</strong></label>
                                        <input type="text" id="installment_ratio" value="{{$test->installment_ratio}}" name="installment_ratio" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cmo">Choose a CMO</label>
                                        <select id="cmo" name="cmo" class="form-control">
                                            <option value="">Select CMO</option>
                                            @foreach($cmo as $item)
                                            <option value="{{$item->id}}" {{ $test->cmo == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="gm">Choose a GM</label>
                                        <select id="gm" name="gm" class="form-control">
                                            <option value="">Select GM</option>
                                            @foreach($gm as $item)
                                            <option value="{{$item->id}}" {{ $test->gm == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12">
                                <input type="submit" value="Submit" class="btn btn-primary my-3">
                            </div>
                        </div>
                    </form>
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

                url: '/ratio',
                type: 'get',
                dataType: 'json',
                data: 'user_role=' + user_role,
                success: function(data) {
                    console.log(data)
                    $('#booking_ratio').val(data[0]);
                    $('#installment_ratio').val(data[1]);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush
