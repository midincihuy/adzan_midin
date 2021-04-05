<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Update;

class ClearUpdateController extends Controller
{
    public function index(Request $request){
        $params = $request->all();
        // print_r($params);
        $entities = [
            'Update', 
            'Schedule'
        ];
        foreach($params as $key => $value){
            if(in_array($key, $entities)){
                switch($key){
                    case "Update" : 
                        $model = App\Update::orderBy('id')->limit($value)->delete();
                        break;
                    case "Schedule" :
                        $model = App\Schedule::orderBy('id')->limit($value)->delete();
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