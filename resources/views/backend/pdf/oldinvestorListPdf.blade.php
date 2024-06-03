<html>

<head>
    <title>Invoice Print</title>
    <style>
        @page {
            sheet-size: A4;
            background-color: azure;
            vertical-align: top;
            margin-top: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-bottom: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-left: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-right: 0cm;
            /* <any of the usual CSS values for margins> */

            margin-header: 0;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0;
            /* <any of the usual CSS values for margins> */
            marks: none;
            /crop | cross | none/
        }

    </style>

</head>

<body style="font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
    <div style="width: 800px;
                margin:5px auto;">
        <div style="height: 130px;">
            <div style="float:left;">
                <img height="120px" width="150" src="{{ asset('backend/img/logo.png') }}" alt="" />
            </div>
            <div style="float:right; margin-right:13px;">
                <img height="120px" width="120" src="{{ asset($investorListPdf->user_image) }}" alt="" />
                <img height="120px" width="120" src="{{ asset($investorListPdf->nominee_image) }}" alt="" />
            </div>
        </div>
        <hr />
        <div>
            <div style="width: 900px;
                margin:5px;
                height:600px;padding-left:30px; ">
                <div style=" float: left;width:350px;">
                    <div style="float: left;width:180px;">
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="font-weight: bold; font-size: 13px;">Investor ID :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Applicant's Name:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Birth Date :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Phone Number :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Email Address :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">profession :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Nid Number :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Project Name :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;height:50px;"><span style="display: block; font-weight: bold; font-size: 13px;">Project Details Address</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Installment End :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Nominee Name :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Relation To Nominee :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Reference Name (A):</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Reference Name (B):</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Father's Name:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Spouse name:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Marriage Date:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Permanent Address:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Religion:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Nationality:</span></p>

                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Category Of Ownership:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Mode Of Payment(Quaterly):</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Payment Type Date:</span></p>

                    </div>
                    <div style="float: right;width:200px;">
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->serial_number ) {{ $investorListPdf->serial_number }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0;  margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->name) {{ $investorListPdf->name }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->birth_date ){{ $investorListPdf->birth_date }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->phone) {{ $investorListPdf->phone }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->email ) {{ $investorListPdf->email }} @else N/A @endif
                        </p>

                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->profession ){{ $investorListPdf->profession }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->nid_passport ){{ $investorListPdf->nid_passport }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->project_name ){{ $investorListPdf->project_name }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;height:50px;">
                            @if ( $investorListPdf->project_address){{ $investorListPdf->project_address }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->start_to){{ $investorListPdf->start_to }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->nominee_name){{ $investorListPdf->nominee_name }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->relation_to_nominee){{ $investorListPdf->relation_to_nominee }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->reference_name_a ){{ $investorListPdf->reference_name_a }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->reference_name_b ){{ $investorListPdf->reference_name_b }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->fathers_name ){{ $investorListPdf->fathers_name }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->spouse_name ){{ $investorListPdf->spouse_name }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->marriage ){{ $investorListPdf->marriage }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->permanent_address ){{ $investorListPdf->permanent_address }} @else N/A @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->religion ){{ $investorListPdf->religion }} @else N/A @endif
                        </p>
                        <p style="margin: -2 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->nationality ){{ $investorListPdf->nationality }} @else N/A @endif
                        </p>
                        <p style="margin: -2 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->category_ownership ){{ $investorListPdf->category_ownership }} @else N/A @endif
                        </p>
                        <p style="margin: -2 0 9px 0px; margin-left:40px; font-size: 14px;">
                            @if ( $investorListPdf->quarterly ){{ $investorListPdf->quarterly }} @else N/A @endif
                        </p>
                        <p style="margin: -1 0 9px 0px; margin-left:10px; font-size: 14px;">
                            @if ( $investorListPdf->payment_type_date2 ){{ $investorListPdf->payment_type_date2 }} @else N/A @endif
                        </p>
                        {{-- <div style="margin: 0 0 9px 0px; margin-left:10px; font-size: 14px;">
                            <img height="120px" width="120" src="{{ asset($investorListPdf->nominee_image) }}" alt="" />
                    </div> --}}
                </div>
            </div>
            <div style=" float: right;width: 220px;">
                <div style=" float: left;width:220px;">
                    <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF OWNERSHIP :</span></p>
                    <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PRICE PER OWNERSHIP :</span></p>
                    <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">TOTAL PRICE :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">SPECIAL DISCOUNT:</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Booking Money TK. :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Booking Money Date :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF INSTALLMENT :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INST. PER MONTH TK. :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">MAIN AMOUNT :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INSTALLMENT START :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NOMINEE CELL NUMBER :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (A) :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (B) :</span></p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Assist By :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;height:50px;"><span style="display: block; font-weight: bold; font-size: 13px;">Sales Persion :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Mother's Name :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Spouse Date Birth :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Present/Mailing Address :</span>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Facebook ID :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Office Address :</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Suite/Ownership Size(SFT):</span>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Mode Of Payment(Per Installment):</span>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Payment Type:</span>

                    </p>
                    <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Others Information:</span>

                    </p>
                </div>
                <div style=" float: right;width:200px;">
                    <p style="margin: 0 0 6px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->no_of_installment ){{ $investorListPdf->no_of_installment }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->no_ownership){{ $investorListPdf->no_ownership }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->agreed_price ){{ $investorListPdf->agreed_price }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->special_discount ){{ $investorListPdf->special_discount }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->down_payment ){{ $investorListPdf->down_payment }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->down_payment_date ){{ $investorListPdf->down_payment_date }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->no_of_installment ){{ $investorListPdf->no_of_installment }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->inst_per_month ){{ $investorListPdf->inst_per_month }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->main_amount ){{ $investorListPdf->main_amount }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->start_to){{ $investorListPdf->start_to }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ( $investorListPdf->nominee_cell_no ){{ $investorListPdf->nominee_cell_no }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:188px; font-size: 14px;">
                        @if ( $investorListPdf->reference_cell_a ){{ $investorListPdf->reference_cell_a }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:188px; font-size: 14px;">
                        @if ($investorListPdf->reference_cell_b ){{ $investorListPdf->reference_cell_b }} @else N/A @endif
                    </p>

                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;display: inline-block;">
                        @foreach ($investorListPdf->employees as $employee)
                        @if(!$employee->team_leader)
                        <span style="display: inline-block; font-weight: bold; font-size: 13px;"> {{ $employee->name }}</span>
                        @endif
                        @endforeach
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px;height:50px; font-size: 14px;display: inline-block;">
                        @foreach ($investorListPdf->employees as $employee1)
                         @if($employee1->team_leader)
                        <span style="display: inline-block; font-weight: bold; font-size: 13px;"> {{ $employee1->name }}</span>
                        @endif
                        @endforeach
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->mothers_name ){{ $investorListPdf->mothers_name }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->spouse_date_birth ){{ $investorListPdf->spouse_date_birth }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->present_address ){{ $investorListPdf->present_address }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->facebook ){{ $investorListPdf->facebook }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->office_address ){{ $investorListPdf->office_address }} @else N/A @endif
                    </p>
                    <p style="margin: 0 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->ownership_size ){{ $investorListPdf->ownership_size }} @else N/A @endif
                    </p>
                    <p style="margin: -2 0 9px 0px; margin-left:210px; font-size: 14px;">
                        @if ($investorListPdf->installment ){{ $investorListPdf->installment }} @else N/A @endif
                    </p>
                    <p style="margin: -2 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->payment_type2 ){{ $investorListPdf->payment_type2 }} @else N/A @endif
                    </p>
                    <p style="margin: -2 0 9px 0px; margin-left:160px; font-size: 14px;">
                        @if ($investorListPdf->others_instruction ){{ $investorListPdf->others_instruction }} @else N/A @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- terms&conditions --}}
    <div style="width: 750px;margin:auto;padding-left:10px;padding-right:10px">
    <div >
        <h3 class="card-title text-primary" style="text-transform: uppercase; text-align:center"> Declaration</h3>
        <p>I do hearby declare that the information given herein is true to the best of my knowledge and beleif declare that i have gone through the same. I understand that in the best interest of all, Company shall transfer the suite ownership got by executing a service agreement in favor of Allottee & the project shall always be under the overall control & pervision of the company before and after construction or handover and i agree to become a suit/ownership holder of the project and abide by the rules and regulations formed by the Hotel Management i accept the company's absolute right either to accept or reject my application of booking for the ownership of a Slot/Unit</p>

        <h3 class="" style="text-transform: uppercase;text-align:center"> Terms & Conditions</h3>
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
    {{--end terms&conditions --}}
    <div style="width: 800px;margin: 0 auto;">
        <div class="text" style="margin-top:80px;">
            <div style="float:left;width:200px;text-align:center;">
                <hr style="font-size:14px;">
                <h5 style="font-size:14px;">Applicant Signature</h5>
            </div>
            <div class=" " style="float:right;width:170px;text-align:center;margin-right:80px;">
                <hr style="font-size:14px;">
                <h5 style="font-size:14px; text-align:center">Authorised Signature</h5>
            </div>
        </div>
        <div class="footer text-align:center " style="margin-top:10px;">
            <div style="text-align: center">
                <div colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                    <strong style="display:block;margin:0 0 10px 0;"></strong>
                    <b>Address: SEL Pacifica, Level -2/B, House-91, Road-04, Block-B, Banani , Dhaka-1213. </b>
                    <b>Phone: +880255033394 </b>
                    <b>Email: crm@chutibd.com</b>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
