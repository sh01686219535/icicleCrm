<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Investor extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         // Set the serial number starting from 2500
    //         $model->serial_number = self::generateSerialNumber();
    //     });
    // }

    // private static function generateSerialNumber()
    // {
        
    //     // return $nextSerialNumber;
    //     $currentDate = Carbon::now()->format('y/m');
    //     $prefix = '';

    //     // Determine the prefix and starting numeric part based on the selected project name
    //     switch (request('project_name')) {
    //         case 'THE SALTANAT HOTEL & RESORT':
    //             $prefix = 'SAL-';
    //             $startNumericPart = 1251;
    //             break;
    //         case 'SALTANAT TEA RESORT':
    //             $prefix = 'STR-';
    //             $startNumericPart = 3501; // Change this value as needed
    //             break;
    //         // Add more cases as needed for other project names
    //         default:
    //             $prefix = 'DEFAULT-'; // Specify a default prefix if needed
    //             $startNumericPart = 1; // Specify a default starting numeric part
    //             break;
    //     }

    //     $lastGeneratedSerial = self::where('serial_number', 'like', $prefix . $currentDate . '%')->latest('created_at')->value('serial_number');

    //     if (!$lastGeneratedSerial) {
    //         // If no previous serial number is found, start from the specified numeric part
    //         $nextSerialNumber = $prefix . $currentDate . '-' . sprintf('%04d', $startNumericPart);
    //     } else {
    //         // Extract the numeric part, increment, and format to ensure it's always four digits
    //         $numericPart = intval(substr($lastGeneratedSerial, strlen($prefix) + strlen($currentDate) + 1));
    //         $nextSerialNumber = $prefix . $currentDate . '-' . sprintf('%04d', $numericPart + 1);
    //     }

    //     return $nextSerialNumber;
    // }


    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_investor', 'investor_id', 'employee_id');
    }
    public function teamLeaders()
    {
        return $this->belongsToMany(TeamLeader::class, 'team_leader_investor', 'investor_id', 'team_leader_id');
    }
}
