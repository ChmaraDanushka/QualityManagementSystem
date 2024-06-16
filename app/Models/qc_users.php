<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qc_users extends Model
{
    use HasFactory;
    protected $table = 'qc_users';
    protected $primaryKey = 'qc_id';
    protected $fillable = ['qc_reg_no','qc_pro_pic','qc_first_name','qc_last_name','qc_nic','qc_address','qc_email','qc_tp','qc_password'];
    public $timestamps=false;
}
