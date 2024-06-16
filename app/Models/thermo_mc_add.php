<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thermo_mc_add extends Model
{
    use HasFactory;
    protected $table = 'thermo_mc_add';
    protected $primaryKey = 'thermo_mc_id';
    protected $fillable = ['thermo_mc_no','thermo_mc_name','thermo_main_matirial','thermo_second_matirial'];
    public $timestamps=false;
}
