<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Registration;
use App\Schedule;
class Alert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jadwal:alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Alert Adzan';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      // $this->comment('alert nih');
      $tanggal = date("Y-m-d");
      $regisration = Registration::where('status','1')->get();
      $text = "";
      foreach($regisration as $reg){
        $time = date("H:i");
        $to_time = strtotime(date("Y-m-d $time:00"));
        $city_id = $reg->city_id;
        $data = Schedule::where('city_id', $city_id)
        ->where('tanggal', $tanggal)
        ->first();

        switch (true) {
          case $time <= $data->shubuh:
              $text .= "Shubuh : ".$data->shubuh;
              $from = $data->shubuh;
              break;
          case $time <= $data->dzuhur:
              $text .= "Dzuhur : ".$data->dzuhur;
              $from = $data->dzuhur;
              break;
          case $time <= $data->ashr:
              $text .= "Ashar : ".$data->ashr;
              $from = $data->ashr;
              break;
          case $time <= $data->maghrib:
              $text .= "Maghrib : ".$data->maghrib;
              $from = $data->maghrib;
              break;
          case $time <= $data->isya:
              $text .= "Isya : ".$data->isya;
              $from = $data->isya;
              break;
          default:
              // $text .= "Now : $tanggal . $time";
              // $text .= "\nChat ID : $reg->chat_id";
              // $text .= "\nData Schedule :";
              // $text .= "\nShubuh $data->shubuh";
              // $text .= "\nDzuhur $data->dzuhur";
              // $text .= "\nAshr $data->ashr";
              // $text .= "\nMaghrib $data->maghrib";
              // $text .= "\nIsya $data->isya";
              break;
        }
        $text .= "shubuh : ".$data->shubuh;
        $text .= "\ndzuhur : ".$data->dzuhur;
        $text .= "\nashar : ".$data->ashr;
        $text .= "\nmaghrib : ".$data->maghrib;
        $text .= "\nisya : ".$data->isya;
        $from_time = strtotime(date("Y-m-d $from:00"));
        $selisih = round(abs($to_time - $from_time) / 60,2);

        if($selisih <= 10){
          if($text != ""){
            // Log::info($text);
            $response = \Telegram::sendMessage([
              // 'chat_id' => $reg->chat_id,
                    'chat_id' => '151065522',
                    'text' => $text,
                ]);
          }
          // echo "<pre>";
          // echo $text;

          $text = "";
        }
      }
    }
}
