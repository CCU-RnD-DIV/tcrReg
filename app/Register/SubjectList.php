<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class SubjectList extends Model
{
    public $table = 'tcr_subject';

    public function reg1()
    {
        return $this->belongsTo('App\Data\RegisterSubjects', 'subject_id', 'reg_subject_1');
    }


    public function reg2()
    {
        return $this->belongsTo('App\Data\RegisterSubjects2', 'subject_id', 'reg_subject_2');
    }


}
