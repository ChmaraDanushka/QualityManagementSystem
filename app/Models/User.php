<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_reg_no','user_profile_picture','user_first_name','user_last_name','user_nic','user_address','user_email','user_tp','user_level','password'];
    public $timestamps=false;
}

