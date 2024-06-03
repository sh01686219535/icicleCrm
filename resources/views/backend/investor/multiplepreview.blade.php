<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">

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
    <style>
        a{
            cursor: pointer;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
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
                <a class="btn btn-primary" onclick="window.history.back()">Back</a>
            </div>
            <div style="float:right;margin-right:140px;margin-top:20px;">

              {{--  @if(user_image) --}}
                <img height="120px" width="120" src="" id="userImage" alt="" onerror="replaceWithDefault(this)" />
            {{--    @else
                <img style="width:120px;height:120px" id="showNImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                @endif

               {{-- @if(nominee_image) --}}
                <img height="120px" width="120" src="" alt="" id="nomuserImage" onerror="replaceWithDefault(this)"/>
               {{-- @else
                <img style="width:120px;height:120px" id="showNImage" src="{{ asset('backend/img/previewImage.png') }}" alt="" class="image-style mb-3">
                @endif--}}
            </div>
        </div>
        <hr />
        <div>
            <div style="width: 850px;
                margin:5px;
                height:600px;padding-left:30px; ">

                <div>
                    <div class="main-1">
                        <div id="previewData"></div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="display:inline-block;"><b>Serial Number</b> :</p>
                            <input type="text" id="serialnumber" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="display:inline-block;margin-right:32px"><b>File Number</b> :</p>
                            <input type="text" id="fileNumber" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="display:inline-block;"><b>Applicant's Name</b> :</p>
                            <input type="text" id="name" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Father Name</b> :</p>
                            <input type="text" id="fathers_name" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Mother Name</b>:</p>
                            <input type="text" id="mothers_name" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-top:18px;margin-bottom: -7px;width:40%;display:inline-block;">
                                <p style="width:36.5%;display:inline-block;"><b>Phone Number</b>:</p>
                                <input type="text" id="phone" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-top:18px;margin-bottom: -7px;margin-left:50px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Email</b>:</p>
                                <input type="text" id="email" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:47%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-top:10px;margin-bottom: -10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Facebook Id</b>:</p>
                                <input type="text" id="facebook" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;margin-left:-30px;width:49%;display:inline-block;">
                                <p style="width:15.5%;display:inline-block;"><b>Religion</b>:</p>
                                <input type="text" id="religion"  value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:43%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Spouse Name</b>:</p>
                                <input type="text" id="spouse_name" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>Spouse Birth Date</b>:</p>
                                <input type="text" id="spouse_date_birth" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:30%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Birth Date</b>:</p>
                                <input type="text" id="birth_date" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>Marriage Date</b>:</p>
                                <input type="text" id="marriage" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:38%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:49%;display:inline-block;">
                                <p style="width:29.5%;display:inline-block;"><b>Profession</b>:</p>
                                <input type="text" id="profession" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;margin-left:-30px;">
                                <p style="display:inline-block;"><b>NID Number</b>:</p>
                                <input type="text" value="" id="nid_passport" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:35.5%;display:inline-block;"><b>Nationality</b>:</p>
                                <input type="text" value="" id="nationality" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Passport Number</b>:</p>
                                <input type="text" id="passport" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:44%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:35%;display:inline-block;">
                                <p style="width:40.5%;display:inline-block;"><b>Ownership Size</b>:</p>
                                <input type="text" value="" id="ownership_size" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:41%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:51%;display:inline-block;">
                                <p style="display:inline-block;"><b>Category Ownership</b>:</p>
                                <input type="text" value="" id="category_ownership" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:46%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:35.5%;display:inline-block;"><b>No Ownership</b>:</p>
                                <input type="text" id="no_ownership" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:42%;display:inline-block;">
                                <p style="display:inline-block;"><b>Mode Of Payment</b>:</p>
                                
                                <input type="text" id="modeofpay" value="" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:49%;" class="form-control" readonly>
                               

                            </div>

                        </div>
                       <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:38%;display:inline-block;"><b>Ownership(Word)</b>:</p>
                                <input type="text" value="" id="price_ownership_word" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:45%;display:inline-block;"><b>Price per Ownership</b>:</p>
                                <input type="text" value="" id="price_ownership" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:43%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:51%;display:inline-block;">
                                <p style="width:30%;display:inline-block;"><b>TotalPrice(Word)</b>:</p>
                                <input type="text" value="" id="agreed_price_word" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="display:inline-block;"><b>Total Price</b>:</p>
                                <input type="text" value="" id="agreed_price" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:38%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:52%;display:inline-block;">
                                <p style="width:31%;display:inline-block;"><b>Sp. Discount/(Word)</b>:</p>
                                <input type="text" value="" id="special_discount_word" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="display:inline-block;"><b>Special Discount</b>:</p>
                                <input type="text" value="" id="special_discount" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:24%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Booking Money</b>:</p>
                                <input type="text" value="" id="down_payment" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:15.5px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;margin-left:30px;">
                                <p style="display:inline-block;"><b>Booking Date</b>:</p>
                                <input type="text" value="" id="down_payment_date" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:31%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:56%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>B.Payment(Word)</b>:</p>
                                <input type="text" value="" id="down_payment_inWord" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;margin-left:-50px;">
                                <p style="display:inline-block;"><b>Payment Type</b>:</p>
                                <input type="text" value="" id="payment_type2" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:38%;display:inline-block;"><b>Cheque Number</b>:</p>
                                <input type="text" value="" id="chq" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:-7px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:40%;display:inline-block;">
                                <p style="width:45%;display:inline-block;"><b>Alternative Phone</b>:</p>
                                <input type="text" value="" id="alternativePhone" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:43%;" class="form-control" readonly>
                            </div>
                        </div>
                            <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Branch Name</b>:</p>
                                <input type="text" value="" id="branch_name" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:56%;margin-left:15.5px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;margin-left:30px;">
                                <p style="display:inline-block;"><b>Bank Name</b>:</p>
                                <input type="text" value="" id="bank_name" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:31%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;page-break-after: always; ">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:29%;display:inline-block;"><b>Payment Date</b>:</p>
                                <input type="text" value="" id="payment_type_date2" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;margin-left:17px;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Installment NO</b>:</p>
                                <input type="text" value="" id="no_of_installment" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:36%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:33.5%;display:inline-block;"><b>Inst. month</b>:</p>
                                <input type="text" value="" id="inst_per_month" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Main Amount</b>:</p>
                                <input type="text" value="" id="main_amount" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:32%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:44%;display:inline-block;">
                                <p style="display:inline-block;margin-right:38px;"><b>Agreed Price</b>:</p>
                                <input type="text" value="" id="allow_amount" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:31%;" class="form-control" readonly>
                            </div>

                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:35%;display:inline-block;">
                                <p style="display:inline-block;"><b>Project Name</b>:</p>
                                <input type="text" value="" id="project_name"  style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:53%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:32.5%;display:inline-block;"><b>Start From</b>:</p>
                                <input type="text" value="" id="start_from" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>End date</b>:</p>
                                <input type="text" value="" id="start_to" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="width:32.5%;display:inline-block;"><b>Nomineec Name</b>:</p>
                                <input type="text" value="" id="nominee_name" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Number</b>:</p>
                                <input type="text" value="" id="nominee_cell_no" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:42%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Relation To Nominee</b>:</p>
                                <input type="text" value="" id="relation_to_nominee" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:42%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (A)</b>:</p>
                                <input type="text" value="" id="reference_name_a" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (A) Number</b>:</p>
                                <input type="text" value="" id="reference_cell_a" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (B)</b>:</p>
                                <input type="text" value="" id="reference_name_b" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="main" style="width:100%;">
                            <div class="left" style="margin-bottom: -10px;margin-top:10px;width:46%;display:inline-block;">
                                <p style="display:inline-block;"><b>Name (B) Number</b>:</p>
                                <input type="text" value=" " id="reference_cell_b" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:48%;" class="form-control" readonly>
                            </div>
                          <div class="left" style="margin-bottom: -10px;margin-top:10px;width:50%;display:inline-block;">
                                <p style="display:inline-block;"><b>Assist By</b>:</p>
                                
                                <input type="text" value="" id="team" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:40%;" class="form-control" readonly>

                               

                            </div>
                            
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Description</b>:</p>
                            <input type="text" value="" id="others_instruction" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                       <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Sales Person</b>:</p>
                            
                            <input type="text" value="" id="employee" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div> 
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Present Address</b>:</p>
                            <input type="text" value="" id="present_address" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>

                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:18%;display:inline-block;"><b>Permanent Address</b>:</p>
                            <input type="text" value="" id="permanent_address" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:59%;margin-left:-18px;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Office Address</b>:</p>
                            <input type="text" value="" id="office_address" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                        <div class="left" style="margin-bottom: -10px;margin-top:10px;">
                            <p style="width:14.5%;display:inline-block;"><b>Project Address</b>:</p>
                            <input type="text" value="" id="project_address" style="padding: 8px;border: 2px solid darkgray;border-radius: 8px;background: #d1cece;width:60%;" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-navigation">
                                         
                                                   
                                                    <span class="clearfix"></span>
                                                </div>
                <div style="width: 750px;padding-left:10px;padding-right:10px">
                    <div class="row mb-2" style="margin: 0 25px 0 0 !important">
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
                                <b>Address: SALTANAT INN LTD., Level -2/B, House-85, Road-03, Block-F, Lift 6 Banani, Dhaka-1213. </b>
                                <b>Phone: +8802222271399 </b>
                                <b>Email: info@thesaltanat.com</b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- terms&conditions --}}

    {{--end terms&conditions --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
    $(document).ready(function() {
        // Retrieve data from localStorage
        const formData2 = JSON.parse(localStorage.getItem('formData2'));
        const imageData2 = localStorage.getItem('imageData2');
        const nomimageData2 = localStorage.getItem('nomimageData2');

        // Display data in preview
        const previewDiv = $('#previewData');
        $.each(formData2, function(index, field) {
         //   previewDiv.append('<p><strong>' + index +field.name + ':</strong> ' + field.value + '</p>');
            $('#'+field.name).val(field.value);
            
       
        });
        console.log(formData2[33].name);
        
        document.getElementById('userImage').src = imageData2;
        document.getElementById('nomuserImage').src = nomimageData2;

        if(formData2[34].name == 'quarterly'){
            $('#modeofpay').val("Quarterly");

        }
        else if(formData2[34].name == 'installment'){
            $('#modeofpay').val("Monthly");

        }
        else if(formData2[34].name == 'yearly'){
            $('#modeofpay').val("Yearly");

        }
        else if(formData2[34].name == 'half_yearly'){
            $('#modeofpay').val("Half Yearly");

        }
        else if(formData2[34].name == 'at_a_time'){
            $('#modeofpay').val("At a Time");

        }
        else{
            $('#modeofpay').val();


        }


        
    });
    function replaceWithDefault(img) {
    img.src = "{{ asset('backend/img/previewImage.png') }}";
}   

</script>
</body>
</html>
