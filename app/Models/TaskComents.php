<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComents extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function lead(){
        return $this->belongsTo(Lead::class,'lead_user');
    }
    public function emplyoee(){
        return $this->belongsTo(Employee::class,'emplyoee_id');
    }
}
