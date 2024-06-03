@extends('backend.partials.app')
@section('title')
    Add Role
@endsection
@section('content')
    <div class="container customer-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-2">
                    <div class="card-head mx-5 my-3 customer-card">
                        <div class="left">
                            <h3>Role Create</h3>
                        </div>
                        <div class="search">
                            <a href="{{route('role')}}" class="btn btn-primary" title="Add Category">
                                <i class="fa-sharp fa-solid fa-list"></i>
                                Role List</a>
                        </div>
                    </div>
                </div>
                @include('error')
                <div class="card">
                    <div class="card-body" style="background: #a8cc66;">
                        <div class="col-lg-8">
                            <form action="{{route('store.role')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="role_name"><strong>Role Name</strong></label>
                                    <input type="text" id="role_name" name="role_name" placeholder="Role Name" class="form-control my-2">
                                </div>
                                <div class="form-group">
                                    <label for="booking_ratio"><strong>Booking Ratio</strong></label>
                                    <select id="booking_ratio" name="booking_ratio" class="form-control my-2">
                                        <option value="">Select Booking Ratio</option>
                                        <option value="0.25">0.85</option>
                                        <option value="2.00">3.50</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="installment_ratio"><strong>Installment Ratio</strong></label>
                                    <select id="installment_ratio" name="installment_ratio" class="form-control my-2">
                                        <option value="">Select Installment Ratio</option>
                                        <option value="0.25">0.25</option>
                                        <option value="2.00">2.00</option>
                                    </select>
                                </div>
                                <input type="submit" value="Submit" class="btn btn-primary my-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






