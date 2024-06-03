<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;

class JunkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $junkLead = Task::whereIn('status', ['Not Interested'])->get();
        return $junkLead;

    }
}
