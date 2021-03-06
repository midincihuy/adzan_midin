<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
  protected $fillable = [
    'city_id', 'chat_id'
  ];
  public function city()
  {
    return $this->belongsTo('App\City', 'city_id', 'city_id');
  }

  public function chat()
  {
    return $this->belongsTo('App\Chat', 'chat_id', 'chat_id');
  }

}
