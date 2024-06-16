<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class print_cus extends Model
{
    use HasFactory;
    protected $table = 'print_cus';
    protected $primaryKey = 'print_cus_id';
    protected $fillable = ['print_cus_idno','print_cus_name','print_ref_id','print_ref_tp'];
    public $timestamps=false;
}
