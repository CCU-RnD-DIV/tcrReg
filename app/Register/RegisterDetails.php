<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class RegisterDetails extends Model
{
    public $table = 'tcr_details';

    protected  $fillable = [
        'account_id',
        'name',
        'gender',
        'school',
        'phone'
    ];
}
