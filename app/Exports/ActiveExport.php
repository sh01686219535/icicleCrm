<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActiveExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ActiveLead = Task::whereIn('status', ['Interested', 'Appointment Schedule', 'Sure Secure'])->get();
        return $ActiveLead;
    }
}
