<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thermo_items extends Model
{
    use HasFactory;
    protected $table = 'thermo_items';
    protected $primaryKey = 'thermo_items_id';
    protected $fillable = ['thermo_items_name','thermo_items_color','thermo_items_mt','thermo_item_top','thermo_item_outside','thermo_item_bottom','thermo_item_brim','thermo_item_body','thermo_item_base','thermo_item_height','thermo_item_weight','thermo_item_capacity'];
    public $timestamps=false;
}
