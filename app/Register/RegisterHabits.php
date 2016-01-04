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

    public function users()
    {
        return $this->belongsTo('App\Register\RegisterUsers', 'account_id');
    }
    public function details()
    {
        return $this->belongsTo('App\Register\RegisterDetails', 'account_id');
    }
}
