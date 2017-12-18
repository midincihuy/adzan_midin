<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;

class GenerateController extends Controller
{
  public function index(Request $request)
  {
    $year = $request->input('year');
    $month = $request->input('month');
    $city_id = $request->input('city_id');
    if(!empty($year) && !empty($month) && !empty($city_id)){
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', "http://jadwalsholat.pkpu.or.id/monthly.php?type=2&id=$city_id&m=$month&y=$year");
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
      }
    }else{
      return "no param";
    }
  }
}
