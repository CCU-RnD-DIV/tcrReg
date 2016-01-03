<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public $table = 'tcr_school_list';

    public function details()
    {
        return $this->belongsToMany('App\Register\RegisterUsers', 'school_code');
    }
}
