<?php

namespace App\User;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    public $table = 'tcr_details';

    protected $fillable = [
        'name', 'school', 'gender', 'phone'
    ];
}
