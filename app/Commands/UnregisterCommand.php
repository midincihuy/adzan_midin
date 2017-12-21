<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;
use App\City;

class UnregisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "unregister";

    /**
     * @var string Command Description
     */
    protected $description = "Unregister notifikasi";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
      $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();

      $text = "";
      $registration = Registration::where([
        'chat_id' => $chat_id
      ])->first();
      if($registration){
        $registration->status='0';
        $registration->save();
        $text = "You have been unregistered";
      }else{
        $text = "Not Registered Yet";
      }
      $this->replyWithMessage(['text' => $text]);
    }
}
