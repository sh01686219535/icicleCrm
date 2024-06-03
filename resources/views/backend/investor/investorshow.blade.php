@extends('backend.partials.app')

@push('css')
<style>
    .form-section {
        display: none;
    }

    .form-section.current {
        display: inherit;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- --}}
@endpush
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Edit Client</h5>
                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body" >
                                            @if (session('success'))
                                            <div class="alert slert-success timeout" style="color: green">{{ session('success') }}</div>
                                            @elseif (session('error'))
                                            <div class="alert slert-danger timeout">{{ session('error') }}</div>
                                            @endif
                                            @include('error')


                                            <form class="form-demo" method="POST" enctype="multipart/form-data">
                                                @csrf

                                                {{-- 2nd step --}}
                                                <div class="form-section">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3 d-none">

                                                            <input type="hidden" id="serial_number" name="serial_number" value="{{ $investor->serial_number }}" readonly>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="fullname">Applicant's Full Name</label>
                                                            <input type="text" class="form-control" name="name" value="{{ $investor->name }}" id="fullname" placeholder="Enter Applicant's Full Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="fileNumber">File Number</label>
                                                            <input type="text" class="form-control" name="fileNumber" value="{{ $investor->fileNumber }}" id="fileNumber" placeholder="Enter File Number" />
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <label class="form-label my-2" for="banglaname">আবেদনকারীর নাম (বাংলায়)</label>
                                                            <input type="text" class="form-control" name="bangla_name" id="banglaname" placeholder="আবেদনকারীর নাম (বাংলায়)" />
                                                        </div> -->
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="fathers_name">Father's Name</label>
                                                            <input type="text" class="form-control" name="fathers_name" id="fathers_name" value="{{ $investor->fathers_name }}" placeholder="Enter Father's Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="mothers_name">Mother's Name</label>
                                                            <input type="text" class="form-control" name="mothers_name" value="{{ $investor->mothers_name }}" id="mothers_name" placeholder="Enter Mother's Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="spouse_name">Spouse Name (If any)</label>
                                                            <input type="text" class="form-control" name="spouse_name" id="spouse_name" value="{{ $investor->spouse_name }}" placeholder="Enter Spouse Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="spouse_date_birth">Birth Date (Spouse)</label>
                                                            <input type="text" class="form-control" name="spouse_date_birth" id="spouse_date_birth" value="{{ $investor->spouse_date_birth }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="birth_date">Date of Birth</label>
                                                            <input type="text" class="form-control" placeholder="Enter Date of Birth" name="birth_date" value="{{ $investor->birth_date }}" id="birth_date" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Marriage">Marriage Day</label>
                                                            <input type="text" class="form-control" placeholder="Enter Marriage Day" name="marriage" value="{{ $investor->marriage }}" id="Marriage" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="present_address">Present/Mailing Address</label>
                                                            <input type="text" class="form-control" placeholder="Enter Present/Mailing Address" name="present_address" id="present_address" value="{{ $investor->present_address }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="permanent_address">Permanenet Address</label>
                                                            <input type="text" class="form-control" name="permanent_address" id="permanent_address" placeholder="Enter Permanenet Address" value="{{ $investor->permanent_address }}" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="phone">Phone Number</label>
                                                            <input type="number" class="form-control" name="phone" id="phone" value="{{ $investor->phone }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="alternativePhone">Alternative Number</label>
                                                            <input type="number" class="form-control" name="alternativePhone" id="alternativePhone" value="{{ $investor->alternativePhone }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="email">Email Address<span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control" name="email" id="email" value="{{ $investor->email }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="facebook">Facebook Id</label>
                                                            <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $investor->facebook }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Profession">Profession</label>
                                                            <input type="text" class="form-control" name="profession" id="Profession" value="{{$investor->profession }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Religion">Religion</label>
                                                            <input type="text" class="form-control" name="religion" id="Religion" value="{{$investor->religion }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="office_address">Office Address</label>
                                                            <input type="text" class="form-control" name="office_address" id="office_address" value="{{$investor->office_address }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nid_passport">Nid Number</label>
                                                            <input type="text" class="form-control" placeholder="Enter Nid Number/Passport" name="nid_passport" id="nid_passport" value="{{$investor->nid_passport }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2 dummy" for="passport">Passport Number</label>
                                                            <input type="text" value="{{ $investor->passport }}" class="form-control" name="passport" id="passport" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Nationality">Nationality</label>
                                                            <input type="text" value="Bangladeshi" class="form-control" name="nationality" id="Nationality" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Project Name</label>
                                                            <input type="text" class="form-control" name="project_name" id="project_name" value="{{$investor->project_name}}" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Project Address Name</label>
                                                            <input type="text" class="form-control" name="project_address" id="project_address" value="{{$investor->project_address}}" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="ownership_size">Suite/Ownership size(Sft)</label>
                                                            <input type="number" class="form-control" name="ownership_size" id="ownership_size" value="{{$investor->ownership_size }}" onchange="calculateOwnership()" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="category_ownership">Category Of Ownership</label>
                                                            <select class="form-control" name="category_ownership" id="category_ownership">
                                                                <option value="">Select Categgory</option>
                                                                <option value="Executive" {{ $investor == 'Executive' ? 'selected' : ''}}>Executive</option>
                                                                <option value="Premium" {{ $investor == 'Premium' ? 'selected' : ''}}>Premium</option>
                                                                <option value="Royal" {{ $investor == 'Royal' ? 'selected' : ''}}>Royal</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="no_ownership">No. Of Ownership</label>
                                                            <input type="number" class="form-control" name="no_ownership" id="no_ownership" value="{{$investor->no_ownership }}" onkeyup="calculateOwnership()" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="price_ownership">Price per Ownership</label>
                                                            <input type="number" class="form-control" name="price_ownership" id="price_ownership" value="{{$investor->price_ownership }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="price_ownership_word">Price per Ownership(In Word)</label>
                                                            <input type="text" class="form-control" name="price_ownership_word" id="price_ownership_word" value="{{$investor->price_ownership_word }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="agreed_price">Total Price</label>
                                                            <input type="number" class="form-control" name="agreed_price" id="totalPrice" value="{{$investor->agreed_price }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="agreed_price_word">Total Price(In Word)</label>
                                                            <input type="text" class="form-control" name="agreed_price_word" id="agreed_price_word" value="{{$investor->agreed_price_word }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="special_discount">Special Discount</label>
                                                            <input type="number" class="form-control" name="special_discount" id="special_discount" value="{{$investor->special_discount }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="special_discount_word">Special Discount(In Word)</label>
                                                            <input type="text" class="form-control" name="special_discount_word" id="special_discount_word" value="{{$investor->special_discount_word }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="main_amount">Main Amount</label>
                                                            <input type="number" class="form-control" name="main_amount" id="main_amount_first" value="{{$investor->main_amount }}" />
                                                        </div>
                                                        <div class="col-md-12 d-flex mt-4">
                                                            <label for="" class="form-label dummy">Mode Of Payment</label>
                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="Installment" name="installment" value="Installment" {{ $investor->installment === 'Installment' ? 'checked' : '' }}>
                                                                <label class="form-label" for="Installment">Per Month</label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="quarterly" name="quarterly" value="Quarterly" {{ $investor->quarterly === 'Quarterly' ? 'checked' : '' }}>
                                                                <label class="form-label dummy" for="quarterly">Quarterly</label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="half_yearly" name="half_yearly" value="Half_yearly" {{ $investor->half_yearly === 'Half_yearly' ? 'checked' : '' }}>
                                                                <label class="form-label dummy" for="half_yearly">Half Yearly</label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="yearly" name="yearly" value="Yearly" {{ $investor->yearly === 'Yearly' ? 'checked' : '' }}>
                                                                <label class="form-label dummy" for="yearly">Yearly</label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="at_a_time" name="at_a_time" value="At_a_time" {{ $investor->at_a_time === 'At_a_time' ? 'checked' : '' }}>
                                                                <label class="form-label dummy" for="at_a_time">At a Time</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="basic-default-name">USER Image</label>
                                                            <input type="file" class="form-control my-2" name="user_image" id="image" />
                                                            <img style="width:200px;height:200px" id="showImage" src="{{asset($investor->user_image) }}" alt="" class="image-style mb-3">
                                                        </div>

                                                    </div>

                                                </div>
                                                {{-- 3rd step --}}
                                                <div class="form-section">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment">Booking Money Payment Tk.</label>
                                                            <input type="text" class="form-control" value="{{$investor->down_payment }}" name="down_payment" id="down_payment" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment_date">Booking Money Payment Date</label>
                                                            <input type="text" class="form-control" name="down_payment_date" id="down_payment_date" value="{{$investor->down_payment_date }}" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment_inWord">Booking Money Payment(In Word)</label>
                                                            <input type="text" class="form-control" name="down_payment_inWord" id="down_payment_inWord" value="{{$investor->down_payment_inWord }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="payment_type2">Payment Type</label>
                                                            <select class="form-control" name="payment_type2" id="payment_type2">
                                                                <option value="cash" {{ $investor->payment_type2 == 'cash' ? 'selected' : '' }}>Cash</option>
                                                                <option value="chq" {{ $investor->payment_type2 == 'chq' ? 'selected' : '' }}>CHQ</option>
                                                                <option value="Online_Payment" {{ $investor->payment_type2 == 'Online_Payment' ? 'selected' : '' }}>Online Payment (Bank to Bank)</option>


                                                            </select>
                                                        </div>

                                                        <div class="col-md-3" >
                                                            <label class="form-label my-2" for="chq">CHQ No.</label>
                                                            <input type="text" class="form-control" name="chq" id="chq" value="{{ $investor->chq }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="bank_name">Bank Name</label>
                                                            <input type="text" class="form-control" name="bank_name" value="{{ $investor->bank_name }}" id="bank_name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="branch_name">Branch Name</label>
                                                            <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ $investor->branch_name }}" />
                                                        </div>



                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="payment_type_date2">Payment Date</label>
                                                            <input type="text" class="form-control" name="payment_type_date2" id="payment_type_date2" value="{{$investor->payment_type_date2 }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="no_of_installment">No. Of Installment</label>
                                                            <input type="text" class="form-control" name="no_of_installment" id="no_of_installment" value="{{$investor->no_of_installment }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_per_month">Inst. per Month Tk.</label>
                                                            <input type="number" class="form-control" name="inst_per_month" id="inst_per_month" value="{{$investor->inst_per_month }}" onblur="roundAndSetInputValue('inst_per_month')" />
                                                        </div>
                                                        {{-- main --}}
                                                        <div class="col-md-3">

                                                            <label class="form-label my-2" for="main_amount">Main Amount</label>
                                                            <input type="number" class="form-control" name="main_amount" id="main_amount" value="{{$investor->main_amount }}" onblur="roundAndSetInputValue('main_amount')" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_start">Installment Start</label>
                                                            <input type="date" class="form-control" value="{{$investor->start_from }}" name="start_from" id="inst_start" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_to">Installment End</label>
                                                            <input type="date" class="form-control" name="start_to" id="inst_to" value="{{$investor->start_to }}" />
                                                        </div>

                                                        <div class="col-md-3 mb-4">
                                                            <label class="form-label my-2" for="others_instruction">Enter Others Description (if any)</label>
                                                            <textarea class="form-control" name="others_instruction" id="others_instruction" >{{$investor->others_instruction }}</textarea>

                                                        </div>
                                                        <div class="col-md-3 mb-4">
                                                            <label class="form-label my-2" for="allow_amount">Agreed Price</label>
                                                            <input value="{{ $investor->allow_amount }}" class="form-control" name="allow_amount" id="allow_amount">

                                                        </div><br>
                                                        <hr>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nominee_name">Nominee Name</label>
                                                            <input type="text" class="form-control" value="{{$investor->nominee_name }}" name=" nominee_name" id="nominee_name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nominee_cell_no">Nominee Cell Number</label>
                                                            <input type="number" class="form-control" name="nominee_cell_no" id="nominee_cell_no" value="{{$investor->nominee_cell_no }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Relation to Nominee</label>
                                                            <input type="text" class="form-control" name="relation_to_nominee" id="relation_to_nominee" value="{{$investor->relation_to_nominee }}" />
                                                        </div>

                                                        {{-- multiple --}}
                                                        <div class="col-md-5">
                                                            <label class="form-label my-3" for="id_employee">Sales Person</label>
                                                            <select class="form-control" style="width: 50%;" name="employee_id" id="id_employee">
                                                                <option value="">Choose Employee</option>
                                                                @foreach($employee as $employees)

                                                                <option value="{{ $employees->id }}" {{ $employees->id == $investor->employee_id ? 'selected' : '' }}>
                                                                    {{ $employees->name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label my-3" for="team_leader">Assist By</label>
                                                            <select class="form-control" style="width: 50%;" name="team_leader" id="team_leader">
                                                                <option value="">Choose Team Leader</option>
                                                                @foreach($team_lead as $value)
                                                                <option value="{{ $value->id }}" {{ $value->id == $investor->team_leader ? 'selected' : '' }}>{{ $value->name }}

                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        {{-- multiple --}}

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_name_a">Reference Name (A)</label>
                                                            <input type="text" class="form-control" name="reference_name_a" id="reference_name_a" value="{{$investor->reference_name_a }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_cell_a">Reference Cell Number (A)</label>
                                                            <input type="number" class="form-control" name="reference_cell_a" id="reference_cell_a" value="{{$investor->reference_cell_a }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_name_a">Reference Name (B)</label>
                                                            <input type="text" class="form-control" name="reference_name_b" id="reference_name_b" value="{{$investor->reference_name_b }}" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_cell_a">Reference Cell Number (B)</label>
                                                            <input type="number" class="form-control" name="reference_cell_b" id="reference_cell_b" value="{{$investor->reference_cell_b }}" />
                                                        </div>

                                                        {{-- <div class="col-md-5">
                                                            <label class="form-label my-3" for="id_employee">Assist By</label>
                                                            <select class="form-control" style="width: 50%;" name="employee_id[]" id="id_employee" multiple>
                                                                @foreach($employee as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div> --}}
                                                    {{-- <div class="col-md-5">
                                                            <label class="form-label my-3" for="team_leader">Sales Person</label>
                                                            <select class="form-control" style="width: 50%;" name="team_leader[]" id="team_leader" multiple>
                                                                @foreach($team_lead as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div> --}}
                                                <div class="col-md-3">
                                                    <label class="form-label my-2" for="nominee_image">Nominee Image</label>
                                                    <input type="file" class="form-control my-2" name="nominee_image" id="nominee_image" />
                                                    <img style="width:200px;height:200px" id="showNImage" src="{{ asset($investor->nominee_image) }}" alt="" class="image-style mb-3">

                                                </div>

                                        </div>
                                    </div>
                                    <div class="form-section">
                                        <div class="row mb-2">
                                            <h3 class="card-title text-primary text-center" style="text-transform: uppercase"> Declaration</h3>
                                            <p>I do hearby declare that the information given herein is true to the best of my knowledge and beleif declare that i have gone through the same. I understand that in the best interest of all, Company shall transfer the suite ownership got by executing a service agreement in favor of Allottee & the project shall always be under the overall control & pervision of the company before and after construction or handover and i agree to become a suit/ownership holder of the project and abide by the rules and regulations formed by the Hotel Management i accept the company's absolute right either to accept or reject my application of booking for the ownership of a Slot/Unit</p>
                                        </div>
                                        <div class="row mb-2">
                                            <h3 class="card-title text-primary text-center" style="text-transform: uppercase"> Terms & Conditions</h3>
                                            <h4>Booking</h4>
                                            <p>After selecting an Ownership slot of a Suite the prescribed booking form should be duly filled and signed by the applicant along with the booking money and other required documents like 4 copies photo & NID Card/Passport Copies which will be received by authorized person of Chuti Resort Ltd.and this sale shall be approved accordingly . However, the company reseves the right to disapprove any sale applion for not fulfilling the appropriate information or for any other resons.
                                            </p>
                                            <h4>Allotment</h4>
                                            <p>Alotment shall be made on "first come first seve" basis on receipt fo the booking money along with application form. On acceptance of a booking application and realization at least 30% down payment of the total price. Chuti Resort Ltd. Shall issue a provisional allotment agreement.
                                            </p>
                                            <h4>Schedule of payment</h4>
                                            <p>An amount of BDT.100,000 (One Lac) for each Ownership is payable at the time of booking and down payment is 20% of total saleable price which shall be made within 30 days form the booking date. For installments,rest of the amount shall be divided equally with the number of installments as monthly payable. Installment shall be paid exactly after one month from the date of booking. Allottee(s) shall be liable to pay 3% charges for total amount on delaying any payable amount mentioned above schedule.Company may cancel the booking /allotment/sale for delaying in down payments realization if exceeds 45 days from the date of booking .If any payment is not paid by above menetioned shedule then total discounted amount will be added with the agreed saleable price.
                                            </p>
                                            <h4>Mode of Payment</h4>
                                            <p>All payment of booking money, full price, down payment, installments, registration fees and any other charges shall be made by Account Payee Cheque/ Bank Draft or Pay Order in favor of Chuti Resort Ltd. Non residence Bangladesh may remit by TT or DD directly through bank in name of Chuti Resort Ltd.
                                            </p>
                                            <h4>Cancellation of Allotmenet</h4>
                                            <p>In case of nonpayment of total price (for full payment sale) and down payment within previously mentioned time or nonpayment of installments for 2 (two) times, company shall have the right to cancel the allotment. In such event, the amount paid by the Allottee shall refund 80% of total deosited amount and additionally BDT.10,000.00 (Ten Thousand Only) will be deducted as cancellation proceeding fee for each Ownership Slot after 365 days of successfully reselling the Ownership.Cancellation by Allotttee shall have the sam procedure for refund.
                                            </p>
                                            <h4>Sale Rights</h4>
                                            <p>Chuti Resort Ltd. reserves full right to Suite Ownership Slot.
                                            </p>
                                            <h4>Company`s Right</h4>
                                            <p>The Company reserves the right to make any changes /modification on the above Terms & Condition layout plan or condition of the project if those becme absolutely necessary or for any kind of Government Policy.
                                            </p>
                                        </div>


                                    </div>


                                    <div class="form-navigation">
                                        <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
                                        <button type="button" class="next btn btn-info pull-right">Next &gt;</button>

                                        <button type="submit" class="btn btn-success pull-right">Update</button>
                                        <span class="clearfix"></span>
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
@endsection
@push('js')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- sharif code  --}}
<script>
    $(document).ready(function() {
        //investor Image
        $('#image').change('click', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        //nominee image
        $(document).ready(function() {
            $('#nominee_image').change('click', function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showNImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    });
    setTimeout(() => {
        $('.timeout').fadeOut('slow')
    }, 3000);
    //
    // Initially hide all the input fields
    // Hide all input fields initially
    $("#chqDiv, #poDiv, #ttDiv, #ddDiv, #bank_nameDiv, #branch_nameDiv").hide();

    // Show/hide input fields based on dropdown selection
    // $("#payment_type2").change(function() {
    //     console.log("Dropdown value changed:", $(this).val()); 

    //     $("#chqDiv, #poDiv, #ttDiv, #ddDiv, #bank_nameDiv, #branch_nameDiv").hide();

    //     var selectedValue = $(this).val();

    //     if (selectedValue === "chq") {
    //         $("#chqDiv").show();
    //     } else if (selectedValue === "Online_Payment") {
    //         $("#bank_nameDiv, #branch_nameDiv").show();
    //     }
    // });
    //select 2
    $(document).ready(function() {
        $('#id_employee').select2();
        $('#team_leader').select2();
    });
    // Calculate Total Amount
    // Use keyup method for real-time updates
    $('#no_ownership, #price_ownership,#special_discount,#down_payment,#no_of_installment').on('keyup', function() {
        var $no_ownership = $('#no_ownership').val();
        var $price_ownership = $('#price_ownership').val();
        var $special_discount = $('#special_discount').val();
        var $down_payment = $('#down_payment').val();
        var $no_of_installment = $('#no_of_installment').val();

        if (!isNaN($no_ownership) && !isNaN($price_ownership)) {
            // Calculate and update the agreed_price value
            $totalAmount = $no_ownership * $price_ownership;
            $mainAmount = ($totalAmount - $special_discount).toFixed(2);
            $totalMianAmount = $mainAmount - $down_payment;
            $('#totalPrice').val($totalAmount);
            $('#main_amount_first,#main_amount').val($totalMianAmount);
            //no of owenership
            $('#inst_per_month').val(($totalMianAmount / $no_of_installment).toFixed(2));

        } else {
            console.error("Invalid input values. Please enter valid numbers.");
        }
    });
    //revesly
    $('#main_amount,#inst_per_month').on('keyup', function() {
        var $main_amount = $('#main_amount').val();
        var $inst_per_month = $('#inst_per_month').val();


        $('#no_of_installment').val(Math.round(parseFloat($main_amount)) / Math.round(parseFloat($inst_per_month)));
    })

    // monthly increment
    $('#inst_start').on('change', function() {
        var startMonth = $(this).val();
        var noInstallment = $('#no_of_installment').val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);
            var endDate = new Date(startDate);
            if (startDate.getDate() < 10) {
                endDate.setMonth(startDate.getMonth() + parseInt(noInstallment));

            } else {
                endDate.setMonth(startDate.getMonth() + parseInt(noInstallment) - 1);

            }

            // Calculate end date based on the number of installments (monthly increment)


            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    });

    $('#no_of_installment').on('input', function() {
        var startMonth = $('#inst_start').val();
        var noInstallment = $(this).val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);
            var endDate = new Date(startDate);

            // Calculate end date based on the number of installments (monthly increment)
            if (startDate.getDate() < 10) {
                endDate.setMonth(startDate.getMonth() + parseInt(noInstallment));

            } else {
                endDate.setMonth(startDate.getMonth() + parseInt(noInstallment) - 1);

            }

            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    });

    function formatDate(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; // January is 0!
        var yyyy = date.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        return yyyy + '-' + mm + '-' + dd;
    }
    // Quarter Month
    $('#quarterly').on('change', function() {
        if ($(this).prop('checked')) {
            // Execute the date calculation logic only if the "Quarterly" checkbox is checked

            $('#inst_start').on('change', calculateEndDate);
            $('#no_of_installment').on('input', calculateEndDate);
        } else {
            // If the "Quarterly" checkbox is not checked, remove event handlers
            $('#inst_start').off('change', calculateEndDate);
            $('#no_of_installment').off('input', calculateEndDate);
        }
    });

    function calculateEndDate() {
        var startMonth = $('#inst_start').val();
        var noInstallment = $('#no_of_installment').val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);

            // Calculate end date based on the number of installments (monthly increment)
            var endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() - 1 + parseInt(noInstallment) * 3);

            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    }

    function formatDate(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; // January is 0!
        var yyyy = date.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        return yyyy + '-' + mm + '-' + dd;
    }
    // Half Yearly

    $('#half_yearly').on('change', function() {
        if ($(this).prop('checked')) {
            // Execute the date calculation logic only if the "Quarterly" checkbox is checked

            $('#inst_start').on('change', calculateHalfEndDate);
            $('#no_of_installment').on('input', calculateHalfEndDate);
        } else {
            // If the "Half Yearly" checkbox is not checked, remove event handlers
            $('#inst_start').off('change', calculateHalfEndDate);
            $('#no_of_installment').off('input', calculateHalfEndDate);
        }
    });

    function calculateHalfEndDate() {
        var startMonth = $('#inst_start').val();
        var noInstallment = $('#no_of_installment').val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);

            // Calculate end date based on the number of installments (monthly increment)
            var endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() - 1 + parseInt(noInstallment) * 6);

            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    }

    function formatDate(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; // January is 0!
        var yyyy = date.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        return yyyy + '-' + mm + '-' + dd;
    }
    // end Half Yearly
    //  Yearly

    $('#yearly').on('change', function() {
        if ($(this).prop('checked')) {
            // Execute the date calculation logic only if the "Quarterly" checkbox is checked

            $('#inst_start').on('change', calculateYearlyEndDate);
            $('#no_of_installment').on('input', calculateYearlyEndDate);
        } else {
            // If the "Half Yearly" checkbox is not checked, remove event handlers
            $('#inst_start').off('change', calculateYearlyEndDate);
            $('#no_of_installment').off('input', calculateYearlyEndDate);
        }
    });

    function calculateYearlyEndDate() {
        var startMonth = $('#inst_start').val();
        var noInstallment = $('#no_of_installment').val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);

            // Calculate end date based on the number of installments (monthly increment)
            var endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() - 1 + parseInt(noInstallment) * 12);

            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    }

    function formatDate(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; // January is 0!
        var yyyy = date.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        return yyyy + '-' + mm + '-' + dd;
    }
    // end  Yearly
    //  Yearly

    $('#at_a_time').on('change', function() {
        if ($(this).prop('checked')) {
            // Execute the date calculation logic only if the "Quarterly" checkbox is checked
            $('#no_of_installment').val(3);
            $('#inst_start').on('change', calculateAtAtimeEndDate);
            $('#no_of_installment').on('input', calculateAtAtimeEndDate);
        } else {
            // If the "Half Yearly" checkbox is not checked, remove event handlers
            $('#inst_start').off('change', calculateAtAtimeEndDate);
            $('#no_of_installment').off('input', calculateAtAtimeEndDate);
        }
    });

    function calculateAtAtimeEndDate() {
        var startMonth = $('#inst_start').val();
        var noInstallment = $('#no_of_installment').val();

        if (startMonth && noInstallment && !isNaN(noInstallment)) {
            var startDate = new Date(startMonth);

            // Calculate end date based on the number of installments (monthly increment)
            var endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() - 1 + parseInt(noInstallment) * 1);

            // Set the calculated end date to the 'Installment End' field
            $('#inst_to').val(formatDate(endDate));
        } else {
            alert("Please select both Installment Start and a valid No. Of Installment");
        }
    }

    function formatDate(date) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; // January is 0!
        var yyyy = date.getFullYear();

        if (dd < 10) {
            dd = '0' + dd;
        }

        if (mm < 10) {
            mm = '0' + mm;
        }

        return yyyy + '-' + mm + '-' + dd;
    }
    // end  Yearly
    $(function() {
        var $sections = $('.form-section');

        function navigateTo(index) {
            $sections.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index > 0);
            var atTheEnd = index >= $sections.length - 1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {
            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex() - 1);
        });
        $('.form-navigation .next').click(function() {
            $('.form-demo').parsley().whenValidate({
                group: 'block-' + curIndex()
            }).done(function() {
                navigateTo(curIndex() + 1);
            });
        });
        $sections.each(function(index, section) {
            $(section).find(':input').attr('data-parsley-group', 'block' + index);
        });
        navigateTo(0);
    });

    function calculateOwnership() {
        var ownershipSizeValue = parseFloat(document.getElementById("ownership_size").value) || 1;
        var noOwnershipValue = parseFloat(document.getElementById("no_ownership").value) || 1;
        let result = ownershipSizeValue * noOwnershipValue;
        document.getElementById("ownership_size").value = result;
    }
</script>

{{-- lggkldfg --}}
<script>
    function roundAndSetInputValue(inputId) {
        var inputValue = document.getElementById(inputId).value;
        var roundedValue = Math.round(parseFloat(inputValue));
        document.getElementById(inputId).value = roundedValue;
    }

    function roundAndSetInputValue(inputId) {
        var inputValue = document.getElementById(inputId).value;
        var roundedValue = Math.round(parseFloat(inputValue));
        document.getElementById(inputId).value = roundedValue;
    }

    //  //no.of installment will be not greater than 48
    $(document).ready(function() {
        $('#no_of_installment').on('input', function() {
            var installment = parseInt($(this).val(), 10);

            if (isNaN(installment) || installment > 48) {
                $(this).val(48);
                alert('Please enter a value less than or equal to 48.');
            }
        });
    });
</script>

@endpush
