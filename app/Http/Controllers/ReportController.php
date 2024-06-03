<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\CoursePay;
use App\Models\Employee;
use App\Models\Event;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\TargetMoney;
use App\Models\Task;
use App\Models\TeamLeader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //workReport
    public function workReport()
    {
        $data = array();
        $data['active_menu'] = 'reportList';
        $data['page_title'] = 'Selse Report';
        $task = Task::all();
        return view('backend.report.selseWorkReport', compact('data', 'task'));
    }
    //taskReport
    public function taskReport(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'reportList';
        $data['page_title'] = 'Selse Report';
        $start_date = $request->from_date;
        $end_date = $request->to_date;

        $task = Task::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();
        return view('backend.report.selseWorkReport', compact('data', 'task'));
    }
    //investorReport
    public function investorReport(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'investorReport';
        $data['page_title'] = 'Investor Report';

        $investor = Investor::all();
        return view('backend.report.investorReport', compact('data', 'investor'));
    }
    //postInvestorReport
    public function postInvestorReport(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'investorReport';
        $data['page_title'] = 'Investor Report';
        $start_date = $request->from_date;
        $end_date = $request->to_date;

        $investor = Investor::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();

        return view('backend.report.investorReport', compact('data', 'investor'));
    }
    //dueReport
    public function dueReport(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'dueReport';
        $data['page_title'] = 'Due Report';
        $start_date = \Carbon\Carbon::parse($request->from_date);
        $end_date = \Carbon\Carbon::parse($request->to_date);
        $currentMonth = \Carbon\Carbon::now()->month;

        $investors = Investor::all();
        return view('backend.report.dueReport', compact('data', 'start_date', 'end_date', 'investors'));
    }
    //postDueReport
    public function postDueReport(Request $request)
    {
        $data = array();
        $data['active_menu'] = 'dueReport';
        $data['page_title'] = 'Due Report';
        $start_date = $request->from_date;
        $end_date = $request->to_date;

        $dueAmount = InvestorPay::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->get();

        return view('backend.report.investorReport', compact('data', 'dueAmount'));
    }
    //targetReport
    public function targetReport()
    {
        $data = array();
        $data['active_menu'] = 'targetReport';
        $data['page_title'] = 'Target Report';
        $currentMonth = now()->month;
        // $targetMoney = TargetMoney::whereMonth('created_at', $currentMonth)
        // ->get()
        // ->groupBy('employee_id');
        $targetMoney = TargetMoney::with('target', 'employee', 'teamLeader')->select(DB::raw('sum(target_installment) as total_paid'), 'employee_id', 'teamLeader_id', 'target_id')
            ->groupBy('employee_id', 'teamLeader_id', 'target_id')
            ->get();
        // dd($targetMoney);
        return view('backend.report.targetReport', compact('targetMoney', 'data'));
    }
    //monthlyTarget
    public function monthlyTarget()
    {
        $data = array();
        $data['active_menu'] = 'targetReport';
        $data['page_title'] = 'Target Report';
        $employee = Employee::all();

        return view('backend.report.targetReport', compact('employee', 'data'));
    }
    //incentiveRatio

    public function incentiveRatio()
    {
        $data = array();
        $data['active_menu'] = 'incentiveRatio';
        $data['page_title'] = 'Incentive Ratio';

        $start_date = request('from_date');
        $end_date = request('to_date');

        if ($start_date && $end_date) {
            $currentMonth = now()->month;
            // Booking and down payment money
            $downPayment = Investor::whereBetween('created_at', [$start_date, $end_date])->sum('down_payment');
            $bookingMoney = InvestorPay::whereBetween('created_at', [$start_date, $end_date])->sum('booking_money');
            $totalMoney = $downPayment + $bookingMoney;

            // Installment
            $installmentAmount = InvestorPay::whereBetween('created_at', [$start_date, $end_date])->sum('total');
        } else {
            $currentMonth = now()->month;
            // Booking and down payment money
            $downPayment = Investor::whereMonth('created_at', $currentMonth)->sum('down_payment');
            $bookingMoney = InvestorPay::whereMonth('created_at', $currentMonth)->sum('booking_money');
            $totalMoney = $downPayment + $bookingMoney;

            // Installment
            $installmentAmount = InvestorPay::whereMonth('created_at', $currentMonth)->sum('total');
        }

        return view('backend.report.incentiveRatio', compact('data', 'totalMoney', 'installmentAmount'));
    }
}
