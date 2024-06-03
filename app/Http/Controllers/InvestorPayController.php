<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Target;
use App\Models\TargetMoney;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvestorPayController extends Controller
{
    //InvestorPay
    public function investor_pay()
    {
        $data = array();
        $data['active_menu'] = 'InvestorPay';
        $data['page_title'] = 'Investor Pay';
        $investor = Investor::all()->unique('serial_number');

        if (request()->isMethod('post')) {
            try {
                // dd(request()->all());
                InvestorPay::create([
                    'investor_id' => request('serial_No'),
                    'fileNumber' => request('fileNumber'),
                    'start_month' => request('start_month'),
                    'end_month' => request('end_month'),
                    'per_int_amount_word' => request('per_int_amount_word'),
                    'bank_name' => request('bank_name'),
                    'branch_name' => request('branch_name'),
                    'payment_type' => request('payment_type'),
                    'chqNo' => request('chqNo'),
                    'number_installment_upcomming' => request('number_installment_upcomming'),
                    'total' => request('total'),
                    'extra_pay' => request('extra_pay'),
                    'description' => request('description'),
                    'project_name' => request('project_name'),
                ]);
                if(request('email')){
                    $data = ['email' => request('email')];

                    Mail::send('email.investorPayMail', $data, function ($message) use ($data) {
                        $message->from('qrcode950@gmail.com', 'Admin');
                        $message->to($data['email'])
                            ->subject('Investor Payment Done');
                    });
                }
                            
                //installment_incentive
                $downPayment = floatval(request('total'));
                $teamLeader = request('team_leader');
                $salesman =  request('employee_id');
                if ($teamLeader || $salesman) {
                    $teamLeaders = TeamLeader::where('id', $teamLeader)->first();

                    $percent = 2.00;
                    $teamPercent = 0.25;
                    $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                    $percentOfDownPayment = round(($percent / 100) * $downPayment);
                    $teamLeaders->incentive_amount += (float) $teamLeaderDownPayment;
                    $teamLeaders->save();
                    // Target Money
                    // Target Money
                    $cmoId = TeamLeader::where('id', $teamLeader)
                        ->select('cmo', 'gm')
                        ->get(['gm', 'cmo']);
                    // dd($cmoId);

                    if ($cmoId->isNotEmpty()) {
                        foreach ($cmoId as $leader) {
                            $gm = $leader->gm;
                            $cmo = $leader->cmo;
                            // dd( $gm,$cmo);
                            // Do something with $gm and $cmo
                        }
                    } else {
                        // Handle case when no records are found
                        echo "No TeamLeader found with the specified gm or cmo.";
                    }
                    $employee = Target::where('employee_id', $salesman)
                        ->select('id')
                        ->first();
                    if ($employee) {
                        $employeeId = $employee->id;

                        $targetMoney = new TargetMoney();
                        $targetMoney->target_id = $employeeId;
                        $targetMoney->gm_id = $gm;
                        $targetMoney->cmo_id = $cmo;
                        $targetMoney->employee_id = $salesman;
                        $targetMoney->teamLeader_id = $teamLeader;
                        $targetMoney->target_installment = round($downPayment);
                        $targetMoney->target_Date = date('Y-m-d');
                        $targetMoney->save();

                        //target Installment amopunt salesman

                        $salesMans = Employee::where('id', $salesman)->first();
                        $salesMans->incentive_amount += (float) $percentOfDownPayment;
                        $salesMans->achieve_inst += request('total');
                        $salesMans->save();
                    }
                } else {
                }

                //end

                return back()->with('message', 'Investor Payment Successfully!!!');
            } catch (\Throwable $th) {
                return  $th;
            }
        }

        return view('backend.investor.investorPay', compact('data', 'investor'));
    }
    //paymentList
    public function paymentList()
    {
        $data = array();
        $data['active_menu'] = 'InvestorList';
        $data['page_title'] = 'Payment List';
        $investorPay = InvestorPay::all();
        return view('backend.investor.paymentList', compact('data', 'investorPay'));
    }
    //investorPayDelete
    public function investorPayDelete($id)
    {
        InvestorPay::find($id)->delete();
        return back()->with('message', 'Investor Payment Deleted Successfully!!!');
    }
    ////investorPay_view
    public function investorPay_view($id)
    {
        $investorPay = InvestorPay::find($id);
        return view('backend.investor.investorPay_view', compact('investorPay'));
    }
}
