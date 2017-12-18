<?php

namespace App\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use App\Schedule;
use App\Registration;

class JadwalCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "jadwal";

    /**
     * @var string Command Description
     */
    protected $description = "Jadwal Command to get you started";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
      $date = date("Y-m-d");
      $text = "";
      $chat_id = $this->getTelegram()->getWebhookUpdates()->getMessage()->getChat()->getId();
      $registration = Registration::where('chat_id', $chat_id)->first();
      if($registration){
        $city_id = $registration->city_id;
        $schedule = Schedule::where(
          ['city_id' => $city_id],
          ['tanggal' => $date]
        )->first();
        if($schedule){
          $text .= "$schedule->tanggal";
          $text .= "\nShubuh : $schedule->shubuh";
          $text .= "\nDzuhur : $schedule->dzuhur";
          $text .= "\nAshr   : $schedule->ashr";
          $text .= "\nMaghrib: $schedule->maghrib";
          $text .= "\nIsya : $schedule->isya";
        }else{
          $text .= "Not available Schedule Yet";
        }
      }else{
        $text .= "Not registered Yet";
      }
      $this->replyWithMessage(['text' => $text]);

    }
}
