<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_product_add extends Model
{
    use HasFactory;
    protected $table = 'sheet_product_add';
    protected $primaryKey = 's_product_id';
    protected $fillable = ['s_type','s_color','s_batchNo','s_width','s_thickness'];
    public $timestamps=false;
}
