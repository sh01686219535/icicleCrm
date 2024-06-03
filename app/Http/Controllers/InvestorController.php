<?php

namespace App\Http\Controllers;

use App\Mail\InvestorEmail;
use App\Models\AdminAuth;
use App\Models\Employee;
use App\Models\Investor;
use App\Models\InvestorPay;
use App\Models\Lead;
use App\Models\Target;
use App\Models\TargetMoney;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use PDOException;
use PDF;
use Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;


class InvestorController extends Controller
{
    public function investor_create()
    {
        $data = array();
        $data['active_menu'] = 'Investor';
        $data['page_title'] = 'Investor Create';
        // $employee = Employee::all();
        $team_lead = TeamLeader::all();
        $employee = Employee::all();
        // $investor = Investor::select('serial_number');
        // $lastInves = Investor::orderBy('id', 'desc')->first();

        // if (request('project_name') == 'THE SALTANAT HOTEL & RESORT') {
        //     $serialPrefix = 'SAL-';
        //     $defaultSerialNum = 'SAL-1251';
        // } elseif (request('project_name') == 'SALTANAT TEA RESORT') {
        //     $serialPrefix = 'STR-';
        //     $defaultSerialNum = 'STR-3501';
        // } else {
        //     // Default serial number if project_name does not match any condition
        //     $serialPrefix = 'DefaultPrefix-';
        //     $defaultSerialNum = 'DefaultSerialNum'; // Set your default serial number here
        // }

        // $serialNum = $defaultSerialNum;

        // if ($lastInves && $lastInves->serial_number) {
        //     //
        //     $numericPart = $lastInves->serial_number;
        //     $parts = explode("-", $numericPart);

        //     if (count($parts) == 3) {

        //         $secondPart = $parts[2];

        //         $incrementedSecondPart = (int)$secondPart + 1;

        //         $numericPart = $parts[0] . '-' .$parts[1] . '-' . $incrementedSecondPart;

        //     } else {
        //         dd("Invalid numeric part format", $numericPart, $parts);
        //     }
        //     //
        //     // dd($newNumericPart);

        //     // $numericPart = (int) substr($lastInves->serial_number, 3);
        //     // $newNumericPart = $numericPart + 1;
        //     // dd($numericPart);

        //     // $newSerialNum = $serialPrefix . $newNumericPart;
        //     $existingSerial = Investor::where('serial_number', $numericPart)->exists();
        //     while ($existingSerial) {
        //         $numericPart++;
        //         $newSerialNum = $serialPrefix . $numericPart;
        //         $existingSerial = Investor::where('serial_number', $newSerialNum)->exists();
        //     }
        //     $serialNum = $newSerialNum;
        //     dd( $serialNum);

        // }

        $investor = Investor::select('serial_number');

        if (request()->isMethod('post')) {

            // Get the last investor record based on the project name
            if (request('project_name') == 'THE SALTANAT HOTEL & RESORT') {
                $lastInves = Investor::where('serial_number', 'like', 'SAL-%')->orderBy('id', 'desc')->first();
                $serialPrefix = 'SAL-';
                $defaultSerialNum = 'SAL-1251';
            } elseif (request('project_name') == 'SALTANAT TEA RESORT') {
                $lastInves = Investor::where('serial_number', 'like', 'STR-%')->orderBy('id', 'desc')->first();
                $serialPrefix = 'STR-';
                $defaultSerialNum = 'STR-3501';
            } else {

                // If the project name doesn't match, set defaults
                $serialPrefix = 'DefaultPrefix-';
                $defaultSerialNum = 'DefaultSerialNum';
            }
            $currentDate = Carbon::now()->format('y/m');

            // If there's a valid last investor record, proceed with generating the serial number
            if ($lastInves) {

                $numericPart = substr($lastInves->serial_number, 10);

                $newNumericPart = (int)$numericPart + 1;

                $serialNum = $serialPrefix . $currentDate . '-' . $newNumericPart;
            } else {
                // If no previous record for the project, use the default serial number
                $serialNum = $defaultSerialNum;
            }

            // Debug to see the generated serial number

            // Here you can save the $serialNum to the database or use it as needed


            try {
                if (request()->hasFile('user_image')) {
                    $extension = request()->file('user_image')->extension();
                    $photo_name = 'backend/img/user/' . uniqid() . '.' . $extension;
                    request()->file('user_image')->move('backend/img/user', $photo_name);
                } else {
                    $photo_name = null;
                }
                if (request()->hasFile('nominee_image')) {
                    $extension = request()->file('nominee_image')->extension();
                    $image_name = 'backend/img/nominee/' . uniqid() . '.' . $extension;
                    request()->file('nominee_image')->move('backend/img/nominee', $image_name);
                } else {
                    $image_name = null;
                }
                $status = 'accept';
                $serialNumber = request('serial_number');
                AdminAuth::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'image' => $photo_name,
                    'password' => bcrypt(request('password')),
                    'user_role' => '7',
                    'designation' => 'Investor',
                    'serial_number' => $serialNum,
                ]);
                $authAdminId = AdminAuth::all()->last()->id;

                $investorListPdf = Investor::create([
                    'status' => $status,
                    'serial_number' => $serialNum,
                    'fileNumber' => request('fileNumber'),
                    'name' => request('name'),
                    'user_image' => $photo_name,
                    'fathers_name' => request('fathers_name'),
                    'mothers_name' => request('mothers_name'),
                    'spouse_name' => request('spouse_name'),
                    'birth_date' => request('birth_date'),
                    'spouse_date_birth' => request('spouse_date_birth'),
                    'marriage' => request('marriage'),
                    'present_address' => request('present_address'),
                    'permanent_address' => request('permanent_address'),
                    'phone' => request('phone'),
                    'alternativePhone' => request('alternativePhone'),
                    'main_amount' => round(request('main_amount')),
                    'email' => request('email'),
                    'quarterly' => request('quarterly'),
                    'half_yearly' => request('half_yearly'),
                    'at_a_time' => request('at_a_time'),
                    'yearly' => request('yearly'),
                    'facebook' => request('facebook'),
                    'Profession' => request('profession'),
                    'religion' => request('religion'),
                    'office_address' => request('office_address'),
                    'nid_passport' => request('nid_passport'),
                    'nationality' => request('nationality'),
                    'project_name' => request('project_name'),
                    'project_address' => request('project_address'),
                    'ownership_size' => request('ownership_size'),
                    'category_ownership' => request('category_ownership'),
                    'no_ownership' => round(request('no_ownership')),
                    'price_ownership' => round(request('price_ownership')),
                    'special_discount' => round(request('special_discount')),
                    'special_discount_word' => request('special_discount_word'),
                    'agreed_price' => round(request('agreed_price')),
                    'agreed_price_word' => request('agreed_price_word'),
                    'installment' => request('installment'),
                    'nominee_name' => request('nominee_name'),
                    'nominee_cell_no' => request('nominee_cell_no'),
                    'relation_to_nominee' => request('relation_to_nominee'),
                    'nominee_image' => $image_name,
                    'reference_name_a' => request('reference_name_a'),
                    'reference_cell_a' => request('reference_cell_a'),
                    'reference_name_b' => request('reference_name_b'),
                    'reference_cell_b' => request('reference_cell_b'),
                    'down_payment' => request('down_payment'),
                    'down_payment_date' => request('down_payment_date'),
                    'down_payment_inWord' => request('down_payment_inWord'),
                    'payment_type2' => request('payment_type2'),
                    'payment_type_date2' => request('payment_type_date2'),
                    'no_of_installment' => round(request('no_of_installment')),
                    'inst_per_month' => round(request('inst_per_month')),
                    'start_from' => request('start_from'),
                    'start_to' => request('start_to'),
                    'others_instruction' => request('others_instruction'),
                    'chq' => request('chq'),
                    'bank_name' => request('bank_name'),
                    'branch_name' => request('branch_name'),
                    'allow_amount' => request('allow_amount'),
                    'online_payment' => request('online_payment'),
                    'passport' => request('passport'),
                    'employee_id' => request('employee_id'),
                    'team_leader' => request('team_leader'),
                    'auth_id' => $authAdminId,
                ]);



                // $inv = Investor::all()->last()->id;
                // $investorData = Investor::where('id', $inv)->first();
                // $investorArray = ['investor' => $investorData];
                // $pdf = PDF::loadView('backend.pdf.investorPdf', $investorArray);


                // $data = ['name' => request('email'), 'email' => request('email')];

                // Mail::send('email.investorMail', $data, function ($message) use ($data, $pdf) {
                //     $message->from('qrcode950@gmail.com', 'Admin');
                //     $message->to($data['email'], $data['name'])
                //         ->subject('Investor Created')
                //         ->attachData($pdf->output(), "investor.pdf");
                // });

                if (request('investorPdfGenerate') == '1') {
// set_time_limit(1000);
                    $pdf = PDF::loadView('backend.pdf.investorListPdf', compact('investorListPdf'));
                    return $pdf->stream('Investor_details.pdf');
                }

                //booking_incentive
                $downPayment = floatval(request('down_payment'));
                $teamLeader = request('team_leader');
                $salesman = request('employee_id');
                if ($teamLeader || $salesman) {
                    $teamLeaders = TeamLeader::where('id', $teamLeader)->first();

                    // Calculate 3.50 percent of the down payment
                    $percent = 3.50;
                    $teamPercent = 0.85;
                    $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                    $percentOfDownPayment = round(($percent / 100) * $downPayment);
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
                        // foreach ($salesman as $value) {
                        $salesMans = Employee::where('id', $salesman)->first();
                        $salesMans->bookingIncentive += (float) $percentOfDownPayment;
                        $salesMans->save();
                    }

                    // }
                }
                return redirect()->route('investor_create')->with('message', 'Investor Created Successfully!!!');
            } catch (PDOException $e) {
                return $e;
            }
        } else {
        }
        return view('backend.investor.investorCreate', compact('data', 'employee', 'investor', 'team_lead'));
    }
    //investorApprove
    public function investorApprove()
    {
        $data = array();
        $data['active_menu'] = 'investorApprove';
        $data['page_title'] = 'Investor Approve List';
        $investor = Investor::where('investor_status', 'pending')->get();

        return view('backend.investor.investorApproveList', compact('data', 'investor'));
    }
    //comment
    public function comment($id)
    {
        try {
            $investor = Investor::find($id);
            $investor->comments = request('comments');
            $investor->investor_status = 'approve';
            $investor->save();
            return back()->with('message', 'Comment Done For Approval');
        } catch (\Throwable $th) {
            return $th;
        }
    }
    //approve
    public function approve($id)
    {
        $investor = Investor::find($id);
        $investor->investor_status = 'approve';
        $investor->save();
        return back()->with('message', 'Investor Approved Successfully!!!');
    }
    //investorList
    public function investorList()
    {
        $data = array();
        $data['active_menu'] = 'investorList';
        $data['page_title'] = 'Investor List';

        $authId = Auth::guard('admin')->user()->id;
        $employee = Employee::where('authId', $authId)->select('id')->first();
        $teamLeader = TeamLeader::where('authId', $authId)->select('id')->first();
        // $investor = Investor::where('investor_status', 'approve')
        //     ->where('employee_id', $employee->id)
        //     ->get();
        if ($employee) {
            $investor = Investor::where('investor_status', 'approve')
                ->where('employee_id', $employee->id)
                ->get();
        } elseif ($teamLeader) {
            $investor = Investor::where('investor_status', 'approve')
                ->where('team_leader', $teamLeader->id)
                ->get();
        } else {
            $investor = Investor::where('investor_status', 'approve')->get();
        }

        return view('backend.investor.investorList', compact('data', 'investor'));
    }
    //investor_delete
    public function investor_delete($id)
    {
        $investor = Investor::find($id);
        $investors = $investor->user_image;
        $investorsNominee = $investor->nominee_image;
        if (File::exists($investors)) {
            File::delete($investors);
        }
        if (File::exists($investorsNominee)) {
            File::delete($investorsNominee);
        }
        $investor->delete();
        return back()->with('message', 'Investor Deleted Successfully!!!');
    }
    //investorShow
    public function investorShow($id)
    {
        $investor = Investor::find($id);
        $employee = Employee::all();
        $team_lead = TeamLeader::all();
        $data = array();
        $data['active_menu'] = 'investorList';
        $data['page_title'] = 'Investor Show';
        if (request()->isMethod('post')) {
            try {
                if (request()->hasFile('user_image')) {
                    $extension = request()->file('user_image')->extension();
                    $photo_name = 'backend/img/user/' . uniqid() . '.' . $extension;
                    request()->file('user_image')->move('backend/img/user', $photo_name);
                } else {
                    $photo_name = null;
                }
                if (request()->hasFile('nominee_image')) {
                    $extension = request()->file('nominee_image')->extension();
                    $image_name = 'backend/img/nominee/' . uniqid() . '.' . $extension;
                    request()->file('nominee_image')->move('backend/img/nominee', $image_name);
                } else {
                    $image_name = null;
                }
                $status = 'accept';
                $investor = Investor::find($id);
                $investorImage =  $investor->photo_name;
                if (File::exists($investorImage)) {
                    File::delete($investorImage);
                }
                // $team_leader = (array) request('team_leader');
                // $employee_id = (array) request('employee_id');
                // $teams = implode(',', $team_leader);
                // $employee = implode(',', $employee_id);
                $investor->update([
                    'serial_number' => request('serial_number'),
                    'name' => request('name'),
                    'user_image' => $photo_name,
                    'fileNumber' => request('fileNumber'),
                    'investor_status' => 'pending',
                    'fathers_name' => request('fathers_name'),
                    'mothers_name' => request('mothers_name'),
                    'spouse_name' => request('spouse_name'),
                    'birth_date' => request('birth_date'),
                    'spouse_date_birth' => request('spouse_date_birth'),
                    'marriage' => request('marriage'),
                    'present_address' => request('present_address'),
                    'permanent_address' => request('permanent_address'),
                    'phone' => request('phone'),
                    'alternativePhone' => request('alternativePhone'),
                    'main_amount' => round(request('main_amount')),
                    'email' => request('email'),
                    'quarterly' => request('quarterly'),
                    'half_yearly' => request('half_yearly'),
                    'at_a_time' => request('at_a_time'),
                    'yearly' => request('yearly'),
                    'facebook' => request('facebook'),
                    'Profession' => request('profession'),
                    'religion' => request('religion'),
                    'office_address' => request('office_address'),
                    'nid_passport' => request('nid_passport'),
                    'nationality' => request('nationality'),
                    'project_name' => request('project_name'),
                    'project_address' => request('project_address'),
                    'ownership_size' => request('ownership_size'),
                    'category_ownership' => request('category_ownership'),
                    'no_ownership' => round(request('no_ownership')),
                    'price_ownership' => round(request('price_ownership')),
                    'special_discount' => round(request('special_discount')),
                    'special_discount_word' => request('special_discount_word'),
                    'agreed_price' => round(request('agreed_price')),
                    'agreed_price_word' => request('agreed_price_word'),
                    'installment' => request('installment'),
                    'nominee_name' => request('nominee_name'),
                    'nominee_cell_no' => request('nominee_cell_no'),
                    'relation_to_nominee' => request('relation_to_nominee'),
                    'nominee_image' => $image_name,
                    'reference_name_a' => request('reference_name_a'),
                    'reference_cell_a' => request('reference_cell_a'),
                    'reference_name_b' => request('reference_name_b'),
                    'reference_cell_b' => request('reference_cell_b'),
                    'down_payment' => request('down_payment'),
                    'down_payment_date' => request('down_payment_date'),
                    'down_payment_inWord' => request('down_payment_inWord'),
                    'payment_type2' => request('payment_type2'),
                    'payment_type_date2' => request('payment_type_date2'),
                    'no_of_installment' => round(request('no_of_installment')),
                    'inst_per_month' => round(request('inst_per_month')),
                    'start_from' => request('start_from'),
                    'start_to' => request('start_to'),
                    'others_instruction' => request('others_instruction'),
                    'chq' => request('chq'),
                    'bank_name' => request('bank_name'),
                    'branch_name' => request('branch_name'),
                    'online_payment' => request('online_payment'),
                    'allow_amount' => request('allow_amount'),
                    'passport' => request('passport'),
                    'employee_id' => request('employee_id'),
                    'team_leader' => request('team_leader'),
                ]);
                // if(request('down_payment')){
                //     $incentive = AdminAuth::create([

                //     ]);
                // }

                $inv = Investor::all()->last()->id;
                $investorData = Investor::where('id', $inv)->first();
                $investorArray = ['investor' => $investorData];

                // if (request('down_payment')) {
                //     $investor = new InvestorPay();
                //     $investor->investor_id  = $investor->id;
                //     $investor->total  = request('down_payment');
                //     $investor->payment_type  = request('payment_type2');
                //     $investor->save();
                // }
                if (request('investorPdfGenerate') == '1') {
                    $pdf = PDF::loadView('backend.pdf.investorListPdf', compact('investorListPdf', 'employees', 'investorWithEmployees'));
                    return $pdf->stream('Investor_details.pdf');
                }

                return redirect()->route('investorList')->with('message', 'Investor Created Successfully!!!');
            } catch (PDOException $e) {
                return $e;
            }
        }
        return view('backend.investor.investorshow', compact('data', 'investor', 'employee', 'team_lead'));
    }
    //unpaidInvestor
    public function unpaidInvestor()
    {
        $data = array();
        $data['active_menu'] = 'investorList';
        $data['page_title'] = 'Investor UnPaid List';
        $currentMonth = Carbon::now()->format('m');
        $paidInvestorIds = InvestorPay::whereMonth('created_at', '=', $currentMonth)->pluck('investor_id');
        $investorPay = Investor::whereNotIn('id', $paidInvestorIds)->get();

        return view('backend.investor.unPaidInvestor', compact('data', 'investorPay'));
    }
    //investor_org_show
    public function investor_org_show($id)
    {
        $investor = Investor::find($id);
        return view('backend.investor.investorOrgShow', compact('investor'));
    }
    //investorAdminShow
    public function investorAdminShow($id)
    {
        $investor = Investor::find($id);
        return view('backend.investor.investorOrgShow', compact('investor'));
    }
    //paymentList
    public function paymentList($id)
    {
        $investor = Investor::find($id);
        $investorPay = InvestorPay::where('investor_id', $id)->first();
        $data = array();
        $data['active_menu'] = 'investorList';
        $data['page_title'] = 'Investor Payment List';
        $investorId = $investor->id;
        $investorPay = InvestorPay::where('investor_id', $investorId)->get();
        return view('backend.investor.investorPayList', compact('investorPay', 'data', 'investorId', 'investorPay'));
    }
     //investorPaymentPdf
     public function investorPaymentPdf($id)
     {
         $investor = Investor::find($id);
         $investorPaid = InvestorPay::where('investor_id', $id)->select('booking_money', 'description')->first();
         if ($investorPaid) {
             $test = $investorPaid->booking_money;
             $investorfirst = $investor->first();
             $investorId = $investor->id;
             $investorPay = InvestorPay::where('investor_id', $investorId)->get();
                         $investorschedule = InvestorPay::where('investor_id', $investorId)->where('booking_money',NULL)->get();

            //  set_time_limit(1000);
            //  return view('backend.pdf.investPaypdf', compact('investorPay', 'investorfirst', 'investor','investorPaid','test'));
             $pdf = PDF::loadView('backend.pdf.investPaypdf', compact('investorPay', 'investorfirst', 'investor', 'investorPaid', 'test','investorschedule'));
             return $pdf->stream('Invest_payment_Details.pdf');
         } else {
            $test = 0;
             $investorfirst = $investor->first();
             $investorId = $investor->id;
             $investorPay = InvestorPay::where('investor_id', $investorId)->get();
                         $investorschedule = InvestorPay::where('investor_id', $investorId)->where('booking_money',NULL)->get();

            //  set_time_limit(1000);
             // return view('backend.pdf.investPaypdf', compact('investorPay', 'investorfirst', 'investor','investorPaid','test'));
             $pdf = PDF::loadView('backend.pdf.investPaypdf', compact('test','investorPay', 'investorfirst', 'investor', 'investorPaid','investorschedule'));
             return $pdf->stream('Invest_payment_Details.pdf');
         }
     }
    //teamLeaderInvestor
    public function teamLeaderInvestor()
    {
        $authName = Auth::guard('admin')->user()->name;
        $teamLeaderId = TeamLeader::where('name', $authName)->select('id')->first();
        $data = array();
        $data['active_menu'] = 'LeadList';
        $data['page_title'] = 'Lead List';
        $teamLeaders = TeamLeader::all();
        $employees = Employee::all();
        $cmo = AdminAuth::where('user_role', 8)->get();
        $gm = AdminAuth::where('user_role', 9)->get();
        $all = Lead::whereNotNull('leader_id')->pluck('leader_id');

        $matchingLeader = $all;
        $auth =  Auth::guard('admin')->id();
        $salesMan = Auth::guard('admin')->user()->id;
        $emplyoee = Employee::where('id', $salesMan)->select('id', 'name')->first();
        $gmman = AdminAuth::where('id', $salesMan)->where('user_role', 9)->first();
        $cmoman = AdminAuth::where('id', $salesMan)->where('user_role', 8)->first();

        if ($emplyoee) {

            $lead = Lead::where('sales_officer', $emplyoee->id)->get();
            return view('backend.lead.lead', compact('data', 'teamLeaders', 'employees', 'lead'));
        } elseif ($teamLeaderId) {
            $lead = Lead::where('leader_id', $teamLeaderId->id)->get();
            return view('backend.lead.lead', compact('data', 'teamLeaders', 'employees', 'lead', 'matchingLeader', 'cmo', 'gm'));
        } elseif ($cmoman) {
            $lead = Lead::where('cmo', $cmoman->id)->get();
            return view('backend.lead.lead', compact('data', 'teamLeaders', 'employees', 'lead', 'matchingLeader', 'cmo', 'gm'));
        } elseif ($gmman) {

            $lead = Lead::where('gm', $gmman->id)->get();
            return view('backend.lead.lead', compact('data', 'teamLeaders', 'employees', 'lead', 'matchingLeader', 'cmo', 'gm'));
        } else {
            $lead = Lead::all();
            return view('backend.lead.lead', compact('data', 'teamLeaders', 'employees', 'lead', 'matchingLeader', 'cmo', 'gm'));
        }
    }
    //fileUpdate
    public function fileUpdate($id)
    {

        if (request()->isMethod('post')) {
            if (request()->hasFile('file')) {
                $extension = request()->file('file')->extension();
                $fileName = 'backend/file/' . uniqid() . '.' . $extension;
                request()->file('file')->move('backend/file', $fileName);
            } else {
                $fileName = null;
            }
        }
        $investor = Investor::find($id);
        $investor->update([
            'file' => $fileName,
        ]);
        return back()->with('message', 'File Updated Successfully');
    }
    //fileDownload
    public function fileDownload($id)
    {
        $investor = Investor::find($id);
        if (!$investor) {
            return response()->json(['message' => 'Investor not found.'], 404);
        }
        $file = $investor->file;
        if ($file) {
            $filePath = public_path($file);

            if (!file_exists($filePath)) {
                return response()->json(['message' => 'File not found.'], 404);
            }
            return response()->download($filePath);
        } else {
            echo ("File doesn't exist!");
        }
    }
    public function addMultipuleInvestor()
    {
        $data = array();
        $data['active_menu'] = 'InvestorMultipule';
        $data['page_title'] = 'Investor Create';
        $team_lead = TeamLeader::all();
        $employee = Employee::all();
        $investors = Investor::all();

        // Extract unique serial numbers
        $investor = $investors->unique('serial_number');


        if (request()->isMethod('post')) {
            try {
                if (request()->hasFile('user_image')) {
                    $extension = request()->file('user_image')->extension();
                    $photo_name = 'backend/img/user/' . uniqid() . '.' . $extension;
                    request()->file('user_image')->move('backend/img/user', $photo_name);
                } else {
                    $photo_name = null;
                }
                if (request()->hasFile('nominee_image')) {
                    $extension = request()->file('nominee_image')->extension();
                    $image_name = 'backend/img/nominee/' . uniqid() . '.' . $extension;
                    request()->file('nominee_image')->move('backend/img/nominee', $image_name);
                } else {
                    $image_name = null;
                }
                $status = 'accept';

                $serialNumber = request('serial_number');
                $invesSerial = Investor::where('id', $serialNumber)->select('serial_number')->first();
                AdminAuth::create([
                    'name' => request('name'),
                    'email' => request('email'),
                    'image' => $photo_name,
                    'password' => bcrypt(request('password')),
                    'user_role' => '7',
                    'designation' => 'Investor',
                    'serial_number' => $serialNumber,
                ]);
                $authAdminId = AdminAuth::all()->last()->id;

                $investorListPdf = Investor::create([
                    'status' => $status,
                    'serial_number' => $invesSerial->serial_number,
                    'fileNumber' => request('fileNumber'),
                    'name' => request('name'),
                    'user_image' => $photo_name,
                    'fathers_name' => request('fathers_name'),
                    'mothers_name' => request('mothers_name'),
                    'spouse_name' => request('spouse_name'),
                    'birth_date' => request('birth_date'),
                    'spouse_date_birth' => request('spouse_date_birth'),
                    'marriage' => request('marriage'),
                    'present_address' => request('present_address'),
                    'permanent_address' => request('permanent_address'),
                    'phone' => request('phone'),
                    'alternativePhone' => request('alternativePhone'),
                    'main_amount' => round(request('main_amount')),
                    'email' => request('email'),
                    'quarterly' => request('quarterly'),
                    'half_yearly' => request('half_yearly'),
                    'at_a_time' => request('at_a_time'),
                    'yearly' => request('yearly'),
                    'facebook' => request('facebook'),
                    'Profession' => request('profession'),
                    'religion' => request('religion'),
                    'office_address' => request('office_address'),
                    'nid_passport' => request('nid_passport'),
                    'nationality' => request('nationality'),
                    'project_name' => request('project_name'),
                    'project_address' => request('project_address'),
                    'ownership_size' => request('ownership_size'),
                    'category_ownership' => request('category_ownership'),
                    'no_ownership' => round(request('no_ownership')),
                    'price_ownership' => round(request('price_ownership')),
                    'special_discount' => round(request('special_discount')),
                    'special_discount_word' => request('special_discount_word'),
                    'agreed_price' => round(request('agreed_price')),
                    'agreed_price_word' => request('agreed_price_word'),
                    'installment' => request('installment'),
                    'nominee_name' => request('nominee_name'),
                    'nominee_cell_no' => request('nominee_cell_no'),
                    'relation_to_nominee' => request('relation_to_nominee'),
                    'nominee_image' => $image_name,
                    'reference_name_a' => request('reference_name_a'),
                    'reference_cell_a' => request('reference_cell_a'),
                    'reference_name_b' => request('reference_name_b'),
                    'reference_cell_b' => request('reference_cell_b'),
                    'down_payment' => request('down_payment'),
                    'down_payment_date' => request('down_payment_date'),
                    'down_payment_inWord' => request('down_payment_inWord'),
                    'payment_type2' => request('payment_type2'),
                    'payment_type_date2' => request('payment_type_date2'),
                    'no_of_installment' => round(request('no_of_installment')),
                    'inst_per_month' => round(request('inst_per_month')),
                    'start_from' => request('start_from'),
                    'start_to' => request('start_to'),
                    'others_instruction' => request('others_instruction'),
                    'chq' => request('chq'),
                    'bank_name' => request('bank_name'),
                    'branch_name' => request('branch_name'),
                    'allow_amount' => request('allow_amount'),
                    'online_payment' => request('online_payment'),
                    'passport' => request('passport'),
                    'employee_id' => request('employee_id'),
                    'team_leader' => request('team_leader'),
                    'auth_id' => $authAdminId,
                ]);



                // $inv = Investor::all()->last()->id;
                // $investorData = Investor::where('id', $inv)->first();
                // $investorArray = ['investor' => $investorData];
                // $pdf = PDF::loadView('backend.pdf.investorPdf', $investorArray);


                // $data = ['name' => request('email'), 'email' => request('email')];

                // Mail::send('email.investorMail', $data, function ($message) use ($data, $pdf) {
                //     $message->from('qrcode950@gmail.com', 'Admin');
                //     $message->to($data['email'], $data['name'])
                //         ->subject('Investor Created')
                //         ->attachData($pdf->output(), "investor.pdf");
                // });

                // if (request('investorPdfGenerate') == '1') {

                //     $pdf = PDF::loadView('backend.pdf.investorListPdf', compact('investorListPdf'));
                //     return $pdf->stream('Investor_details.pdf');
                // }

                //booking_incentive
                $downPayment = floatval(request('down_payment'));
                $teamLeader = request('team_leader');
                $salesman = request('employee_id');
                // if ($teamLeader || $salesman) {
                //     $teamLeaders = TeamLeader::where('id', $teamLeader)->first();
                //     $percent = 3.50;
                //     $teamPercent = 0.85;
                //     $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                //     $percentOfDownPayment = round(($percent / 100) * $downPayment);
                //     $teamLeaders->bookingIncentive += (float) $teamLeaderDownPayment;
                //     $teamLeaders->save();
                //     // target Id
                //     $percent = 3.50;
                //     $teamPercent = 0.85;
                //     $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                //     $percentOfDownPayment = round(($percent / 100) * $downPayment);
                //     $teamLeaders->bookingIncentive += (float) $teamLeaderDownPayment;
                //     $teamLeaders->save();
                //     // target Id
                //     if ($salesman) {
                //         $taqrget = Target::where('employee_id', $salesman)->select('id')->first();
                //         if ($taqrget) {
                //             $taqrgetId = $taqrget->id;
                //         }
                //     } else {
                //         $taqrgetId = null;
                //     }
                //     $taqrget = Target::where('employee_id', $salesman)->select('id')->first();
                //     if ($taqrget) {
                //         $targetMoney = new TargetMoney();
                //         $targetMoney->employee_id = $salesman;
                //         $targetMoney->target_id = $taqrgetId;
                //         $targetMoney->teamLeader_id = $teamLeader;
                //         $targetMoney->target_installment = round($downPayment);
                //         $targetMoney->target_Date = date('Y-m-d');
                //         $targetMoney->save();
                //     }

                //     $salesMans = Employee::where('id', $salesman)->first();
                //     if ($percentOfDownPayment) {
                //         $salesMans->bookingIncentive += (float) $percentOfDownPayment;
                //         $salesMans->save();
                //     }
                // }
                if ($teamLeader || $salesman) {
                    if ($teamLeader) {
                        $teamLeaders = TeamLeader::where('id', $teamLeader)->first();
                        if ($teamLeaders) {
                            $teamPercent = 0.85;
                            $teamLeaderDownPayment = round(($teamPercent / 100) * $downPayment);
                            $teamLeaders->bookingIncentive += (float) $teamLeaderDownPayment;
                            $teamLeaders->save();
                        }
                    }
                
                    if ($salesman) {
                        $taqrget = Target::where('employee_id', $salesman)->select('id')->first();
                        $taqrgetId = $taqrget ? $taqrget->id : null;
                
                        if ($taqrget) {
                            $targetMoney = new TargetMoney();
                            $targetMoney->employee_id = $salesman;
                            $targetMoney->target_id = $taqrgetId;
                            $targetMoney->teamLeader_id = $teamLeader;
                            $targetMoney->target_installment = round($downPayment);
                            $targetMoney->target_Date = date('Y-m-d');
                            $targetMoney->save();
                        }
                
                        $salesMans = Employee::where('id', $salesman)->first();
                        if ($salesMans) {
                            $percent = 3.50;
                            $percentOfDownPayment = round(($percent / 100) * $downPayment);
                            if ($percentOfDownPayment) {
                                $salesMans->bookingIncentive += (float) $percentOfDownPayment;
                                $salesMans->save();
                            }
                        }
                    }
                }

                return redirect()->route('investor_create')->with('message', 'Investor Created Successfully!!!');
            } catch (PDOException $e) {
                return $e;
            }
        } else {
        }
        return view('backend.investor.multipuleInvestor', compact('data', 'employee', 'investor', 'team_lead'));
    }
    public function previewInvestor(Request $request)
    {

        return view('backend.investor.preview');
    }
    public function multiplepreviewInvestor(Request $request)
    {

        return view('backend.investor.multiplepreview');
    }
}
