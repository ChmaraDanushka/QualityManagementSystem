<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = ['id','msg_from','from_name','msg_from_utype','msg_to_utype','to_name','msg_to','message','is_read','create_time'];
    public $timestamps=false;
}
