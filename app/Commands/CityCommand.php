<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;
use App\City;

class CityCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "city";

    /**
     * @var string Command Description
     */
    protected $description = "Mendapatkan list kode kota";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
      $text = "";
      $data = explode(' ', $arguments);
      $city_text = strtoupper($data[0]);
      if(!empty($city_text)){
        $city = City::where('name', 'like','%'.$city_text.'%')->get();
        if(!empty($city)){
          $text .= "List City";
          foreach ($city as $key => $value) {
            $text .= "\n$value->name [$value->city_id]";
          }
        }else{
          $text .= "City not found";
        }
      }else{
        $text .= "Please provide the city_text\nExample : /city [city_text]";
      }
      $this->replyWithMessage(['text' => $text]);

    }
}
