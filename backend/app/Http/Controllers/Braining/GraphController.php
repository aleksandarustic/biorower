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

                    $results = DB::select(DB::raw("SELECT  data->'$[*][*].signal.ang_l' as ang_l,data->'$[*][*].signal.ang_r' as ang_r,data->'$[*][*].signal.frc_l' as frc_l,data->'$[*][*].signal.frc_r' as frc_r  FROM `sessions` WHERE id=" . $id . ""));
                    $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                    $ang_l = json_decode($results2['ang_l'][0]);
                    $frc_l = json_decode($results2['frc_l'][0]);
                    $ang_r = json_decode($results2['ang_r'][0]);
                    $frc_r = json_decode($results2['frc_r'][0]);
                     for ($i = 0; $i < count($ang_l); $i = $i + 1) {
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
                    for ($i = 0; $i < count($d1); $i = $i + 1) {

                        array_push($rv, [$d1[$i],$d3[$i]]);
                        array_push($rv2, [$d2[$i],$d4[$i]]);
                    }


                    $response = [
                        'left' => [['data' => $rv]],
                        'right' => [['data' => $rv2]],
                    ];
                } elseif ($graf == 2) {
                     $start = Input::get("start");
                    $results = DB::select(DB::raw("SELECT data->'$[*][*].signal.ang_l' as ang_l,data->'$[*][*].signal.ang_r' as ang_r,data->'$[*][*].signal.frc_l' as frc_l,data->'$[*][*].signal.frc_r' as frc_r  FROM `sessions` WHERE id=" . $id . ""));
                    $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                    $ang_l = json_decode($results2['ang_l'][0]);
                    $frc_l = json_decode($results2['frc_l'][0]);
                    $ang_r = json_decode($results2['ang_r'][0]);
                    $frc_r = json_decode($results2['frc_r'][0]);
                    $kolicina=count($ang_l);
                    if($kolicina>60){
                        $kolicina=60;
                    }
                      for ($i = $start; $i < $start+$kolicina; $i = $i + 1) {
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
                    $broj = $start;
                    for ($i = 0; $i < count($d1); $i = $i + 1) {

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

                    $results = DB::select(DB::raw("SELECT data->'$[*][*].$parametar' as $parametar  FROM `sessions` WHERE id=" . $id . "."));
                    $results2 = GlobalFunctions::PrepareArrayParametersStatistics($results);
                    $p = json_decode($results2['dist'][0]);
                    $rv = array();
                    for ($i = 0; $i < count($p); $i = $i + 1) {

                        array_push($rv, [$broj, $frc_l[$i]]);
                        array_push($rv2, [$broj, $frc_r[$i]]);
                        array_push($rv3, [$broj, $ang_l[$i]]);
                        array_push($rv4, [$broj, $ang_r[$i]]);
                        $broj = $broj + 0.01;
                    }

                    $response = [
                        'frc_l' => $p,
                    ];
                }
            }
//        } catch (Exception $e) {
//            $statusCode = 400;
//        }

        return Response::json($response, $statusCode);
    }

}
