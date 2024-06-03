<?php

namespace App\Exports;

use App\Models\Investor;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeadToInvestor implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $clientList = Investor::where('status', 'accept')->get();
        return $clientList;
    }
}
