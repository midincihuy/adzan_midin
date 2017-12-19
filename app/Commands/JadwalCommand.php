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
    protected $description = "Untuk melihat jadwal solat hari ini";

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
        $schedule = Schedule::where('city_id',$city_id)->where('tanggal', $date)
        ->first();
        if($schedule){
          $text .= "$schedule->tanggal";
          $text .= "\nImsyak\t: $schedule->imsyak";
          $text .= "\nShubuh\t: $schedule->shubuh";
          $text .= "\nTerbit\t: $schedule->terbit";
          $text .= "\nDhuha\t: $schedule->dhuha";
          $text .= "\nDzuhur\t: $schedule->dzuhur";
          $text .= "\nAshr\t: $schedule->ashr";
          $text .= "\nMaghrib\t: $schedule->maghrib";
          $text .= "\nIsya\t: $schedule->isya";
        }else{
          $text .= "Not available Schedule Yet";
        }
      }else{
        $text .= "Not registered Yet";
      }
      $this->replyWithMessage(['text' => $text]);

    }
}
