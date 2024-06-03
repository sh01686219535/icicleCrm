@extends('backend.partials.app')
@push('css')
<style>
    .customer-card {
        display: flex;
        justify-content: space-between;
    }

    .customer-container {
        margin: 0 0 310px 0;
    }

    h3,
    h1,
    h2,
    h5,
    h6,
    p,
    td,
    table,
    tr span {
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
@section('content')

<!-- Hoverable Table rows -->
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" >
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3">
                            <h2>Client List</h2>
                        </div>


                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-borderd" id="example">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>File Number</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Agreed Price</th>
                                    <th>Booking Amount</th>
                                    <th>Per inst. Amount</th>
                                    <th>Comments</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investor as $investors)
                                <tr>
                                    <td>{{$investors->serial_number}}</td>
                                    <td>{{$investors->fileNumber}}</td>
                                    <td>{{$investors->name}}</td>
                                    <td>{{$investors->phone}}</td>
                                    <td>{{$investors->allow_amount}}</td>
                                    <td>{{$investors->down_payment}}</td>
                                    <td>{{$investors->inst_per_month}}</td>
                                    <!-- Modal -->
                                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> --}}
                                        <div class="modal fade" id="exampleModal{{ $investors->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $investors->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('fileUpdate',$investors->id) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">File Upload</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label for="">File Upload</label>
                                                        <input type="file" name="file" class="form-control">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" class="btn btn-secondary">
                                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <td>{{Str::limit($investors->comments,10)}}</td>
                                    <td>
                                        <img src="{{asset($investors->user_image)}}" width="50" height="50" alt="">
                                    </td>
                                    <td width="100%" style="white-space:nowrap;">
                                        <a class="btn btn-secondary" title="View" href="{{ route('investor_org_show',$investors->id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-info" title="Edit" href="{{ route('investor_show',$investors->id) }}"><i class="fas fa-edit"></i></a>

                                        <a class="btn btn-primary" title="Print" href="{{ route('investor.list',$investors->id) }}"><i class="fas fa-print"></i></a>
                                        <a class="btn btn-dark" title="Booking Money Receipt" href="{{ route('bookingPdf',$investors->id) }}"><i class="fas fa-receipt"></i></a>
                                        <a class="btn btn-success" title="Down Payment Reciept" href="{{ route('downPdf',$investors->id) }}"><i class="fas fa-receipt"></i></a>

                                        <a class="btn btn-warning" title="Payment History" href="{{ route('investorPayment.pdf',$investors->id) }}"><i class="fa-solid fa-list"></i></a>
                                        <a class="btn btn-dark" title="File Upload" style="color:white;" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $investors->id }}"><i class="fa-solid fa-file-import" style="color:white"></i></a>
                                        <a class="btn btn-warning" title="File Download" href="{{ route('fileDownload.pdf',$investors->id) }}"><i class="fa-solid fa-download"></i></a>
                                        {{-- <a class="btn btn-danger " id="delete" href="{{ route('investor_delete',$investors->id) }}"><i class="fas fa-trash"></i></a> --}}
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
</div>
<!--/ Hoverable Table rows -->



@endsection
@push('js')
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#example', {
        select: true
    });

</script>
@endpush
