@extends('backend.partials.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Profile</h5>

                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-4">

                                        <div class="card-body">
                                            @if (session('success'))
                                            <div class="alert slert-success timeout" style="color: green">{{ session('success') }}</div>
                                            @elseif (session('error'))
                                            <div class="alert slert-danger timeout">{{ session('error') }}</div>

                                            @endif
                                            <div class="col-lg-12 col-md-12 col-sm-12" style="margin:0 auto">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6">
                                                    <form method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-11">
                                                                @if ($auth->image)
                                                                <img src="{{asset($auth->image)}}" alt="" style="width:200px;height:200px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="image-style mb-3">
                                                                @else
                                                                <img style="width:200px;height:200px;border-radius:50%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                                                @endif
                                                                <input type="file" class="form-control my-2" name="image" id="image" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-6">
                                                            <div class="col-md-11">
                                                                <label class="form-label" for="basic-default-name">Name</label>
                                                                <input type="text" class="form-control" value="{{$auth->name}}" name="name" id="basic-default-name" placeholder="Enter Name" />
                                                            </div>
                                                        </div>
                                                        <div class="row mb-6">
                                                            <div class="col-md-11">
                                                                <label class="form-label" for="basic-default-name">Email</label>
                                                                <input type="text" class="form-control" value="{{$auth->email}}" name="email" id="basic-default-name" placeholder="Enter Email" />
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row mb-6">
                                                            <div class="col-md-11">
                                                                <label class="form-label" for="password">Password</label>
                                                                <input type="password" id="password" class="form-control" name="password" id="password"/>
                                                            </div>
                                                        </div> -->
                                                        <div class="row mb-6">
                                                            <div class="col-md-11">
                                                                <label class="form-label" for="basic-default-name">User Role</label>
                                                                <input type="text" class="form-control" value="{{$auth->role->role_name}}" name="user_role" id="basic-default-name" placeholder="Enter Email" />
                                                            </div>
                                                        </div>

                                                        <div class="row mb-6">
                                                            <div class="col-md-11">
                                                                <label class="form-label" for="basic-default-name">Designation</label>
                                                                <input type="text" class="form-control" value="{{$auth->designation}}" name="designation" id="basic-default-name" placeholder="Enter Email" />
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="row mb-6 mt-3">
                                                            <div class="col-md-4">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $('#image').change('click', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endpush