<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function investors()
    {
        return $this->belongsToMany(Investor::class,'employee_investor','investor_id', 'employee_id');
    }
    public function teamleader(){
        return $this->belongsTo(TeamLeader::class,'teamLeader_id');
    }
}
