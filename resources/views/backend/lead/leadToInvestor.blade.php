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
                            <h5 class="card-title text-primary" style="text-transform: uppercase">Add Client</h5>
                            <div class="row">
                                <!-- Basic Layout -->
                                <div class="col-xxl">
                                    <div class="card mb-4">
                                        <div class="card-body" style="background: #a8cc66;">
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
                                                            <input type="hidden" id="serial_number" name="serial_number" readonly>
                                                        </div>

                                                        <input type="hidden" value="{{$teamLeaderId}}" name="teamId" readonly>
                                                        <input type="hidden" value="{{$salesPerson}}" name="salesId" readonly multiple>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="fullname">Applicant's Full Name</label>
                                                            <input type="text" class="form-control" name="name" id="fullname" placeholder="Enter Applicant's Full Name" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="fathers_name">Father's Name</label>
                                                            <input type="text" class="form-control" name="fathers_name" id="fathers_name" placeholder="Enter Father's Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="mothers_name">Mother's Name</label>
                                                            <input type="text" class="form-control" name="mothers_name" id="mothers_name" placeholder="Enter Mother's Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="spouse_name">Spouse Name (If any)</label>
                                                            <input type="text" class="form-control" name="spouse_name" id="spouse_name" placeholder="Enter Spouse Name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="spouse_date_birth">Birth Date (Spouse)</label>
                                                            <input type="date" class="form-control" name="spouse_date_birth" id="spouse_date_birth" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="birth_date">Date of Birth</label>
                                                            <input type="date" class="form-control" placeholder="Enter Date of Birth" name="birth_date" id="birth_date" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Marriage">Marriage Day</label>
                                                            <input type="date" class="form-control" placeholder="Enter Marriage Day" name="marriage" id="Marriage" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="present_address">Present/Mailing Address</label>
                                                            <input type="text" class="form-control" placeholder="Enter Present/Mailing Address" name="present_address" id="present_address" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="permanent_address">Permanenet Address</label>
                                                            <input type="text" class="form-control" name="permanent_address" id="permanent_address" placeholder="Enter Permanenet Address" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="phone">Phone Number</label>
                                                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="email">Email Address<span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2 dummy" for="password">Password<span class="text-danger" style="font-size:20px;">*</span></label>
                                                            <input type="password" class="form-control" name="password" id="password" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="facebook">Facebook Id</label>
                                                            <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Enter Facebook Id" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Profession">Profession</label>
                                                            <input type="text" class="form-control" name="profession" id="Profession" placeholder="Enter Profession" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Religion">Religion</label>
                                                            <input type="text" class="form-control" name="religion" id="Religion" placeholder="Enter Religion" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="office_address">Office Address</label>
                                                            <input type="text" class="form-control" name="office_address" id="office_address" placeholder="Enter Office Address" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nid_passport">Nid Number/Passport</label>
                                                            <input type="text" class="form-control" placeholder="Enter Nid Number/Passport" name="nid_passport" id="nid_passport" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="Nationality">Nationality</label>
                                                            <input type="text" value="Bangladeshi" class="form-control" name="nationality" id="Nationality" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Project Name</label>
                                                            <input type="text" class="form-control" name="project_name" id="project_name" value="Chuti Resort Purbachal" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Project Address Name</label>
                                                            <input type="text" class="form-control" name="project_address" id="project_address" value="Village: Rathura, Union: Nagori, District: Gazipur" readonly />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="ownership_size">Suite/Ownership size(Sft)</label>
                                                            <input type="number" class="form-control" name="ownership_size" id="ownership_size" placeholder="Enter Suite/Ownership size" onchange="calculateOwnership()" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="category_ownership">Category Of Ownership</label>
                                                            <select class="form-control" name="category_ownership" id="category_ownership">
                                                                <option value="">Select Categgory</option>
                                                                <option value="Executive">Executive</option>
                                                                <option value="Premium">Premium</option>
                                                                <option value="Royal">Royal</option>
                                                            </select>
                                                            {{-- <input type="text" class="form-control" name="category_ownership" id="category_ownership" placeholder="Enter Category Of Ownership" /> --}}
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="no_ownership">No. Of Ownership</label>
                                                            <input type="number" class="form-control" name="no_ownership" id="no_ownership" placeholder="Enter No. Of Ownership" onkeyup="calculateOwnership()" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="price_ownership">Price per Ownership</label>
                                                            <input type="number" class="form-control" name="price_ownership" id="price_ownership" placeholder="Price per Ownership" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="price_ownership_word">Price per Ownership(In Word)</label>
                                                            <input type="text" class="form-control" name="price_ownership_word" id="price_ownership_word" placeholder="Price per Ownership(In Word)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="agreed_price">Total Price</label>
                                                            <input type="number" class="form-control" name="agreed_price" id="totalPrice" placeholder="Enter Agreed Price" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="agreed_price_word">Total Price(In Word)</label>
                                                            <input type="text" class="form-control" name="agreed_price_word" id="agreed_price_word" placeholder="Enter Agreed Price(In Word)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="special_discount">Special Discount</label>
                                                            <input type="number" class="form-control" name="special_discount" id="special_discount" placeholder="Enter Special Discount" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="special_discount_word">Special Discount(In Word)</label>
                                                            <input type="text" class="form-control" name="special_discount_word" id="special_discount_word" placeholder="Enter Special Discount(In Word)" />
                                                        </div>

                                                        <div class="col-md-12 d-flex mt-4">
                                                            <label for="" class="form-label ">Mode Of Payment</label>
                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="Installment" name="installment" value="installment">
                                                                <label class="form-label " for="Installment">Per Month</label>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="quarterly" name="quarterly" value="quarterly">
                                                                <label class="form-label" for="quarterly">Quarterly</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="half_yearly" name="half_yearly" value="half_yearly">
                                                                <label class="form-label" for="half_yearly">Half Yearly</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="yearly" name="yearly" value="yearly">
                                                                <label class="form-label" for="yearly">Yearly</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input class="mx-1" type="checkbox" id="at_a_time" name="at_a_time" value="at_a_time">
                                                                <label class="form-label" for="at_a_time">At a Time</label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3">

                                                            <label class="form-label my-2" for="main_amount">Main Amount</label>
                                                            <input type="number" class="form-control" name="main_amount" id="main_amount_first" />

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="basic-default-name">USER Image</label>
                                                            <input type="file" class="form-control my-2" name="user_image" id="image" />
                                                            <img style="width:200px;height:200px" id="showImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                                                        </div>

                                                    </div>

                                                </div>
                                                {{-- 3rd step --}}
                                                <div class="form-section">
                                                    <div class="row mb-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment">Booking Money Payment Tk.</label>
                                                            <input type="text" class="form-control" placeholder="Enter Down Payment Tk." name="down_payment" id="down_payment" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment_date">Booking Money Payment Date</label>
                                                            <input type="date" class="form-control" name="down_payment_date" id="down_payment_date" placeholder="Enter Permanenet Address" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="down_payment_inWord">Booking Money Payment(In Word)</label>
                                                            <input type="text" class="form-control" name="down_payment_inWord" id="down_payment_inWord" placeholder="Enter Down Payment In Word" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="payment_type2">Payment Type</label>
                                                            <select class="form-control" name="payment_type2" id="payment_type2">
                                                                <option value="">Select Payment Type</option>
                                                                <option value="cash">Cash</option>
                                                                <option value="chq">CHQ</option>
                                                                <option value="Online_Payment">Online Payment ( Bank to Bank)</option>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-3" id="chqDiv">
                                                            <label class="form-label my-2" for="chq">CHQ No.</label>
                                                            <input type="text" class="form-control" name="chq" id="chq" placeholder="Enter Payment CHQ No" />
                                                        </div>


                                                        <div class="col-md-3" id="ttDiv">
                                                            <label class="form-label my-2" for="Online_Payment">Online Payment ( Bank to Bank)</label>
                                                            <input type="text" class="form-control" name="online_payment" id="Online_Payment" placeholder="Enter Online Payment ( Bank to Bank)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="payment_type_date2">Payment Date</label>
                                                            <input type="date" class="form-control" name="payment_type_date2" id="payment_type_date2" placeholder="Payment Type's Date" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="no_of_installment">No. Of Installment</label>
                                                            <input type="text" class="form-control" name="no_of_installment" id="no_of_installment" placeholder="Enter No. Of Installment" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_per_month">Inst. per Month Tk.</label>
                                                            <input type="number" class="form-control" name="inst_per_month" id="inst_per_month" placeholder="Enter Inst. per Month Tk." onblur="roundAndSetInputValue('inst_per_month')" />
                                                        </div>
                                                        {{-- main --}}
                                                        <div class="col-md-3">

                                                            <label class="form-label my-2" for="main_amount">Main Amount</label>
                                                            <input type="number" class="form-control" name="main_amount" id="main_amount" onblur="roundAndSetInputValue('main_amount')" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_start">Installment Start</label>
                                                            <input type="date" class="form-control" name="start_from" id="inst_start" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="inst_to">Installment End</label>
                                                            <input type="date" class="form-control" name="start_to" id="inst_to" />
                                                        </div>

                                                        <div class="col-md-3 mb-4">
                                                            <label class="form-label my-2" for="others_instruction">Enter Others Description (if any)</label>
                                                            <textarea class="form-control" name="others_instruction" id="others_instruction" placeholder="Enter Others Description(if any)"></textarea>

                                                        </div>
                                                        <div class="col-md-3 mb-4">
                                                            <label class="form-label my-2" for="allow_amount">Allow Amount</label>
                                                            <input class="form-control" name="allow_amount" id="allow_amount">

                                                        </div><br>
                                                        <hr>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nominee_name">Nominee Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Nominee Name" name=" nominee_name" id="nominee_name" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nominee_cell_no">Nominee Cell Number</label>
                                                            <input type="number" class="form-control" name="nominee_cell_no" id="nominee_cell_no" placeholder="Enter Nominee Cell Number" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="project_name">Relation to Nominee</label>
                                                            <input type="text" class="form-control" name="relation_to_nominee" id="relation_to_nominee" placeholder="Enter Relation to Nominee" />
                                                        </div>

                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_name_a">Reference Name (A)</label>
                                                            <input type="text" class="form-control" name="reference_name_a" id="reference_name_a" placeholder="Enter Reference Name (A)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_cell_a">Reference Cell Number (A)</label>
                                                            <input type="number" class="form-control" name="reference_cell_a" id="reference_cell_a" placeholder="Enter Reference Cell Number (A)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_name_a">Reference Name (B)</label>
                                                            <input type="text" class="form-control" name="reference_name_b" id="reference_name_b" placeholder="Enter Reference Name (B)" />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="reference_cell_a">Reference Cell Number (B)</label>
                                                            <input type="number" class="form-control" name="reference_cell_b" id="reference_cell_b" placeholder="Enter Reference Cell Number (B)" />
                                                        </div>

                                                        <div class="col-md-5">
                                                            <label class="form-label my-3" for="id_employee">Sales Person</label>
                                                            <select class="form-control" style="width: 50%;" name="employee_id[]" id="id_employee" multiple>
                                                                @foreach($employee as $employees)
                                                                <option value="{{ $employees->id }}" {{ in_array($employees->id,explode(',',$salesPerson)) ? 'selected' : '' }}>{{ $employees->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label my-3" for="team_leader">Assist By </label>
                                                            <select class="form-control" style="width: 50%;" name="team_leader[]" id="team_leader" multiple>
                                                                @foreach($team_lead as $value)
                                                                <option value="{{ $value->id }}" {{ in_array($value->id, explode(',', $task->team_leader)) ? 'selected' : '' }}>{{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label my-2" for="nominee_image">Nominee Image</label>
                                                            <input type="file" class="form-control my-2" name="nominee_image" id="nominee_image" />
                                                            <img style="width:200px;height:200px" id="showNImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">

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
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="status" type="checkbox" value="accept" id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            I accept the terms and conditions
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" name="investorPdfGenerate" id="investorPdfGenerate">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            PDF Generate
                                                        </label>
                                                    </div>
                                                </div>


                                                <div class="form-navigation">
                                                    <button type="button" class="previous btn btn-info pull-left">&lt; Previous</button>
                                                    <button type="button" class="next btn btn-info pull-right">Next &gt;</button>

                                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
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
    $("#chqDiv, #poDiv, #ttDiv, #ddDiv").hide();

    // Show/hide input fields based on dropdown selection
    $("#payment_type2").change(function() {
        // Hide all input fields
        $("#chqDiv, #poDiv, #ttDiv, #ddDiv").hide();

        // Get the selected value
        var selectedValue = $(this).val();

        // Show the corresponding input field
        $("#" + selectedValue + "Div").show();
    });
    //select 2
    $(document).ready(function() {
        $('#id_employee').select2();
        $('#team_leader').select2();
    });
    // Calculate Total Amount
    // Use keyup method for real-time updates
    $('#no_ownership, #price_ownership,#special_discount,#down_payment,#no_of_installment,#allow_amount').on('keyup', function() {
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

            $('#allow_amount').val($mainAmount);
            $('#totalPrice').val($totalAmount);
            $('#main_amount_first,#main_amount').val($totalMianAmount);
            $ins_amount = Math.round(($totalMianAmount / $no_of_installment).toFixed(2));
            //no of owenership
            $('#inst_per_month').val($ins_amount);

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
