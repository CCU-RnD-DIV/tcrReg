<?php

namespace App\Register;

use Illuminate\Database\Eloquent\Model;

class RegisterSubjects extends Model
{
    public $table = 'tcr_reg_subject';

    protected  $fillable = [
        'account_id',
        'reg_subject_1',
        'already_pick_1',
        'ps',
        'priority',
        'reg_time'
    ];

    public function sList()
    {
        return $this->belongsTo('SubjectList', 'subject_id');
    }

}