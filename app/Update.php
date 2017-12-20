<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
  protected $fillable = [
    'id', 'message_id', 'chat_id', 'from_id', 'date', 'text', 'type', 'new_chat_member', 'left_chat_member', 'raw_updates',
  ];
  public function getDates()
  {
    return [
      'date',
      'created_at',
      'updated_at',
    ];
  }
}
