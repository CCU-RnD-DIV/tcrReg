<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class RegisterSubjects2 extends Model
{
    public $table = 'tcr_reg_subject_2';

    protected $fillable = [
        'account_id',
        'reg_subject_2',
        'already_pick_2',
        'ps',
        'priority',
        'reg_time'
    ];


    public function sList()
    {
        return $this->hasOne('App\Register\SubjectList', 'subject_id', 'reg_subject_2');
    }

    public function details()
    {
        return $this->belongsTo('App\Register\RegisterDetails', 'account_id');
    }

}