<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $fillable = [
    'city_id', 'tanggal','shubuh', 'dzuhur',	'ashr',	'maghrib',	'isya'
  ];

  public function city()
  {
    return $this->belongsTo('App\City', 'city_id', 'city_id');
  }
}
