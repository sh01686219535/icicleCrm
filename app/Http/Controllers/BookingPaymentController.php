<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Target;
use App\Models\TargetMoney;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingPaymentController extends Controller
{
    public function downPayment()
    {
        $investor = Investor::all()->unique('serial_number');
        $data = array();
        $data['active_menu'] = 'downPayment';
        $data['page_title'] = 'Down Pay';

        if (request()->isMethod('post')) {
            try {
                // dd(request()->all());
                $investorId = request('serial_No');
                $investor = Investor::find($investorId);
                if ($investor) {
                    $mainAmount = $investor->main_amount;
                    $no_of_installment = $investor->no_of_installment;

                    $mainInstallAmount = $mainAmount - request('booking_money');
                    $divisionAmount = $mainInstallAmount / $no_of_installment;

                    $investor->inst_per_month = $divisionAmount;
                    $investor->main_amount = $mainInstallAmount;
                    $investor->save();
                } else {
                }

                InvestorPay::create([
                    'investor_id' => request('serial_No'),
                    'fileNumber' => request('fileNumber'),
                    'per_int_amount_word' => request('per_int_amount'),
                    'bank_name' => request('bank_name'),
                    'branch_name' => request('branch_name'),
                    'payment_type' => request('payment_type'),
                    'chqNo' => request('chqNo'),
                    'booking_money' => request('booking_money'),
                    'project_name' => request('project_name'),
                ]);
                if (request('email')) {
                $data = ['email' => request('email')];

                Mail::send('email.investorDownMail', $data, function ($message) use ($data) {
                    $message->from('icicles47@gmail.com', 'Admin');
                    $message->to( $data['email'])
                        ->subject('DownPayment Successfully Done');
                });
                }

                $downPayment = floatval(request('booking_money'));
                $teamLeader = request('team_leader');

                $salesman =  request('employee_id');

                if ($teamLeader || $salesman) {
                    $teamLeaders = TeamLeader::where('id', $teamLeader)->first();

                    $percent = 3.50;
                    $teamPercent = 0.85;
                    $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                    $percentOfDownPayment = round(($percent / 100) * $downPayment);

                    $teamLeaders->incentive_amount += (float) $teamLeaderDownPayment;
                    $teamLeaders->save();
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
                    // target Id
                    // $teamId = Target::where('teamLeader_id', $teamLeader)
                    //     ->select('id')
                    //     ->first();
                    $employee = Target::where('employee_id', $salesman)
                        ->select('id')
                        ->first();
                    if ($employee) {
                        $employeeId = $employee->id;

                        $targetMoney = new TargetMoney();
                        $targetMoney->gm_id = $gm;
                        $targetMoney->target_id = $employeeId;
                        $targetMoney->cmo_id = $cmo;
                        $targetMoney->employee_id = $salesman;
                        $targetMoney->teamLeader_id = $teamLeader;
                        $targetMoney->target_installment = round($downPayment);
                        $targetMoney->target_Date = date('Y-m-d');
                        $targetMoney->save();
                        //target Installment amopunt salesman

                        $salesMans = Employee::where('id', $salesman)->first();
                        $salesMans->incentive_amount += (float) $percentOfDownPayment;
                        $salesMans->achieve_inst += request('booking_money');
                        $salesMans->save();
                    }
                } else {
                }


                return back()->with('message', 'Investor Payment Successfully!!!');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return view('backend.investor.bookingMoney', compact('investor', 'data'));
    }
}
