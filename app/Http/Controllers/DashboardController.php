<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthAdmin;
use App\Models\AdminAuth;
use App\Models\Batch;
use App\Models\Booking;
use App\Models\CoursePay;
use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Lead;
use App\Models\Target;
use App\Models\TargetMoney;
use App\Models\Task;
use App\Models\TeamLeader;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = array();
        $data['active_menu'] = 'dashboard';
        $data['page_title'] = 'Dashboard';
        //total investor
        $bookingMoney = Investor::sum('down_payment');
        $investor = Investor::where('investor_status', 'approve')->count('id');
        $administrate = Auth::guard('admin')->user()->id;
        // dd($administrate);
        $currentMonth = now()->month;
        // total client current month
        $currentInvestor = Investor::where('investor_status', 'approve')->orWhere('created_at',$currentMonth)->count('id');

        //todays
        $todays = Task::whereMonth('created_at', $currentMonth)->where('employee_name', $administrate)->select('todays_update', 'lead_user')->get();
        //futureOrToDo

        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d');


        $bookingMoneyMonthly = Investor::whereMonth('created_at', $currentMonth)->sum('down_payment');
        // current month in income
        $investors = Investor::whereMonth('created_at', $currentMonth)->sum('inst_per_month');
        $main_amount = Investor::sum('main_amount');
        // total amount 
        $totalAmount = $main_amount;

        $monthlyPaid = InvestorPay::whereMonth('created_at', $currentMonth)->sum('total');
        // total income
        $totalBookingMoney = Investor::sum('down_payment');

        $totalIncome = InvestorPay::sum('total') + InvestorPay::sum('booking_money')  + $totalBookingMoney;
        $monthlyUnpaid = $investors -  $monthlyPaid;
        $total_unpaid = $totalAmount - $totalIncome;
        $currentMonthName = now()->format('F');

        $salesMan = Employee::where('authId', $administrate)->select('name', 'id')->first();

        $teamLeader = TeamLeader::where('authId', $administrate)->select('name', 'id')->first();

        $Investor = Investor::where('auth_id', $administrate)->select('name', 'id')->first();
        // dd($Investor);
        // All count icon
        $lead = Lead::count('id');
        $sglLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])->count();
        $junkLead = Task::whereIn('status', ['Not Interested'])->count();
        $clientList = Investor::where('status', 'accept')->count();
        $mplLead = Lead::where('status', 'MPL')->count();
        $sglLead = Lead::where('status', 'SGL')->count();
        //cmo & gm
        $cmoGM = Auth::guard('admin')->user()->user_role;
        $cmo = AdminAuth::where('user_role', $cmoGM)->where('user_role', 8)->first();
        $gm = AdminAuth::where('user_role', $cmoGM)->where('user_role', 9)->first();


        if ($cmo || $gm) {
            if ($gm) {
                $gmId = $gm->id;
                $teamLeaderCount = TeamLeader::where('gm', $gmId)->count();
                $employee = Employee::where('gm', $gmId)->count();


                $lead = Lead::where('gm', $gmId)->count('id');


                $activeLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
                    ->where('gm', $gmId)
                    ->count();
                $junkLead = Task::whereIn('status', ['Not Interested'])
                    ->where('gm', $gmId)
                    ->count();
                $clientList = Investor::where('status', 'accept')
                    ->where('employee_id', $gmId)
                    ->count();
                $mplLead = Lead::where('status', 'MPL')
                    ->where('gm', $gmId)
                    ->count();
                $sglLead = Lead::where('status', 'SGL')
                    ->where('gm', $gmId)
                    ->count();
                //target money
                $currentMonth = now()->month;
                $target = Target::whereMonth('targetDate', $currentMonth)
                    ->where('employee_id', null)
                    ->orWhere('gm_id', $gmId)
                    ->select('targetAmount')
                    ->first();
                    

                if ($target) {
                    // $targetMoney = $target->targetAmount;
                    $currentMonth = now()->month;
                    $targetMoney = Target::whereMonth('targetDate', $currentMonth)
                        ->where('employee_id', null)
                        ->where('gm_id', $gmId)
                        ->sum('targetAmount');
                        
                    $employeeTarget = TargetMoney::whereMonth('target_Date', $currentMonth)
                        ->where('employee_id', null)
                        ->orWhere('gm_id', $gmId)
                        ->sum('target_installment');
                    $unpaidAmount = $targetMoney - $employeeTarget;
                } else {
                    $targetMoney = null;
                    $employeeTarget = null;
                    $unpaidAmount = null;
                }
                return view('backend.AuthUser.cmoGM', compact('junkLead','sglLead','mplLead','activeLead','teamLeaderCount', 'employee', 'gm', 'data', 'lead', 'targetMoney', 'employeeTarget', 'unpaidAmount', 'currentMonthName'));
            } elseif ($cmo) {
                $cmoId = $cmo->id;
                $teamLeaderCount = TeamLeader::where('cmo', $cmoId)->count();
                $employee = Employee::where('cmo', $cmoId)->count();
                $auth = AdminAuth::where('name', $cmo)->first();

                $lead = Lead::where('cmo', $cmoId)->count('id');
    
                $activeLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
                    ->where('cmo',$cmoId)
                    ->count();
                  
                $junkLead = Task::whereIn('status', ['Not Interested'])
                    ->where('cmo', $cmo)
                    ->count();
                $clientList = Investor::where('status', 'accept')
                    ->where('employee_id', $cmo)
                    ->count();
                $mplLead = Lead::where('status', 'MPL')
                    ->where('cmo', $cmoId)
                    ->count();
                $sglLead = Lead::where('status', 'SGL')
                    ->where('cmo', $cmoId)
                    ->count();
                //target money
                $currentMonth = now()->month;
                
                    $target = Target::whereMonth('targetDate', $currentMonth)
                    ->where('employee_id', null)
                    ->orWhere('cmo_id', $cmoId)
                    ->select('targetAmount')
                    ->first();

                if ($target) {
                    // $targetMoney = $target->targetAmount;
                    $currentMonth = now()->month;
                    $targetMoney = Target::whereMonth('targetDate', $currentMonth)
                        ->where('employee_id', null)
                        ->where('cmo_id', $cmoId)
                        ->sum('targetAmount');
                    $employeeTarget = TargetMoney::whereMonth('target_Date', $currentMonth)
                        ->where('employee_id', null)
                        ->orWhere('cmo_id', $cmoId)
                        ->sum('target_installment');
                    $unpaidAmount = $targetMoney - $employeeTarget;
                } else {
                    $targetMoney = null;
                    $employeeTarget = null;
                    $unpaidAmount = null;
                }
                return view('backend.AuthUser.mainCmo', compact('junkLead','sglLead','mplLead','activeLead','lead','teamLeaderCount', 'employee', 'cmo', 'data', 'targetMoney', 'employeeTarget', 'unpaidAmount', 'currentMonthName'));
            }
        }
        //salesMan
        if ($salesMan) {
            $salesManName  = $salesMan->name;
            $salesManId  = $salesMan->id;
            $currentDateTime = new DateTime('now');
            $currentDate = $currentDateTime->format('Y-m-d');

            $toDo = Task::whereDate('next_action_date', $currentDate)
                ->where('employee_name', $salesManId)
                ->where('update_status', 'pending')
                ->select('next_action', 'lead_user', 'lead_phone', 'todays_update', 'status', 'id')
                ->get();
            $employee = Employee::where('id', $salesManId)->select('bookingIncentive', 'incentive_amount')->first();

            $bookingMoney = $employee->bookingIncentive;
            $incentive_amount = $employee->incentive_amount;
            $salesPersonCount = Investor::where('salesId', $salesManId)->count();
            $auth = AdminAuth::where('name', $salesManName)->first();
            //    show icon dashboard
            $lead = Lead::where('sales_officer', $salesManId)->count('id');
            $activeLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
                ->where('employee_name', $salesManName)
                ->count();
            $junkLead = Task::whereIn('status', ['Not Interested'])
                ->where('employee_name', $salesManName)
                ->count();
            $clientList = Investor::where('status', 'accept')
                ->where('employee_id', $salesManId)
                ->count();
            $mplLead = Lead::where('status', 'MPL')
                ->where('sales_officer', $salesManId)
                ->count();
            $sglLead = Lead::where('status', 'SGL')
                ->where('sales_officer', $salesManId)
                ->count();
            $targetMoney = Employee::where('id', $salesManId)->first();
            //target money
            $currentMonth = now()->month;
            $target = Target::where('employee_id', $salesManId)->whereMonth('targetDate', $currentMonth)->select('targetAmount')->first();
            if ($target) {
                $targetMoney = $target->targetAmount;
                $employeeTarget = TargetMoney::where('employee_id', $salesManId)->sum('target_installment');
                $unpaidAmount = $targetMoney - $employeeTarget;
                // $targetMoney = Employee::where('id', $salesManId)->first();

            } else {
                $targetMoney = null;

                $employeeTarget = null;

                $unpaidAmount = null;
            }
            return view('backend.AuthUser.salesPerson', compact('auth', 'data', 'todays', 'toDo', 'salesPersonCount', 'bookingMoney', 'incentive_amount', 'lead', 'sglLead', 'junkLead', 'clientList', 'mplLead', 'activeLead', 'targetMoney', 'employeeTarget', 'unpaidAmount'));
        } elseif ($teamLeader) {
            // dd($teamLeader);
            $teamLeaderName = $teamLeader->name;
            $teamLeadId  = $teamLeader->id;
            $employee = TeamLeader::where('id', $teamLeadId)->select('bookingIncentive', 'incentive_amount')->first();
            $bookingMoney = $employee->bookingIncentive;
            $incentive_amount = $employee->incentive_amount;
            $teamLeaderCount = Investor::where('teamId', $teamLeadId)->count();
            $auth = AdminAuth::where('name', $teamLeaderName)->first();
            $TeamLeaderLead = Lead::where('leader_id', $teamLeadId)->count();
            $employeeCount = Employee::where('teamLeader_id', $teamLeadId)->count();

            // icon count dashboard
            $lead = Lead::where('team_leader', $teamLeadId)->count('id');
            $activeLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])
                ->where('team_leader', $teamLeadId)
                ->count();
            $junkLead = Task::whereIn('status', ['Not Interested'])
                ->where('team_leader', $teamLeadId)
                ->count();
            $clientList = Investor::where('status', 'accept')
                ->where('team_leader', $teamLeadId)
                ->count();
            $mplLead = Lead::where('status', 'MPL')
                ->where('team_leader', $teamLeadId)
                ->count();
            $sglLead = Lead::where('status', 'SGL')
                ->where('team_leader', $teamLeadId)
                ->count();

            $currentMonth = now()->month;
            $target = Target::whereMonth('targetDate', $currentMonth)->where('teamLeader_id', $teamLeadId)->select('targetAmount')->first();
           
            if ($target) {
                $targetMoney = $target->targetAmount;
                $employeeTarget = TargetMoney::whereMonth('target_Date', $currentMonth)->where('teamLeader_id', $teamLeadId)->sum('target_installment') ?? 0;
                $unpaidAmount = $targetMoney - $employeeTarget;
            } else {
                $targetMoney = null;
                $employeeTarget = null;
                $unpaidAmount = null;
            }

            return view('backend.AuthUser.teamLeader', compact('auth', 'data', 'todays', 'teamLeaderCount', 'bookingMoney', 'incentive_amount', 'lead', 'sglLead', 'junkLead', 'clientList', 'mplLead', 'sglLead', 'TeamLeaderLead', 'employeeCount', 'targetMoney', 'employeeTarget', 'unpaidAmount', 'currentMonthName'));
        } elseif ($Investor) {
            $teamLeaderName = $Investor->name;
            $investor = Investor::where('name', $teamLeaderName)->first();
            $auth = AdminAuth::where('name', $teamLeaderName)->first();
            $booking = Booking::select('status')->get();
            return view('backend.AuthUser.Investor', compact('auth', 'data', 'investor', 'booking'));
        } else {

            //target money
            $currentMonth = now()->month;

            $target = Target::whereMonth('targetDate', $currentMonth)->select('targetAmount')->first();
            // dd($target);
            if ($target) {
                $currentMonth = now()->month;
                //total
                $targetMoney = Target::whereMonth('targetDate', $currentMonth)->sum('targetAmount');
                $employeeTarget = TargetMoney::whereMonth('target_Date', $currentMonth)->sum('target_installment');
                $unpaidAmount = $targetMoney - $employeeTarget;
                //teamA
                $targetMoneyCmo = Target::whereMonth('targetDate', $currentMonth)
                    ->where('cmo_id',149)->sum('targetAmount');
                $employeeTargetCmo = TargetMoney::whereMonth('target_Date', $currentMonth)->where('cmo_id',149)->sum('target_installment');
                $unpaidAmountCmo = $targetMoney - $employeeTarget;
                //teamB
                $targetMoneyGm = Target::whereMonth('targetDate', $currentMonth)
                    ->where('gm_id',155)->sum('targetAmount');
                $employeeTargetGm = TargetMoney::whereMonth('target_Date', $currentMonth)->where('gm_id',155)->sum('target_installment');
                $unpaidAmountGm = $targetMoney - $employeeTarget;
            } else {
                $targetMoney = null;
                $employeeTarget = null;
                $unpaidAmount = null;
                $targetMoneyCmo=null;
                $employeeTargetCmo=null;
                $unpaidAmountCmo=null;
                 $targetMoneyGm=null;
                $employeeTargetGm=null;
                $unpaidAmountGm=null;
                
            }

            return view('backend.dashboard.dashboard', compact('investor', 'data', 'investors', 'monthlyPaid', 'monthlyUnpaid', 'currentMonthName', 'totalAmount', 'totalIncome', 'total_unpaid', 'bookingMoney', 'bookingMoneyMonthly', 'lead', 'sglLead', 'junkLead', 'clientList', 'mplLead', 'sglLead', 'targetMoney', 'employeeTarget', 'unpaidAmount', 'targetMoney','targetMoneyCmo','employeeTargetCmo','unpaidAmountCmo','targetMoneyGm','employeeTargetGm','unpaidAmountGm','currentInvestor'));
        }
    }
}
