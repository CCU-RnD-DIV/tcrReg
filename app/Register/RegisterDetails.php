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

    public function users()
    {
        return $this->belongsTo('App\Register\RegisterUsers', 'account_id');
    }

    public function habits()
    {
        return $this->hasOne('App\Register\RegisterHabits', 'account_id', 'account_id');
    }

    public function schools()
    {
        return $this->hasOne('App\Data\School', 'school_code', 'school');
    }

    public function far_school()
    {
        return $this->hasOne('App\Data\FarSchool', 'sf_school_id', 'school');
    }

    public function reg1()
    {
        return $this->hasOne('App\Register\RegisterSubjects', 'account_id', 'account_id');
    }

    public function reg2()
    {
        return $this->hasOne('App\Register\RegisterSubjects2', 'account_id', 'account_id');
    }


}
