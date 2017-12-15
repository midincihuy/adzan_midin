<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schedule = Schedule::paginate(10);
      return view('schedule.index')->withSchedule($schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // return "create nih";
      $month = 12;
      $year = 2017;
      $city_id = 67; // Depok
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
          // echo $date;
          $data[] = trim(strip_tags($x));
          // print_r(htmlentities(strip_tags($x)));
          // echo "<br>";
        }
        // 'tanggal','shubuh', 'dzuhur',	'ashr',	'maghrib',	'isya'
        // print_r($data);
        $schedule = Schedule::firstOrNew(
          ['tanggal' => $data[0]],
          ['city_id' => $city_id]
        );
        $schedule->shubuh  = $data[1];
        $schedule->shubuh  = $data[1];
        $schedule->dzuhur  = $data[2];
        $schedule->ashr  = $data[3];
        $schedule->maghrib  = $data[4];
        $schedule->isya  = $data[5];
        $schedule->save();
      }
      // print_r(htmlentities($replace));
      /*
      <tr class="table_light" align="center"><td><b>01</b></td><td>04:05</td><td>11:43</td><td>15:09</td><td>17:57</td><td>19:13</td></tr>
      <tr class="table_dark" align="center"><td><b>02</b></td><td>04:05</td><td>11:44</td><td>15:09</td><td>17:58</td><td>19:13</td></tr>
      */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
