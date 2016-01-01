<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class RegisterHabits extends Model
{
    public $table = 'tcr_habits';

    protected $fillable = [
        'account_id',
        'meat_veg',
        'traffic'
    ];
}
