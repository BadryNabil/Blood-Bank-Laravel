<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name','governorate_id');

    public function cities_donation_requests()
    {
        return $this->hasMany('App\DonationRequest');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }
    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }

}
