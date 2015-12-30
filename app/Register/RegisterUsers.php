<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class RegisterUsers extends Model
{
    public $table = 'tcr_users';

    protected  $fillable = [
        'email',
        'password',
        'pid',
        'type',
        'reg_verify',
        'reg_time'
    ];
}
