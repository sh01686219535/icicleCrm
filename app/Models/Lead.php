<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function employee()
    {
        return $this->belongsTo(Employee::class,'sales_officer');
    }
    public function teamLeader()
    {
        return $this->belongsTo(TeamLeader::class,'team_leader');
    }
    public function auth()
    {
        return $this->belongsTo(AdminAuth::class,'gm','cmo');
    }
}
