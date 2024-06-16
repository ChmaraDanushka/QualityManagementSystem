<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thermo_check_list extends Model
{
    use HasFactory;
    protected $table = 'thermo_check_list';
    protected $primaryKey = 'thermo_check_id';
    protected $fillable = ['thermo_check_mc','thermo_check_mt_id','thermo_check_mt','thermo_check_color','thermo_check_item','thermo_batch_no','thermo_check_time','thermo_check_date','thermo_check_height','thermo_check_top',
    'thermo_check_outer','thermo_check_bottom','thermo_check_brim','thermo_check_body','thermo_check_base','thermo_check_width','thermo_check_volume','thermo_issues','created_by'];
    public $timestamps=false;
}
