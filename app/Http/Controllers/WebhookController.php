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
    $data = [
      'raw_updates' => json_encode($updates),
    ];
    $save = Update::firstOrCreate($data);
    return 'ok';
  }
}
