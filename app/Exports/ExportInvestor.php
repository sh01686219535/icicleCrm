<?php

namespace App\Exports;

use App\Models\Investor;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportInvestor implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $start_date = request('from_date');
        $end_date = request('to_date');

        if ($start_date && $end_date) {
            $investors = Investor::whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date)
                ->get();
        } else {
            $investors = Investor::all();
        }

        return $investors;
    }
}
