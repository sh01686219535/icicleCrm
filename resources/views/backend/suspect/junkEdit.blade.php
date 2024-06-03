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
    th {
        color: #fff !important;
    }

    tr:nth-child(odd) td:hover {
        color: white;
      
    }

    tr:nth-child(even) td:hover {
        color: white;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
<!-- Hoverable Table rows -->
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body" style="background: #a8cc66;">
                    @include('error')
                    <div class="customer-card">
                        <h2 class="modal-title" id="exampleModalLabel">Update Junk Lead</h2>
                        <a href="{{route('junk.suspect.list')}}" class="btn btn-primary">Junk List</a>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group my-2">
                            <label for="project_name">Comments</label>
                            <input class="form-control" value="{{$lead->comments}}" type="text" name="comments" id="project_name" placeholder="Enter Project Name">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sales_officer').select2();
        $('#team_leader').select2();
    });
</script>
@endpush
