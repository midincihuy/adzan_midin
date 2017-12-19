<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

use App\Registration;

class AlertCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "alert";

    /**
     * @var string Command Description
     */
    protected $description = "Change alert time";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $data = explode(' ', $arguments);
        $alert = !empty($data[0]) ? $data[0] : 0;
        $text = "";
        if(!empty($alert)){
          $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();

          $registration = Registration::where('chat_id',$chat_id)->first();
          $registration->alert = $alert;
          $registration->save();

          $text = "You Change alert to $alert minutes";
        }else{
          $text = "Please Provide time ";
        }
        $this->replyWithMessage(['text' => $text]);

    }
}
