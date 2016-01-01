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
        'priority'
    ];

    public function sList()
    {
        return $this->belongsTo('SubjectList', 'subject_id');
    }

}