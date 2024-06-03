@extends('backend.partials.app')
@section('title')
Admin List
@endsection
@section('content')
@push('css')
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
	h3,
	h1,
	h2,
	h5,
	h6,
	p,
	td,
	th,
	table,
	tr span {
		color: black
	}
</style>
@endpush
<div class="container offer-container">
	<div class="row margin-offer">
		<div class="col-lg-12">

		</div> -->@include('error')
		<div class="card">
			<div class="card-body">
				<div class="customer-card mb-3" style="margin-top:-10px;">
					<div class="area-h3">
						<h2>Admin List</h2>
					</div>

					<div class="btn-customer" style="margin-top:10px;">
						<a href="{{ route('create-admin') }}" class="btn btn-primary" title="Add Category">
							<i class="fa-solid fa-plus"></i> Create Staff</a>
					</div>
				</div>
				<table class="table table-hover table-bordered" id="example">
					<thead>
						<tr>
							<th>SI</th>
							<th>Name</th>
							<th>Designation</th>
							<th>Mobile</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($list as $key => $lists)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $lists->name }}</td>
							<td>{{ $lists->designation }}</td>
							<td>
								@php
								$employee = App\Models\Employee::where('authId', $lists->id)->first();
								@endphp

								@if ($employee)
								{{ $employee->phone }}
								@else
								<p>Phone number not available</p>
								@endif
							</td>
							<td> <a href="{{ route('showEditAdmin',$lists->id) }}" title="Edit" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></a> 
							<a href="{{ route('deleteAdmin',$lists->id) }}" title="Delete" class="btn btn-danger" id="delete"><i class="fa-solid fa-trash"></i></a> </td>
						</tr>
						@endforeach
					</tbody>
				</table>

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