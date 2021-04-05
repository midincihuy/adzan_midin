<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Update;
use App\Schedule;
use App\Registration;

class ClearUpdateController extends Controller
{
    public function index(Request $request){
        $params = $request->all();
        // print_r($params);
        $entities = [
            'Update', 
            'Schedule',
            'Registration'
        ];
        foreach($params as $key => $value){
            if(in_array($key, $entities)){
                switch($key){
                    case "Update" : 
                        $model = Update::orderBy('id')->limit($value)->delete();
                        break;
                    case "Schedule" :
                        $model = Schedule::orderBy('id')->limit($value)->delete();
                        break;
                    case "Registration" :
                        $model = Registration::where('chat_id','')->delete();
                        break;
                    default: 
                        break;
                }
                
            }else{
                echo "nothing";
            }
        }
    }
}