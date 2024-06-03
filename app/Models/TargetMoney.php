<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetMoney extends Model
{
    use HasFactory;
    public function target(){
        return $this->belongsTo(Target::class,'target_id');
    }
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function teamLeader(){
        return $this->belongsTo(TeamLeader::class,'teamLeader_id');
    }
}
