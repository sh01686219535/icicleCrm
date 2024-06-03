<?php

namespace App\Http\Controllers;

use App\Exports\ActiveExport;
use App\Exports\ExportInvestor;
use App\Exports\InvestorExport;
use App\Exports\JunkExport;
use App\Exports\LeadToInvestor;
use App\Exports\SglExport;
use App\Exports\SuspectListExport;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\TeamLeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    //suspectListExcel
    public function suspectListExcel()
    {
        Return Excel::download(new SuspectListExport , 'mpl.xlsx');
    }
    //excelMPL
    public function excel()
    {
        Return Excel::download(new InvestorExport , 'mpl.xlsx');
    }
    //activeExcel
    public function activeExcel(){
        Return Excel::download(new ActiveExport,'active.xlsx');
    }
    //sglExcel
    public function sglExcel(){
        Return Excel::download(new SglExport,'sgl.xlsx');
    }
    //junkExcel
    public function junkExcel(){
        Return Excel::download(new JunkExport,'junk.xlsx');
    }
    //leadInvestorExcel
    public function leadInvestorExcel(){
        return Excel::download(new LeadToInvestor, 'leadToInvestor.xlsx');
    }
    //investorExport
    public function investorExport(){
        return Excel::download(new ExportInvestor, 'InvestorReport.xlsx');
    }
}
