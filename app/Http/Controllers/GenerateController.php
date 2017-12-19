<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;
use App\Registration;

class GenerateController extends Controller
{
  public function index(Request $request)
  {
    $year = $request->input('year');
    $month = $request->input('month');
    // $city_id = $request->input('city_id');
    $reg = Registration::select('city_id')->orderBy('city_id')->groupBy('city_id')->get();
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

          foreach($baris as $x){
            $data[] = trim(strip_tags($x));
          }
          print_r($data);
          $schedule = Schedule::firstOrNew(
            [
              'tanggal' => $data[0],
              'city_id' => $city_id
            ]
          );
          $schedule->shubuh  = $data[1];
          $schedule->shubuh  = $data[1];
          $schedule->dzuhur  = $data[2];
          $schedule->ashr    = $data[3];
          $schedule->maghrib = $data[4];
          $schedule->isya    = $data[5];
          $schedule->save();

          $date = date("Y-m",strtotime("-3 months"));
          $delete = Schedule::where('tanggal','<', $date)->delete();
        }
      }else{
        return "no param";
      }
    }
  }

  public function show()
  {
    $tanggal = date("Y-m-d");
    $regisration = Registration::all();
    $text = "";
    foreach($regisration as $reg){
      $time = date("H:i", strtotime('+'.$reg->alert.' minutes'));
      $city_id = $reg->city_id;
      $data = Schedule::where('city_id', $city_id)
      ->where('tanggal', $tanggal)
      ->first();

      switch ($time) {
        case $data->shubuh:
            $text .= "shubuh : ".$data->shubuh;
            break;
        case $data->dzuhur:
            $text .= "dzuhur : ".$data->dzuhur;
            break;
        case $data->ashr:
            $text .= "ashar : ".$data->ashr;
            break;
        case $data->maghrib:
            $text .= "maghrib : ".$data->maghrib;
            break;
        case $data->isya:
            $text .= "isya : ".$data->isya;
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
      if($text != ""){
        // Log::info($text);
        $response = \Telegram::sendMessage([
                'chat_id' => $reg->chat_id,
                'text' => $text,
            ]);
      }
      // echo "<pre>";
      // echo $text;

      $text = "";
    }


  }
}
