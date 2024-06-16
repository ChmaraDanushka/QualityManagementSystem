<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_ch_list extends Model
{
    use HasFactory;
    protected $table = 'sheet_ch_list';
    protected $primaryKey = 'sheet_chc_id';
    protected $fillable = ['sheet_chc_mc','sheet_chc_mt_id','sheet_chc_mt','sheet_chc_color','sheet_chc_batch','sheet_chc_width','sheet_chc_thickness','sheet_chc_time','sheet_chc_date','sheet_chc_roll_batch','sheet_chc_roll_width','sheet_chc_dust','sheet_chc_l_thic','sheet_chc_ml_thic','sheet_chc_mr_thic','sheet_chc_r_thic','sheet_issues','created_by'];
    public $timestamps=false;

}
