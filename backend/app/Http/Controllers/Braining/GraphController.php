<?php

namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Session;
use Exception;
use App\User;
use Input;
use Carbon;
use DB;
use App\Library\GlobalFunctions;

class GraphController extends Controller {

    public function store() {

        $statusCode = 200;

//        try {

            $response = [
                'account' => '',
                'historydata' => '',
            ];

            $email = explode(":", Input::get("account"));

            $user = User::where('email', $email[1])->get();
            $userFirst = $user->first();
            $id = Input::get("sesija");

            $d1 = array();
            $d2 = array();
            $d3 = array();
            $d4 = array();

            if ($user->isEmpty()) {
                $statusCode = 403;
            } else {
                $graf = Input::get("graf");
                if ($graf == 1) {
                $results = DB::select(DB::raw("SELECT  data->'$[*][*].signal.ang_l' as ang_l,data->'$[*][*].signal.frc_l' as frc_l  FROM `sessions` WHERE id=" . $id . ""));
                $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                $ang_l = json_decode($results2['ang_l'][0]);
                $frc_l = json_decode($results2['frc_l'][0]);
                $inkrement = 1;
                if (count($ang_l > 200)) {
                    $inkrement = 4;
                }
                for ($i = 0; $i < count($ang_l); $i = $i + $inkrement) {
                    $var1 = base64_decode($ang_l[$i]);
                    $var3 = base64_decode($frc_l[$i]);
                    for ($i2 = 0; $i2 < strlen($var1) - 1; $i2 = $i2 + 2) {
                        array_push($d1, GlobalFunctions::complement2(GlobalFunctions::UShort($var1, $i2)) . " ");
                    }
                    for ($i4 = 0; $i4 < strlen($var3) - 1; $i4 = $i4 + 4) {
                        array_push($d3, GlobalFunctions::Float($var3, $i4) . " ");
                    }
                }
                $rv = array();
                for ($i = 0; $i < count($d3); $i = $i + 1) {
                    array_push($rv, [$d1[$i], $d3[$i]]);
                }

                $response = [
                    'left' => [['data' => $rv]],
                ];
            } elseif ($graf == 4) {

                $results = DB::select(DB::raw("SELECT  data->'$[*][*].signal.ang_r' as ang_r,data->'$[*][*].signal.frc_r' as frc_r  FROM `sessions` WHERE id=" . $id . ""));
                $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);

                $ang_r = json_decode($results2['ang_r'][0]);
                $frc_r = json_decode($results2['frc_r'][0]);
                $inkrement = 1;
                if (count($ang_r > 200)) {
                    $inkrement = 4;
                }

                for ($i = 0; $i < count($frc_r); $i = $i + $inkrement) {
                    $var2 = base64_decode($ang_r[$i]);
                    $var4 = base64_decode($frc_r[$i]);
                    for ($i3 = 0; $i3 < strlen($var2) - 1; $i3 = $i3 + 2) {
                        array_push($d2, GlobalFunctions::complement2(GlobalFunctions::UShort($var2, $i3)) . " ");
                    }
                    for ($i5 = 0; $i5 < strlen($var4) - 1; $i5 = $i5 + 4) {
                        array_push($d4, GlobalFunctions::Float($var4, $i5) . " ");
                    }
                }
                $rv2 = array();
                for ($i = 0; $i < count($d4); $i = $i + 1) {

                    array_push($rv2, [$d2[$i], $d4[$i]]);
                }
                $response = [
                    'right' => [['data' => $rv2]],
                ];
            }
            elseif ($graf == 2) {
                    $start = Input::get("start");
                    $results = DB::select(DB::raw("SELECT data->'$[*][*].signal.ang_l'   as ang_l ,data->'$[*][*].signal.ang_r' as ang_r,data->'$[*][*].signal.frc_l' as frc_l,data->'$[*][*].signal.frc_r' as frc_r  FROM `sessions` WHERE id=" . $id . ""));
                    $broj=$start;
                    $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                    $ang_l = json_decode($results2['ang_l'][0]);
                    $frc_l = json_decode($results2['frc_l'][0]);
                    $ang_r = json_decode($results2['ang_r'][0]);
                    $frc_r = json_decode($results2['frc_r'][0]);
                   $start2=$start*0.33;
                   $end=$start2+40;
                   if(count($ang_r)>40){
                   if($start+40>count($ang_r)){
                       $start2=count($ang_r)-40;
                       $end=count($ang_r);
                     
                   }
                    if($broj >( count($ang_r)*150/100)-60){
                        $broj=( count($ang_r)*150/100)-60;
                    }
                    
                   }
                   else{
                       $broj=0;
                       $start2=0;
                       $end=count($ang_r);
                   }
                    
                      for ($i = $start2; $i < $end; $i = $i + 1) {
                        $var1 = base64_decode($ang_l[$i]);
                        $var2 = base64_decode($ang_r[$i]);
                        $var3 = base64_decode($frc_l[$i]);
                        $var4 = base64_decode($frc_r[$i]);
                         for ($i2 = 0; $i2 < strlen($var1) - 1; $i2 = $i2 + 2) {
                           array_push($d1, GlobalFunctions::complement2(GlobalFunctions::UShort($var1, $i2)) . " ");

                          }
                         for ($i3 = 0; $i3 < strlen($var2) - 1; $i3 = $i3 + 2) {
                             array_push($d2,GlobalFunctions::complement2(GlobalFunctions::UShort($var2, $i3)) . " ");
                            
                         }
                          for ($i4 = 0; $i4 < strlen($var3) - 1; $i4 = $i4+ 4) {
                             array_push($d3,GlobalFunctions::Float($var3, $i4) . " ");
                          }
                          
                        for ($i5 = 0; $i5 < strlen($var4) - 1; $i5 = $i5 + 4) {
                            array_push($d4,GlobalFunctions::Float($var4, $i5) . " ");
                        }
                    
                }
                
                    $rv = array();
                    $rv2 = array();
                    $rv3 = array();
                    $rv4 = array();
     
                    for ($i = 0; $i < count($d2); $i = $i + 1) {

                        array_push($rv, [$broj,  $d3[$i]]);
                        array_push($rv2, [$broj, $d4[$i]]);
                        array_push($rv3, [$broj, $d1[$i]]);
                        array_push($rv4, [$broj, $d2[$i]]);
                        $broj = $broj + 0.01;
                    }

                    $response = [
                        'frc_l' => $rv,
                        'frc_r' => $rv2,
                        'ang_l' => $rv3,
                        'ang_r' => $rv4,
                    ];
                } elseif ($graf == 3) {
                    $parametar = Input::get("parametar");
                    $string = "";
                foreach ($parametar as $p) {
                    $slug = $p['slug'];
                    $string = $string . "data->'$[*][*].$slug' as $slug,";
                }
                $results = DB::select(DB::raw("SELECT $string stroke_count  FROM `sessions` INNER JOIN `data_biorower_sessions` ON sessions.data_biorower_sessions_id=data_biorower_sessions.id WHERE sessions.id=" . $id . "."));              
                $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                foreach ($parametar as $p) {
                    $slug = $p['slug'];
                    $results2[$slug] = json_decode($results2[$slug][0]);
                }

                $results2['stroke_count'] = json_decode($results2['stroke_count'][0]);
                $rv = array();
                for ($i = 0; $i < $results2['stroke_count']; $i = $i + 1) {
                    array_push($rv, $i);
                }

                $results2['stroke_count'] = $rv;
                $response = [
                    'historydata' => $results2,
                ];
            }
        }
//        } catch (Exception $e) {
//            $statusCode = 400;
//        }

        return Response::json($response, $statusCode);
    }

}
