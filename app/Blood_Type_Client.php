<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood_Type_Client extends Model 
{

    protected $table = 'blood_type_client';
    public $timestamps = true;
    protected $fillable = array('client_id', 'blood_type_id');

}