@extends('backend.partials.app')
@section('title')
    Role
@endsection
@section('content')
@push('css')

<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
    <div class="container customer-container">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body" style="background: #a8cc66;">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
						<div class="area-h3">
							<h2>Role List</h2> </div>

						<div class="btn-customer" style="margin-top:10px;">
                        <a href="{{route('add.role')}}" class="btn btn-primary" title="Add Role" ><i class="fa-solid fa-plus"></i> Add Role</a>

						</div>
                        </div>
                        <table class="table table-hover table-bordered" id="example">
                            <thead>
                            <tr>
                                <th>SI</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @foreach($role as $roles)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$roles->role_name}}</td>
                                    <td>
                                        <a href="{{route('edit.role',$roles->id)}}" title="Edit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="{{route('delete.role',$roles->id)}}" title="Delete" class="btn btn-danger" onclick="return confirm('Are you sure delete this!')"><i class="fa-solid fa-trash"></i></a>
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
@endsection
@push('js')
	<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
	<script>
	new DataTable('#example', {
		select: true
	});
	</script>
@endpush
