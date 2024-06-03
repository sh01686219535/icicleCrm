<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Lead;
use App\Models\TeamLeader;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Match_;

class AjaxController extends Controller
{
    //getName
    public function getName()
    {
        $id = request()->serial_No;

        $investorPay = InvestorPay::where('investor_id', $id)->latest()->first();
        $paidMonth = $investorPay->end_month ?? 'null';
        $investor = Investor::where('id', $id)->first();
        $fileNumber = Investor::where('serial_number', $investor->serial_number)
            ->pluck('fileNumber')
            ->toArray();
        $invPaid = InvestorPay::where('investor_id', $id)->sum('total') + $investor->down_payment;
        // $mainamount=$investor->no_of_installment*$investor->inst_per_month;
        $invDue = $investor->allow_amount - $invPaid;

        if ($investorPay) {
            // $installment_number = InvestorPay::where('investor_id', $id)->count();
            $installment_number = InvestorPay::where('investor_id', $id)
                ->orderBy('created_at', 'desc')
                ->select('number_installment_upcomming')
                ->first();
        } else {
            $installment_number = 0;
        }

        //start sharif
        $result = null;
        if ($id) {
            $investors = Investor::where('id', $id)->select('start_from', 'start_to', 'no_of_installment')->first();

            if ($investors) {
                $startFrom = new DateTime($investors->start_from);
                $startTo = new DateTime($investors->start_to);
                $noOfInstallment = (int) $investors->no_of_installment;

                // Calculate the difference in months
                $interval = $startFrom->diff($startTo);
                $monthsDifference = $interval->m + ($interval->y * 12);

                // Divide by the number of installments
                $result = round($monthsDifference / $noOfInstallment);
            } else {
                // No data found for the given ID
                echo "No investor found with ID: $id";
            }
        }

        //end sharif


        return response()->json([$investor, $paidMonth, $invPaid, $invDue, $installment_number, $investors, $result, $fileNumber]);
    }
    //getAssist
    public function getAssist(Request $request)
    {
        $lead = $request->lead;
        $assist = Lead::where('id', $lead)->first();
        $phoneNumber = $assist->phone_number;
        $team_leader = $assist->teamLeader->name;
        $teamEmail = $assist->email;
        $job_title = $assist->job_title;
        $city = $assist->city;
        // $html = '<option value="">Select Sales Person</option>';
        // foreach ($assist as $item) {
        //     $html .= '<option value="' . $item->id . '">' . $item->phone_number ?? '-' . '</option>';
        // }
        return response()->json([$phoneNumber, $team_leader, $teamEmail, $job_title, $city]);
    }
    //getTeamLeader
    public function getTeamLeader(Request $request)
    {
        $lead = $request->lead;
        $assist = Lead::where('id', $lead)->get();
        $html = '<option value="">Select Sales Person</option>';
        foreach ($assist as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->teamLeader->name ?? '-' . '</option>';
        }
        return response()->json($html);
    }
    //getPermission
    public function getPermission(Request $request)
    {
        $module_id = $request->post('module_id');
        $subModule = DB::table('sub_modules')->where('module_id', $module_id)->get();
        $html = '<option value="">Select A Sub Module</option>';
        foreach ($subModule as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->subModule_name . '</option>';
        }
        return response()->json($html);
    }
    //ratio
    public function ratio(Request $request)
    {
        $rol = $request->user_role;

        $booking_ratio = DB::table('roles')->where('id', $rol)->first();
        $ratio1 = $booking_ratio->booking_ratio;
        $ratio2 = $booking_ratio->installment_ratio;
        return response()->json([$ratio1, $ratio2]);
    }
    //getExitingAssist
    public function getExitingAssist(Request $request)
    {
        $lead = $request->lead;
        $assist = Lead::where('id', $lead)->first();
        $phoneNumber = $assist->phone_number;
        $team_leader = $assist->teamLeader->name;
        $teamEmail = $assist->email;
        $job_title = $assist->job_title;
        $city = $assist->city;
        // $html = '<option value="">Select Sales Person</option>';
        // foreach ($assist as $item) {
        //     $html .= '<option value="' . $item->id . '">' . $item->phone_number ?? '-' . '</option>';
        // }
        return response()->json([$phoneNumber, $team_leader, $teamEmail, $job_title, $city]);
    }
    //getTeamSales
    public function getTeamSales(Request $request)
    {
        $team_leader = $request->team_leader;
        $lead = Employee::where('teamLeader_id', $team_leader)->get();
        $html = '<option value="">Select Sales Officer</option>';
        foreach ($lead as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
        return response()->json($html);
    }
    //getTeamLeader
    public function getTeam(Request $request)
    {
        $cmo = $request->cmo;
        $lead = TeamLeader::where('cmo', $cmo)->get();
        $html = '<option value="">Select Team Leader</option>';
        foreach ($lead as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
        return response()->json($html);
    }
    //getGmSalesPerson
    public function getGmSalesPerson(Request $request)
    {
        $team_leader = $request->team_leader;
        $lead = Employee::where('teamLeader_id', $team_leader)->get();
        $html = '<option value="">Select Sales Officer</option>';
        foreach ($lead as $item) {
            $html .= '<option value="' . $item->id . '">' . $item->name . '</option>';
        }
        return response()->json($html);
    }
    //getGmTeamLeader
    public function getGmTeamLeader(Request $request)
    {
        $gmId = $request->gmId;
        $employee = TeamLeader::where('gm', $gmId)->get();
        $html = '<option>Select Team Leader</option>';
        foreach ($employee as  $value) {
            $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }
        return response()->json($html);
    }
    //getMultiInvestor
    public function getMultiInvestor()
    {
        $serial_number = request('serial_number');
        $investor = Investor::where('id', $serial_number)->first(); // Assuming serial_number is the correct field to filter by.

        if (!$investor) {
            return response()->json(['error' => 'No investor found'], 404);
        }

        return response()->json($investor); // Directly return the investor object.
    }
}
