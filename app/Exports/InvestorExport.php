<?php

namespace App\Exports;

use App\Models\Investor;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvestorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mplLead = Lead::where('status', 'MPL')->get();
        return $mplLead;
    }
}
