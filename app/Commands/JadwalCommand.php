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
          $year = date('Y');
          $month = date('m');
          $reg = Registration::select('city_id')->orderBy('city_id')->groupBy('city_id')->get();
          if(count($reg) == 0){
            $reg[] = (Object) array(
              'city_id' => '67' // set default value to Depok
            );
          }
          foreach($reg as $data){
            $city_id = $data->city_id;
            if(!empty($year) && !empty($month) && !empty($city_id)){
              $client = new \GuzzleHttp\Client();
              $res = $client->request('GET', env("JADWAL_URL","https://www.jadwalsholat.org/adzan/")."monthly.php?type=2&id=$city_id&m=$month&y=$year");
              $body = $res->getBody();
              $arr = explode('<b>Isya</b></td></tr>', trim($body));
              $satu = explode('<tr class="table_block_content">', $arr[1]);
              $replace = str_replace(' class="table_dark" align="center"','',str_replace(' class="table_light" align="center"','',str_replace('high','',$satu[0])));

              $rows = explode('<tr><td><b>', $replace);
              echo "<pre>";
              array_shift($rows);
              foreach($rows as $row){
                $baris = explode('</td><td>',$row);
                $baris[0] = $year."-".$month."-".$baris[0];
                $data = array();

                foreach($baris as $k => $x){
                  if($k != 0){
                    $data[] = substr(trim(strip_tags($x)),0,5);
                  }else{
                    $data[] = trim(strip_tags($x));
                  }
                }
                $schedule = Schedule::firstOrNew(
                  [
                    'tanggal' => $data[0],
                    'city_id' => $city_id
                  ]
                );
                $schedule->imsyak  = $data[1];
                $schedule->shubuh  = $data[2];
                $schedule->terbit  = $data[3];
                $schedule->dhuha   = $data[4];
                $schedule->dzuhur  = $data[5];
                $schedule->ashr    = $data[6];
                $schedule->maghrib = $data[7];
                $schedule->isya    = $data[8];
                $schedule->save();

                $date = date("Y-m",strtotime("-2 months"));
                $delete = Schedule::where('tanggal','<', $date)->delete();
              }
            }else{
              return "no param";
            }
          }
          $text .= "Generating Schedule...";
          $this->triggerCommand('jadwal');
        }
      }else{
        $text .= "Not registered Yet";
      }
      $this->replyWithMessage(['text' => $text]);

    }
}
