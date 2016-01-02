<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $table = 'tcr_settings';

    protected  $fillable = [
        'settings',
        'value'
    ];
}
