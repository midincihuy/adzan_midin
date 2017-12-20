<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Update;
class WebhookController extends Controller
{

  public function index()
  {
    /** @var \Telegram\Bot\Objects\Update $update */
    $updates = \Telegram::commandsHandler(true);
    foreach($updates as $update){
      $data = [
        'raw_updates' => json_encode($updates), // Testing
        'id' => $update['update_id'],
        'message_id' => $update['message']['message_id'],
        'from_id' => $update['message']['from']['id'],
        'chat_id' => $update['message']['chat']['id'],
        'date' => $update['message']['date'],
        'text' => isset($update['message']['text']) ? $update['message']['text'] : "",
        'type' => isset($update['message']['entities']) ? $update['message']['entities'][0]['type'] : "",
        'new_chat_member' => isset($update['message']['new_chat_member']) ? $update['message']['new_chat_member']['id'] : "",
        'left_chat_member' => isset($update['message']['left_chat_member']) ? $update['message']['left_chat_member']['id'] : "",
      ];

      $save = Update::firstOrCreate($data);
    }
    return 'ok';
  }
}
