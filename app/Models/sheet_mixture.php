<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_mixture extends Model
{
    use HasFactory;
    protected $table = 'sheet_mixture';
    protected $primaryKey = 'mx_id';
    protected $fillable = ['mx_bulk_id','mx_material','mx_our_bn_no','mx_mt_brand','mx_qty','mx_mixed'];
    public $timestamps=false;
}
