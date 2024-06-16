<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_mc_add extends Model
{

    use HasFactory;
    protected $table = 'sheet_mc_add';
    protected $primaryKey = 'mc_id';
    protected $fillable = ['mc_no','mc_name','first_matirial','second_matirial','mc_status'];
    public $timestamps=false;
}
