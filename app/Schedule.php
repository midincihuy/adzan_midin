<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $fillable = [
    'city_id', 'tanggal','shubuh', 'dzuhur',	'ashr',	'maghrib',	'isya'
  ];
}
