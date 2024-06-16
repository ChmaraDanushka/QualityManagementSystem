<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_log extends Model
{
    use HasFactory;
    protected $table = 'user_log';
    protected $primaryKey = 'user_log_id ';
    protected $fillable = ['user_name','user_log_email','login_date'];
    public $timestamps=false;
}
