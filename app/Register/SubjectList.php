<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class SubjectList extends Model
{
    public $table = 'tcr_subject';

    public function rSubjects()
    {
        return $this->hasOne('RegisterSubjects', 'reg_subject_1');  /* (table,foreign_key) */
    }

    public function rSubjects2()
    {
        return $this->hasOne('RegisterSubjects2', 'reg_subject_2');
    }

}
