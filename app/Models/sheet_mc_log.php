<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_mc_log extends Model
{
    use HasFactory;
    protected $table = 'sheet_mc_log';
    protected $primaryKey = 'id';
    protected $fillable = ['mc_id','mc_name','log_date','start_time','end_time','created_by','created_at'];
    public $timestamps=false;
}
