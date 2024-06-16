<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class printing_mc extends Model
{
    use HasFactory;
    protected $table = 'printing_mc';
    protected $primaryKey = 'printing_mc_id';
    protected $fillable = ['printing_mc_no','printing_mc_name','printing_mcfirst_mt','printing_mcsecond_mt'];
    public $timestamps=false;
}
