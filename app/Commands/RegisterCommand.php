<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;
use App\City;

class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "register";

    /**
     * @var string Command Description
     */
    protected $description = "Register kota untuk mendapat notifikasi waktu solat";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $data = explode(' ', $arguments);
        $city_id = $data[0];
        $text = "";
        $triggerCommandCity = false;
        if(!empty($city_id)){
          $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();

          $registration = Registration::firstOrNew([
            'chat_id' => $chat_id
          ]);
          $city = City::where('city_id', $city_id)->first();
          if(isset($city)){
            $registration->city_id = $city_id;
            $registration->save();
            $text = 'Hello! Thanks for registering for '.$city->name;
          }else{
            $text = "City id [$city_id] not found\nCheck city_id with /city command";
            $triggerCommandCity = true;
          }
        }else{
          $text = "Please provide the city_id\nExample : '/register 67' ";
        }
        $this->replyWithMessage(['text' => $text]);
        if($triggerCommandCity){
          $this->triggerCommand('city');
        }

    }
}
