<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function blood_type_client()
    {
        return $this->hasMany('App\Client');
    }

    public function blood_type_donation()
    {
        return $this->hasMany('App\DonationRequest');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}