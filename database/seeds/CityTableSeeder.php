<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $month = 12; // dummy
      $year = 2017; // dummy
      $city_id = 67; // Depok
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', env("JADWAL_URL","https://www.jadwalsholat.org/adzan/")."monthly.php?type=2&id=$city_id&m=$month&y=$year");
      $body = $res->getBody();
      $arr = explode('Pilih Kota', trim($body));
      $satu = explode('</select>', $arr[1]);
      $dua = explode('class="inputcity">', $satu[0]);
      preg_match_all("#option(.*)</option>#", $dua[1], $n);
      $list = $n[0];
      $array = array();
      foreach($list as $x){
        $x = (str_replace('option value="', '', str_replace('" selected>', ',', str_replace('">', ',', str_replace('</option>','',$x)))));
        $data = explode(',', $x);

        DB::table('cities')->insert([
          'city_id' => $data[0],
          'name' => strtoupper($data[1])
        ]);
      }
    }
}
