<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'body', 'category_id','publish_date');

    public function client()
    {
        return $this->belongsToMany('App\Client');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
