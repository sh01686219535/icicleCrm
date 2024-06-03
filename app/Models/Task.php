<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function lead(){
       return $this->belongsTo(Lead::class,'lead_user');
    }
    public function employee(){
       return $this->belongsTo(Employee::class,'employee_name');
    }
}
