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
    // foreach($updates as $update){
      $data = [
        'raw_updates' => "getType updates = ".gettype($updates)." dan json : ".json_encode($updates). " data updates->update_id $updates->update_id", // Testing

        /*
        Data $updates
{"update_id":847159001,"message":{"message_id":759,"from":{"id":151065522,"is_bot":false,"first_name":"Hamidin","last_name":"Hidayat","username":"midincihuy","language_code":"en-US"},"chat":{"id":151065522,"first_name":"Hamidin","last_name":"Hidayat","username":"midincihuy","type":"private"},"date":1513743093,"text":"\/jadwal","entities":[{"offset":0,"length":7,"type":"bot_command"}]}}
        */
        // 'id' => $updates['update_id'],
        // 'message_id' => $update['message']['message_id'],
        // 'from_id' => $update['message']['from']['id'],
        // 'chat_id' => $update['message']['chat']['id'],
        // 'date' => $update['message']['date'],
        // 'text' => isset($update['message']['text']) ? $update['message']['text'] : "",
        // 'type' => isset($update['message']['entities']) ? $update['message']['entities'][0]['type'] : "",
        // 'new_chat_member' => isset($update['message']['new_chat_member']) ? $update['message']['new_chat_member']['id'] : "",
        // 'left_chat_member' => isset($update['message']['left_chat_member']) ? $update['message']['left_chat_member']['id'] : "",
      ];

      $save = Update::firstOrCreate($data);
    // }
    return 'ok';
  }
}
