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
                        <h2 class="modal-title" id="exampleModalLabel">Update TeamLeader</h2>
                        <a href="{{route('employee')}}" class="btn btn-primary">TeamLeader List</a>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-2">
                            <label for="name">Name</label>
                            <input class="form-control my-2" type="text" value="{{$teamLader->name}}" name="name" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email</label>
                            <input class="form-control my-2" type="email" value="{{$teamLader->email}}" name="email" id="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone</label>
                            <input class="form-control my-2" type="number" value="{{$teamLader->phone}}" name="phone" id="phone" placeholder="Enter Phone">
                        </div>
                        <div class="form-group my-2">
                            <label for="designation">Designation</label>
                            <input class="form-control my-2" type="text" value="{{$teamLader->designation}}" name="designation" id="designation" placeholder="Enter Profession">
                        </div>
                        
                        <div class="form-group my-2">
                            <label for="image">Image</label>
                            <input class="form-control my-2" type="file" name="image" id="image">
                            <img src="{{asset($teamLader->image)}}" width="50" height="50" alt="">
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
