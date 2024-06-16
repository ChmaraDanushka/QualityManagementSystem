<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sheet_material_add extends Model
{
    use HasFactory;
    protected $table = 'sheet_material_add';
    protected $primaryKey = 'material_id';
    protected $fillable = ['sheet_material_name','sheet_material_supplier','sheet_material_batch_no','sheet_material_brand','sheet_material_grade'];
    public $timestamps=false;
}
