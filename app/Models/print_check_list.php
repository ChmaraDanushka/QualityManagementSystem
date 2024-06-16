<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class print_check_list extends Model
{
    use HasFactory;
    protected $table = 'print_check_list';
    protected $primaryKey = 'print_che_id';
    protected $fillable = ['print_che_mc','print_cus_id','print_che_name','print_che_batch','print_che_time','print_che_date','print_che_qty','print_che_cVa','print_che_missing','print_che_smudge','print_che_block','print_che_ink','print_issues','created_by'];
    public $timestamps=false;
}

