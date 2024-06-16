<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_product extends Model
{
    use HasFactory;
    
    protected $table = 'sheet_product';
    protected $primaryKey = 'sheet_product_id';
    protected $fillable = ['product_sheet_type', 'sheet_color', 'sheet_product_batch_no', 'sheet_product_standard_width', 'sheet_product_standard_thickness'];
}
