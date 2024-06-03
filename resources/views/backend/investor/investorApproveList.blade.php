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
    h3, h1, h2, h5, h6, p, td, table, tr span{
        color: black
    }
    /* th {
        color: #fff !important;
    }

    tr:nth-child(odd) td:hover {
        color: white;
      
    }

    tr:nth-child(even) td:hover {
        color: white;
    } */

</style>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3">
                            <h2>Client Approve List</h2>
                        </div>
                    </div>
                    <table class="table table-hover table-borderd" id="example">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>File Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody> @foreach($investor as $investors)
                            <tr>
                                <td>{{$investors->serial_number}}</td>
                                <td>{{$investors->fileNumber}}</td>
                                <td>{{$investors->name}}</td>
                                <td>{{$investors->email}}</td>
                                <td>
                                    <a href="{{ route('approve',$investors->id) }}" title="Delete" class="btn btn-info"><span class="btn btn-info">Approve</span></a>
                                </td>
                                <td>
                                    <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" href=""><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-info" href="{{ route('investor_admin_show',$investors->id) }}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger" id="delete" href="{{ route('investor_delete',$investors->id) }}"><i class="fas fa-trash"></i></a>
                                </td>
                                {{-- modal --}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('commentPost',$investors->id) }}" method="post">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Approve Comment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea class="form-control" name="comments" id="comments" cols="30" rows="10"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </tr> @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Hoverable Table rows -->


<!-- Modal -->

@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });

</script>
@endpush
