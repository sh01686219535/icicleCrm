<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\HasPermissionsTrait;
use Carbon\Carbon;


class AdminAuth extends Authenticatable
{
    use HasFactory, HasPermissionsTrait;

    protected $guarded = [];
    public function Permission(){
        return $this->hasMany(Permission::class);
    }
    public function role(){
        return $this->belongsTo(Role::class,'user_role');
    }
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
    //     $currentDate = Carbon::now()->format('y-m');
    //     $prefix = '';

    //     // Determine the prefix and starting numeric part based on the selected project name
    //     switch (request('project_name')) {
    //         case 'THE SALTANAT HOTEL & RESORT':
    //             $prefix = 'STR-';
    //             $startNumericPart = 1301;
    //             break;
    //         case 'SALTANAT TEA RESORT':
    //             $prefix = 'SAL-';
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

}
