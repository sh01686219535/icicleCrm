@extends('backend.partials.app')
@section('content')
@push('css')
<style>
    .add-btn {
        width: 60px;
        height: 60px;
        background: #ef5252;
        display: inline-block;
        text-align: center;
        line-height: 60px;
        border-radius: 50%;
        font-size: 30px;
        color: aliceblue;
        cursor: pointer;
    }

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

    table {
        border: 1px solid black;
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
<div class="container customer-container mt-3">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body" >
                    <div class="customer-card mb-3" style="margin-top:-10px;">
                        <div class="area-h3 m-3">
                            <h2>Incentive Ratio</h2>
                        </div>
                    </div>
                    <div class="report mb-5">
                        <form action="/incentive/ratio" method="post">
                            @csrf
                            <div class="col-md-12 d-flex">
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="from_date">
                                </div>
                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3" style="padding: 0 0px 0 5px">
                                    <input class="form-control" type="date" name="to_date">
                                </div>

                                <div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 col-3">
                                    <input class="btn btn-secondary mx-2" type="submit" value="Search">

                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="table-responsive">
                        <h3 class="text-center">Down Payment & Booking Money terms</h3>
                        <table class="table table-hover" style="width:700px;margin:0 auto">
                            <thead>
                                <tr>
                                    <th>Particular</th>
                                    <th>Incentive Ratio</th>
                                    <th>Main Amount</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>C.M.O</td>
                                    <td id="cmo_id">0.40%</td>
                                    <td id="totalAmount">{{$totalMoney}}</td>
                                    <td id="cmo_show"></td>
                                </tr>
                                <tr>
                                    <td>Team Leader</td>
                                    <td id="teamLeader_id">0.75%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="team_id"></td>
                                </tr>
                                <tr>
                                    <td>Sales Person</td>
                                    <td id="salesMain_id">3.50%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="sale_id"></td>
                                </tr>
                                <tr>
                                    <td>Digital Marketing Team</td>
                                    <td id="digital_id">0.10%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="dig_id"></td>
                                </tr>
                                <tr>
                                    <td>Acc. $ Others</td>
                                    <td id="ac$oth_id">0.15%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="ac_id"></td>
                                </tr>
                                <tr>
                                    <td>Tele-Marketing</td>
                                    <td id="tele$oth_id">0.20%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="tele_id"></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>5.10%</td>
                                    <td>{{$totalMoney}}</td>
                                    <td id="total"></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <h3 class="text-center">Collection Installment Terms</h3>
                        <table class="table table-hover" style="width:700px;margin:0 auto">
                            <thead>
                                <tr>
                                    <th>Particular</th>
                                    <th>Incentive Ratio</th>
                                    <th>Main Amount</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>Team Leader</td>
                                    <td id="teamLeader_id">0.25%</td>
                                    <td id="totalAmount_installment">{{ $installmentAmount }}</td>
                                    <td id="teamInst_id"></td>
                                </tr>
                                <tr>
                                    <td>Sales Person</td>
                                    <td id="salseManInst_id">2.00%</td>
                                    <td>{{ $installmentAmount }}</td>
                                    <td id="saleInst_id"></td>

                                </tr>
                                <tr>
                                    <td>CRM Team</td>
                                    <td id="crmInstTeam_id">0.40%</td>
                                    <td>{{ $installmentAmount }}</td>
                                    <td id="CrmInst"></td>

                                </tr>
                                <tr>
                                    <td>Acc. $ Others</td>
                                    <td id="a_oInst_id">0.25%</td>
                                    <td>{{ $installmentAmount }}</td>
                                    <td id="ac_oInst"></td>

                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>2.90%</td>
                                    <td>{{ $installmentAmount }}</td>
                                    <td id="totalInst"></td>

                                </tr>

                            </tbody>

                        </table>
                    </div>
                    <div class="table-responsive mt-3">
                        <h3 class="text-center">Total Revenue And Expense</h3>
                        <table class="table table-hover" style="width:700px;margin:0 auto">
                            <thead>
                                <tr>
                                    <th>Total Revenue</th>
                                    <th>Expense</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="totalRev"></td>
                                    <td id="totalCost"></td>
                                    <td id="profit"></td>
                                </tr>
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
<script>
    // CMO Money
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var cmo_id_percentage = parseFloat(document.getElementById('cmo_id').textContent);
    var result1 = Math.round(totalAmount * cmo_id_percentage / 100);
    document.getElementById('cmo_show').textContent = result1;
    //Team Leader
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var teamLeader_id = parseFloat(document.getElementById('teamLeader_id').textContent);
    var result2 = Math.round(totalAmount * teamLeader_id / 100);
    document.getElementById('team_id').textContent = result2;
    //Sales Person
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var sales_id = parseFloat(document.getElementById('salesMain_id').textContent);
    var result3 = Math.round(totalAmount * sales_id / 100);
    document.getElementById('sale_id').textContent = result3;
    //Digital Marketing Team
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var digital_id = parseFloat(document.getElementById('digital_id').textContent);
    var result4 = Math.round(totalAmount * digital_id / 100);
    document.getElementById('dig_id').textContent = result4;
    //Acc. $ Others
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var oth_id = parseFloat(document.getElementById('ac$oth_id').textContent);
    var result5 = Math.round(totalAmount * oth_id / 100);
    document.getElementById('ac_id').textContent = result5;
    //telemarketing
    var totalAmount = parseFloat(document.getElementById('totalAmount').textContent);
    var othtele_id = parseFloat(document.getElementById('tele$oth_id').textContent);
    
    var resulttele = Math.round(totalAmount * othtele_id / 100);
    document.getElementById('tele_id').textContent = resulttele;
    //total
    var totalResult = result1 + result2 + result3 + result4 + result5 + resulttele;
    document.getElementById('total').textContent = totalResult;
    //teamLeader Installment
    var totalAmount1 = parseFloat(document.getElementById('totalAmount_installment').textContent);
    var teamLeader_id = parseFloat(document.getElementById('teamLeader_id').textContent);
    var result11 = Math.round(totalAmount * teamLeader_id / 100);
    document.getElementById('teamInst_id').textContent = result11;
    //Sales Person
    var totalAmount1 = parseFloat(document.getElementById('totalAmount_installment').textContent);
    var teamLeader_id = parseFloat(document.getElementById('salseManInst_id').textContent);
    var result12 = Math.round(totalAmount * teamLeader_id / 100);
    document.getElementById('saleInst_id').textContent = result12;
    //crmInstTeam_id
    var totalAmount1 = parseFloat(document.getElementById('totalAmount_installment').textContent);
    var teamLeader_id = parseFloat(document.getElementById('crmInstTeam_id').textContent);
    var result13 = Math.round(totalAmount * teamLeader_id / 100);
    document.getElementById('CrmInst').textContent = result13;
    //crmInstTeam_id
    var totalAmount1 = parseFloat(document.getElementById('totalAmount_installment').textContent);
    var a_oInst_id = parseFloat(document.getElementById('a_oInst_id').textContent);
    var result14 = Math.round(totalAmount1 * a_oInst_id / 100);
    document.getElementById('ac_oInst').textContent = result14;
    //crmInstTeam_id
    var totalInstAmount = Math.round(result11 + result12 + result14);
    document.getElementById('totalInst').textContent = totalInstAmount;
    // total calculation

    var totalREVENUE = totalAmount + totalAmount1;
    var totalCost = totalResult + totalInstAmount;
    var profilt = totalREVENUE - totalCost;

    document.getElementById('totalRev').textContent = totalREVENUE;
    document.getElementById('totalCost').textContent = totalCost;
    document.getElementById('profit').textContent = profilt;
</script>
@endpush
