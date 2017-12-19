<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;
use App\City;
use App\Registration;

use DataTables;

class AjaxController extends Controller
{
  public function schedule()
  {
    $schedule = Schedule::with('city')->select('schedules.*');
    return DataTables::of($schedule)->make(true);
  }

  public function city()
  {
    $city = City::query();
    return DataTables::of($city)->make(true);
  }

  public function registration()
  {
    $registration = Registration::with('city')->select('registrations.*');
    return DataTables::of($registration)->make(true);
  }
}
