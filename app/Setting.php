<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone','email','about_app',
    'fb_link','tw_link','play_store_link','app_store_link',
     'watssap_link','google_link','youtube_link','insta_link');

}
