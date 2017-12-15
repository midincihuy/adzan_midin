<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cities = City::paginate(10);
      return view('city.index')->withCities($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $month = 12;
      $year = 2017;
      $city_id = 67; // Depok
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', "http://jadwalsholat.pkpu.or.id/monthly.php?type=2&id=$city_id&m=$month&y=$year");
      $body = $res->getBody();
      $arr = explode('Pilih Kota', trim($body));
      $satu = explode('</select>', $arr[1]);
      $dua = explode('class="inputcity">', $satu[0]);
      preg_match_all("#option(.*)</option>#", $dua[1], $n);
      $list = $n[0];
      $array = array();
      echo "<pre>";
      foreach($list as $x){
        $x = (str_replace('option value="', '', str_replace('" selected>', ',', str_replace('">', ',', str_replace('</option>','',$x)))));
        $data = explode(',', $x);
        $city = City::firstOrNew(
          ['city_id' => $data[0]]
        );
        $city->name  = $data[1];
        $city->save();
      }

      return back();
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
