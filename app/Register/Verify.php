<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    public $table = 'tcr_users';

    protected $fillable = [
        'email',
        'password',
        'pid',
        'type',
        'reg_verify',
        'verify_code',
        'reg_time'
    ];
}
