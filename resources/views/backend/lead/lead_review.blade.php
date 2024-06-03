@extends('backend.partials.app')
@section('content')
<div class="container mt-3" style="margin-bottom:350px;">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('review.lead',$task->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="review"><b>Review Details</b></label>
                            <textarea name="review" id="review" class="form-control my-2"></textarea>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection