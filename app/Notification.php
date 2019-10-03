<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'contet');

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

    public function donation_requests()
    {
        return $this->belongsTo('App\DonationRequest');
    }

}
