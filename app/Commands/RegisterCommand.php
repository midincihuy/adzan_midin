<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;

class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "register";

    /**
     * @var string Command Description
     */
    protected $description = "Register Command";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $data = explode(' ', $arguments);
        $city_id = $data[0];
        $text = "";
        if(!empty($city_id)){
          $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();

          $registration = Registration::firstOrNew([
            'chat_id' => $chat_id
          ]);
          $registration->city_id = $city_id;
          $registration->save();

          $text = 'Hello! Thanks for registering';
        }else{
          $text = "Please provide the city_id\nExample : /register [city_id]";
        }
        $this->replyWithMessage(['text' => $text]);

    }
}
