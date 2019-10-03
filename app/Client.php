<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'password', 'data_of_birthday', 'last_donation_date', 'city_id',
     'blood_type','phone','email','is_active','pin_code');

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function client_blood()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function requests()
    {
        return $this->hasMany('App\DonationRequest');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function tokens()
    {
        return $this->hasMany('App\Token');
    }
    protected $hidden = [
        'password', 'api_token',
    ];

}
