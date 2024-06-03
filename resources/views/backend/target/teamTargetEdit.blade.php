@extends('backend.partials.app')
@section('title')
Edit Target Assign
@endsection
@section('content')
<div class="container customer-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-2">
                <div class="card-head mx-5 my-3 customer-card" style="display: flex;justify-content:space-between">
                    <div class="left">
                        <h3>Target Assing Update</h3>
                    </div>
                    <div class="search">
                        <a href="{{route('target.assign.admin')}}" class="btn btn-primary" title="Add Category">
                            <i class="fa-sharp fa-solid fa-list"></i>
                            Target Assing List</a>
                    </div>
                </div>
            </div>
            @include('error')
            <div class="card">
                <div class="card-body">
                    <form action="{{route('update.assign.team',$target->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="teamLead">Sales Person</label>
                                    <select name="employee_id" id="teamLead" class="form-control my-2">
                                        <option value="">Select Sales Person</option>
                                        @foreach($employee as $item)
                                        <option value="{{$item->id}}" {{ $target->employee_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="amount">Target Money</label>
                                    <input type="text" value="{{$target->targetAmount ?? ''}}" name="targetAmount" id="amount" class="form-control my-2" placeholder="Enter Target Amount">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection