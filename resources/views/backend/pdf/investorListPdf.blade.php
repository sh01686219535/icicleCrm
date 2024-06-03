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
        .table {
            width: 100%;
            border-collapse: collapse;
        }
.policy p{
    font-size:12.5px;
}
        .table th,
        .table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e9e9e9;
        }
    </style>

</head>

<body style="font-family: Open Sans, sans-serif; font-size: 14px; font-weight: 400; line-height: 1.4; color: #000;">
     <div style="width: 900px;
                margin:5px auto;">
        <div style="height: 130px;">
            <div style="float:left;">
                <img height="120px" width="150" src="{{ asset('backend/img/logo.png') }}" alt="" />
            </div>
            <div style="float:right;margin-right:140px;margin-top:20px;">

                @if($investorListPdf->user_image)
                <img height="120px" width="120" src="{{ asset($investorListPdf->user_image) }}" alt="" />
                @else
                <img style="width:120px;height:120px" id="showNImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                @endif

                @if($investorListPdf->nominee_image)
                <img height="120px" width="120" src="{{ asset($investorListPdf->nominee_image) }}" alt="" />
                @else
                <img style="width:120px;height:120px" id="showNImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                @endif
            </div> 
        </div> 
        <hr />
        <div>
            <div style="width: 850px;
                margin:5px;
                height:600px;padding-left:30px; ">

                <div>
                    <div class="main-1">
                       <!-- <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="display:inline-block;padding:0 0"><b>Applicant's SL No</b> :</p>
                            <input type="text" value="{{ $investorListPdf->serial_number }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                        </div> -->
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-top:10px;margin-bottom: -10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Applicant's SL No</b>:</p>
                                <input type="text" value="{{ $investorListPdf->serial_number }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;margin-left:-43px;width:46%;display:inline-block;">
                                <p style="width:25.5%;display:inline-block;"><b>File Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->fileNumber }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="display:inline-block;"><b>Applicant's Name</b> :</p>
                            <input type="text" value="{{ $investorListPdf->name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Father Name</b> :</p>
                            <input type="text" value="{{ $investorListPdf->fathers_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Mother Name</b>:</p>
                            <input type="text" value="{{ $investorListPdf->mothers_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-top:18px;margin-bottom: -7px;width:40%;display:inline-block;">
                                <p style="width:36.5%;display:inline-block;"><b>Phone Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->phone }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-top:18px;margin-bottom: -7px;margin-left:50px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Email</b>:</p>
                                <input type="text" value="{{ $investorListPdf->email }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:47%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-top:10px;margin-bottom: -10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Facebook Id</b>:</p>
                                <input type="text" value="{{ $investorListPdf->facebook }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;margin-left:-30px;width:49%;display:inline-block;">
                                <p style="width:15.5%;display:inline-block;"><b>Religion</b>:</p>
                                <input type="text" value="{{ $investorListPdf->religion }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:43%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Spouse Name</b>:</p>
                                <input type="text" value="{{ $investorListPdf->spouse_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>Spouse Birth Date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->spouse_date_birth }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:30%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Birth Date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->birth_date }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>Marriage Date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->marriage }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:38%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Profession</b>:</p>
                                <input type="text" value="{{ $investorListPdf->profession }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>NID Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->nid_passport }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:35.5%;display:inline-block;"><b>Nationality</b>:</p>
                                <input type="text" value="{{ $investorListPdf->nationality }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Passport Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->passport }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:42%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:35%;display:inline-block;">
                                <p style="width:39.5%;display:inline-block;"><b>Ownership Size</b>:</p>
                                <input type="text" value="{{ $investorListPdf->ownership_size }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:51%;display:inline-block;">
                                <p style="display:inline-block;"><b>Category Ownership</b>:</p>
                                <input type="text" value="{{ $investorListPdf->category_ownership }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:44%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:35.5%;display:inline-block;"><b>No Ownership</b>:</p>
                                <input type="text" value="{{ $investorListPdf->no_ownership }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:38%;display:inline-block;">
                                <p style="display:inline-block;margin-left:-50px;"><b>Mode of Payment</b>:</p>
                                @if($investorListPdf->installment)
                                <input type="text" value="{{ $investorListPdf->installment }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;" class="form-control" readonly>
                                @elseif($investorListPdf->quarterly)
                                <input type="text" value="{{ $investorListPdf->quarterly }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;" class="form-control" readonly>
                                @elseif($investorListPdf->half_yearly)
                                <input type="text" value="{{ $investorListPdf->half_yearly }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;" class="form-control" readonly>
                                @elseif($investorListPdf->yearly)
                                <input type="text" value="{{ $investorListPdf->yearly }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;" class="form-control" readonly>
                                @elseif($investorListPdf->at_a_time)
                                <input type="text" value="{{ $investorListPdf->at_a_time }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;" class="form-control" readonly>
                                @endif
                            </div>

                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:38%;display:inline-block;"><b>Ownership(Word)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->price_ownership_word }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:45%;display:inline-block;"><b>Price per Ownership</b>:</p>
                                <input type="text" value="{{ $investorListPdf->price_ownership }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:39%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:51%;display:inline-block;">
                                <p style="width:28%;display:inline-block;"><b>TotalPrice(Word)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->agreed_price_word }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="display:inline-block;"><b>Total Price</b>:</p>
                                <input type="text" value="{{ $investorListPdf->agreed_price }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:38%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:56%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Sp. Discount(Word)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->special_discount_word }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="display:inline-block;"><b>Special Discount</b>:</p>
                                <input type="text" value="{{ $investorListPdf->special_discount }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:16%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Booking Money</b>:</p>
                                <input type="text" value="{{ $investorListPdf->down_payment }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:15.5px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;margin-left:30px;">
                                <p style="display:inline-block;"><b>Booking Date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->down_payment_date }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:31%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:56%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>B.Money(Word)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->down_payment_inWord }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;margin-left:-50px;">
                                <p style="display:inline-block;"><b>Payment Type</b>:</p>
                                <input type="text" value="{{ $investorListPdf->payment_type2 }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Cheque Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->chq }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Alternative Phone</b>:</p>
                                <input type="text" value="{{ $investorListPdf->alternativePhone }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:32%;" class="form-control" readonly>
                            </div>
                        </div>
                        @if($investorListPdf->payment_type2 = 'Online_Payment')
                            <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:30px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Branch Name</b>:</p>
                                <input type="text" value="{{ $investorListPdf->branch_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:15.5px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:30px;width:50%;display:inline-block;margin-left:30px;">
                                <p style="display:inline-block;"><b>Bank Name</b>:</p>
                                <input type="text" value="{{ $investorListPdf->bank_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:31%;" class="form-control" readonly>
                            </div>
                        </div>
                        @endif
                        <div class="main" style="width:100%; ">
                            <div class="left" style="margin-bottom: -10px;margin-top:20px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Payment Date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->payment_type_date2 }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;margin-left:17px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Installment NO</b>:</p>
                                <input type="text" value="{{ $investorListPdf->no_of_installment }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Inst. month</b>:</p>
                                <input type="text" value="{{ $investorListPdf->inst_per_month }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Main Amount</b>:</p>
                                <input type="text" value="{{ $investorListPdf->main_amount }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:32%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="margin-top:10px;width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:25%;display:inline-block;">
                                <p style="display:inline-block;margin-right:20px;"><b>Allow Amount</b>:</p>
                                <input type="text" value="{{ $investorListPdf->allow_amount }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:27%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:70%;display:inline-block;">
                                <p style="display:inline-block;"><b>Project Name</b>:</p>
                                <input type="text" value="{{ $investorListPdf->project_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;margin-top:10px;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Start From</b>:</p>
                                <input type="text" value="{{ $investorListPdf->start_from }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>End date</b>:</p>
                                <input type="text" value="{{ $investorListPdf->start_to }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Nomineec Name</b>:</p>
                                <input type="text" value="{{ $investorListPdf->nominee_name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->nominee_cell_no }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:42%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Relation To Nominee</b>:</p>
                                <input type="text" value="{{ $investorListPdf->relation_to_nominee }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:42%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (A)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->reference_name_a }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (A) Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->reference_cell_a }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (B)</b>:</p>
                                <input type="text" value="{{ $investorListPdf->reference_name_b }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (B) Number</b>:</p>
                                <input type="text" value="{{ $investorListPdf->reference_cell_b }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Assist By</b>:</p>
                                @foreach(explode(',',$investorListPdf->team_leader) as $value)
                                @php

                                $teams = \App\Models\TeamLeader::find($value)
                                @endphp
                                @if($teams)
                                <input type="text" value="{{ $teams->name }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>

                                @if(!$loop->last)
                                ,
                                @endif
                                @endif
                                @endforeach

                            </div>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Description</b>:</p>
                            <input type="text" value="{{ $investorListPdf->others_instruction }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Sales Person</b>:</p>
                            @php
                            $assists = [];
                            foreach (explode(',',$investorListPdf->employee_id) as $value){
                            $assist = \App\Models\Employee::find($value);
                            if($assist){
                            $assists[] = $assist->name;
                            }
                            }
                            $salesName = implode(',', $assists);
                            @endphp
                            <input type="text" value="{{ $salesName }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Present Address</b>:</p>
                            <input type="text" value="{{ $investorListPdf->present_address }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>

                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:18%;display:inline-block;"><b>Permanent Address</b>:</p>
                            <input type="text" value="{{ $investorListPdf->permanent_address }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;margin-left:-18px;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Office Address</b>:</p>
                            <input type="text" value="{{ $investorListPdf->office_address }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Project Address</b>:</p>
                            <input type="text" value="{{ $investorListPdf->project_address }}" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="policy" style="width: 750px;padding-left:10px;padding-right:10px">
                    <div class="row mb-2" style="margin: 0 25px 0 0 !important;page-break-after: always;">
                        <h3 class="card-title text-primary" style="text-transform: uppercase; text-align:center;text-align:center;"> Declaration</h3>
                        <p style="text-align:justify;">I do hearby declare that the information given herein is true to the best of my knowledge and beleif declare that i have gone through the same. I understand that in the best interest of all, Company shall transfer the suite ownership got by executing a service agreement in favor of Allottee & the project shall always be under the overall control & pervision of the company before and after construction or handover and i agree to become a suit/ownership holder of the project and abide by the rules and regulations formed by the Hotel Management i accept the company's absolute right either to accept or reject my application of booking for the ownership of a Slot/Unit</p>
                    </div>
                    <div class="row mb-2" style="margin: -10px 25px 0 0 !important">
                        <h3 class="" style="text-transform: uppercase;text-align:center"> Terms & Conditions</h3>
                        <h4>Booking</h4>
                        <p style="text-align:justify;">After selecting an Ownership slot of a Suite the prescribed booking form should be duly filled and signed by the applicant along with the booking money and other required documents like 4 copies photo & NID Card/Passport Copies which will be received by authorized person of Chuti Resort Ltd.and this sale shall be approved accordingly . However, the company reseves the right to disapprove any sale applion for not fulfilling the appropriate information or for any other resons.
                        </p>
                        <h4>Allotment</h4>
                        <p style="text-align:justify;margin-bottom:20px;">Alotment shall be made on "first come first seve" basis on receipt fo the booking money along with application form. On acceptance of a booking application and realization at least 30% down payment of the total price. Chuti Resort Ltd. Shall issue a provisional allotment agreement.
                        </p>
                        <h4 style="margin-top:27px">Schedule of payment</h4>
                        <p style="text-align:justify;">An amount of BDT.100,000 (One Lac) for each Ownership is payable at the time of booking and down payment is 20% of total saleable price which shall be made within 30 days form the booking date. For installments,rest of the amount shall be divided equally with the number of installments as monthly payable. Installment shall be paid exactly after one month from the date of booking. Allottee(s) shall be liable to pay 3% charges for total amount on delaying any payable amount mentioned above schedule.Company may cancel the booking /allotment/sale for delaying in down payments realization if exceeds 45 days from the date of booking .If any payment is not paid by above menetioned shedule then total discounted amount will be added with the agreed saleable price.
                        </p>
                        <h4>Mode of Payment</h4>
                        <p style="text-align:justify;">All payment of booking money, full price, down payment, installments, registration fees and any other charges shall be made by Account Payee Cheque/ Bank Draft or Pay Order in favor of Chuti Resort Ltd. Non residence Bangladesh may remit by TT or DD directly through bank in name of Chuti Resort Ltd.
                        </p>
                        <h4>Cancellation of Allotment</h4>
                        <p style="text-align:justify;">In case of nonpayment of total price (for full payment sale) and down payment within previously mentioned time or nonpayment of installments for 2 (two) times, company shall have the right to cancel the allotment. In such event, the amount paid by the Allottee shall refund 80% of total deosited amount and additionally BDT.10,000.00 (Ten Thousand Only) will be deducted as cancellation proceeding fee for each Ownership Slot after 365 days of successfully reselling the Ownership.Cancellation by Allotttee shall have the sam procedure for refund.
                        </p>
                        <h4>Sale Rights</h4>
                        <p>Chuti Resort Ltd. reserves full right to Suite Ownership Slot.
                        </p>
                        <h4>Company`s Right</h4>
                        <p style="text-align:justify;">The Company reserves the right to make any changes /modification on the above Terms & Condition layout plan or condition of the project if those becme absolutely necessary or for any kind of Government Policy.
                        </p>

                    </div>
                </div>


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
                                <b>Address: Corporate Ofice, Level -07, House-47, Road-27, Block-A,Banani, Dhaka-1213. </b>
                                <b>Phone: 01709919827 </b><br>
                            </div>
                        </div>
                    </div>
                </div>
<br><br><br><br><br><br><br><br><br><br>

                <div class="" style="width: 70%;">
                    <h2>Payment Schedule</h2>
                    <table class="table" >
                        <thead>
                            <tr>
                                <th style="width: 120px;">Installment No.</th>
                                <th>Date</th>
                                <th>BDT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($investorListPdf)
                            <tr>
                                <td style="width: 120px;">Booking Money</td>
                                <td>{{  $investorListPdf->down_payment_date }}</td>
                                <td>{{  $investorListPdf->down_payment }} BDT</td>
                            </tr>
                            @elseif($investorListPdfPay)
                            <tr>
                                <td style="width: 120px;">Down Payment</td>
                                <td>{{  $investorListPdfPay->created_at }}</td>
                                <td>{{  $investorListPdfPay->booking_money }} BDT</td>
                            </tr>
                            @endif
                        </tbody>
                        <tbody>
                            @if( $investorListPdf->quarterly)
                            @php
                            function getQuarterlyDates($start_date, $end_date) {
                                $current_date = strtotime($start_date);
                                $end_date = strtotime($end_date);
                                $quarterly_dates = array();

                while ($current_date <= $end_date) {
                    $start_quarter = date('Y-m-d', $current_date);
                    $end_quarter = date('Y-m-d', strtotime('+2 months', $current_date));

                    // Add the start and end dates of the quarter to the result
                    $quarterly_dates[] = array(
                        'start' => $start_quarter,
                        'end' => $end_quarter
                    );

                    // Move to the next quarter
                    $current_date = strtotime('+3 months', $current_date);
                }

                return $quarterly_dates;
            }
                           $instNumber = $investorListPdf->no_of_installment;
                           $inst_per_month = $investorListPdf->inst_per_month;

                            $start_from = new DateTime($investorListPdf->start_from);
                            $start_to = new DateTime($investorListPdf->start_to);
                            $quarterly_dates = getQuarterlyDates($start_from->format('Y-m-d'), $start_to->format('Y-m-d'));

                            foreach ($quarterly_dates as $index => $quarter)


                             {
                                $bdt_inst_amount = $inst_per_month * $instNumber; // Calculate installment amount in BDT

echo "<tr>";
echo "<td>".($index + 1)."</td>";
echo "<td>" . $quarter['start'] . "</td>";
echo "<td>$bdt_inst_amount BDT</td>"; // Display installment amount in BDT
echo "</tr>";

                            }
                                @endphp
                                @elseif($investorListPdf->half_yearly)
                                @php
                                function generateHalfYearlyDates($start_date, $end_date) {
                                    $half_yearly_dates = array();
                                    $current_date = strtotime($start_date);
                                    $end_timestamp = strtotime($end_date);

                                // Loop until current date exceeds the end date
                                while ($current_date <= $end_timestamp) {
                                    // Add current date to the array
                                    $half_yearly_dates[] = date('Y-m-d', $current_date);

                                    // Move to the next half-year
                                    $current_date = strtotime('+6 months', $current_date);
                                }

                                return $half_yearly_dates;
                            }

                                $instNumber = $investorListPdf->no_of_installment;
                                $start_from = new DateTime($investorListPdf->start_from);
                                $start_to = new DateTime($investorListPdf->start_to);
                                $k=0;
                                $halfmonth_names = generateHalfYearlyDates($start_from->format('Y-m-d'), $start_to->format('Y-m-d'));
                                foreach ($halfmonth_names as $month) {
                                    $k++;
            // Calculate installment amount
            $inst_amount = $investorListPdf->inst_per_month ;

            echo "<tr>";
            echo "<td>$k</td>";
            echo "<td>$month</td>";
            echo "<td>"; echo $inst_amount; echo "</td>"; // Display installment amount
            echo "</tr>";
                            }
@endphp
{{-- yearly start --}}
@elseif($investorListPdf->yearly)
@php
function generateHalfYearlyDates($start_date, $end_date) {
$half_yearly_dates = array();
$current_date = strtotime($start_date);
$end_timestamp = strtotime($end_date);

// Loop until current date exceeds the end date
while ($current_date <= $end_timestamp) {
// Add current date to the array
$half_yearly_dates[] = date('Y-m-d', $current_date);

// Move to the next half-year
$current_date = strtotime('+12 months', $current_date);
}

return $half_yearly_dates;
}

$instNumber = $investorListPdf->no_of_installment;
$start_from = new DateTime($investorListPdf->start_from);
$start_to = new DateTime($investorListPdf->start_to);
$k=0;
$halfmonth_names = generateHalfYearlyDates($start_from->format('Y-m-d'), $start_to->format('Y-m-d'));
foreach ($halfmonth_names as $month) {
    $k++;
            // Calculate installment amount
            $inst_amount = $investorListPdf->inst_per_month ;

            echo "<tr>";
            echo "<td>$k</td>";
            echo "<td>$month</td>";
            echo "<td>"; echo $inst_amount; echo "</td>"; // Display installment amount
            echo "</tr>";
}
@endphp
{{-- yearly end --}}
                                @else
                                @php
                                function getMonthNamesFromDateRange($start_date, $end_date) {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);

    $month_names = array();
    $current = clone $start;

    while ($current <= $end) {
        $month_names[] = $current->format('Y-m-d');
        $current->modify('+1 month');
    }

    return $month_names;
}
                            $instNumber = $investorListPdf->no_of_installment;
                            $start_from = new DateTime($investorListPdf->start_from);
                            $start_to = new DateTime($investorListPdf->start_to);
                            $k=0;
                          //  $current_date = clone $start_from;
                          $month_names = getMonthNamesFromDateRange($start_from->format('Y-m-d'), $start_to->format('Y-m-d'));
                          foreach ($month_names as $month) {
                            $k++;
            // Calculate installment amount
            $inst_amount = $investorListPdf->inst_per_month ;

            echo "<tr>";
            echo "<td>$k</td>";
            echo "<td>$month</td>";
            echo "<td>"; echo $inst_amount; echo "</td>"; // Display installment amount
            echo "</tr>";
}
                                @endphp


@endif
{{-- <td>
@foreach ($investorListPdf as  $item)

    {{ $item->inst_per_month }}

@endforeach
</td> --}}


                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    {{-- terms&conditions --}}

    {{--end terms&conditions --}}

</body>

</html>