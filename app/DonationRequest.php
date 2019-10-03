<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = false;
    protected $fillable = array('patient_name', 'hospital_name', 'phone', 'patient_age', 'bags_num',
     'hospital_address', 'notes', 'latitude', 'longitude',
      'city_id','blood_type');

    public function donation_blood_type()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
