<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $fillable = [
    'chat_id', 'type', 'title', 'username', 'first_name', 'last_name'
  ];
  public function registration()
  {
    return $this->hasOne('App\Registration', 'chat_id', 'chat_id');
  }
}
