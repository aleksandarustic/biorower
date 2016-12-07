<?php

namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cache;
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
       ob_start( "ob_gzhandler" );   

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
                if ($graf == 1 | $graf == 2) {
                $sql = "SELECT  data->'$[0][*].signal.ang_l' as ang_l ,data->'$[0][*].signal.ang_r' as ang_r,data->'$[0][*].signal.frc_l' as frc_l,data->'$[0][*].signal.frc_r' as frc_r  FROM `sessions` WHERE id=" . $id . "";
                $results = Cache::remember(md5($sql), 60, function() use ($sql) {
                            return DB::select($sql);
                        });


                $ang_l = json_decode($results[0]->ang_l);
                $frc_l = json_decode($results[0]->frc_l);
                $ang_r = json_decode($results[0]->ang_r);
                $frc_r = json_decode($results[0]->frc_r);
            }
            if ($graf == 1) {


                $inkrement = (count($ang_l))/100;
                $ang_lleng=count($ang_l);
                for ($i = 0; $i < $ang_lleng; $i = $i + $inkrement) {
                    $var1 = base64_decode($ang_l[$i]);
                    $var3 = base64_decode($frc_l[$i]);
                    $var2 = base64_decode($ang_r[$i]);
                    $var4 = base64_decode($frc_r[$i]);
                    $duzina1= strlen($var1) - 1;
                    $duzina2= strlen($var2) - 1;
                    $duzina3= strlen($var3) - 1;
                    $duzina4= strlen($var4) - 1;
                    if($duzina1>$duzina2){
                        $duzina1=$duzina2;
                    }
                     if($duzina3>$duzina4){
                        $duzina3=$duzina4;
                    }
                    for ($i3 = 0; $i3 < $duzina1; $i3 = $i3 + 2) {
                        $d1[]=GlobalFunctions::complement2(GlobalFunctions::UShort($var1, $i3));
                        $d2[]=GlobalFunctions::complement2(GlobalFunctions::UShort($var2, $i3));
                    }
                    for ($i5 = 0; $i5 < $duzina3; $i5 = $i5 + 4) {
                        $d3[]=GlobalFunctions::Float($var3, $i5);
                        $d4[]=GlobalFunctions::Float($var4, $i5);
                        
                    }
                }
                $rv = array();
                $rv1 = array();
                $d3leng=count($d3);
                for ($i = 0; $i <  $d3leng; $i = $i + 1) {
                    $rv[]=[$d1[$i], $d3[$i]];
                    $rv1[]=[$d2[$i],$d4[$i]]; 
                }
                    $max1=max($d4);
                    $max2=max($d2);
                    if($max1>$max2){
                        $max=$max1;
                    }
                    else{
                        $max=$max2;
                    }
                $response = [
                    'left' => [['data' => $rv]],'right' => [['data' => $rv1]],'max'=>$max
                ];
            } 
            elseif ($graf == 2) {
                    $start = Input::get("start");
                    $duration=Input::get("duration");
                     $st=Input::get("st");
                    $broj=$start;       
                    $start2= $st;
                    $end=$start2+300;
                   
                   if(count($ang_r)>300){
                   if($st+300>count($ang_r)){
                       $start2=$st;
                       $end=count($ang_r);
                       
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
                    $duzina1= strlen($var1);
                    $duzina2= strlen($var2);
                    $duzina3= strlen($var3);
                    $duzina4= strlen($var4);
                    if($duzina1>$duzina2){
                        $duzina1=$duzina2;
                    }
                     if($duzina3>$duzina4){
                        $duzina3=$duzina4;
                    }
                         for ($i2 = 0; $i2 <  $duzina1; $i2 = $i2 + 2) {
                             $d1[]=GlobalFunctions::complement2(GlobalFunctions::UShort($var1, $i2));
                             $d2[]=GlobalFunctions::complement2(GlobalFunctions::UShort($var2, $i2));

                          }
                          
                        
                          for ($i4 = 0; $i4 < $duzina3; $i4 = $i4+ 4) {
                              $d3[]=GlobalFunctions::Float($var3, $i4);
                              $d4[]=GlobalFunctions::Float($var4, $i4);

                          }
                               
                }
                
                    $rv = array();
                    $rv2 = array();
                    $rv3 = array();
                    $rv4 = array();
                    
                    $d2leng=count($d2);
                    for ($i = 0; $i < $d2leng; $i = $i + 1) {
                    $rv[] = [$broj, $d3[$i]];
                    $rv2[] = [$broj, $d4[$i]];
                    $rv3[] = [$broj, $d1[$i]];
                    $rv4[] = [$broj, $d2[$i]];

                    $broj = $broj + 0.01;
                    }
                    $max1=max($d4);
                    $max2=max($d2);
                    if($max1>$max2){
                        $max=$max1;
                    }
                    else{
                        $max=$max2;
                    }

                    $response = [
                        'frc_l' => $rv,
                        'frc_r' => $rv2,
                        'ang_l' => $rv3,
                        'ang_r' => $rv4,
                        'max'=>$max,
                   
                       
                    ];
                } elseif ($graf == 3) {
                    $parametar = Input::get("parametar");
                    $string = "";
                foreach ($parametar as $p) {
                    $slug = $p['slug'];
                    $string = $string . "data->'$[*][*].$slug' as $slug,";
                }
                $results3 = DB::select("SELECT $string stroke_count  FROM `sessions` INNER JOIN `data_biorower_sessions` ON sessions.data_biorower_sessions_id=data_biorower_sessions.id WHERE sessions.id=" . $id . ".");              
                $results2 = [];
                foreach ($parametar as $p) {
                    $slug = $p['slug'];
                    $results2[$slug] = json_decode($results3[0]->$slug);
                }

                $results2['stroke_count'] = json_decode($results3[0]->stroke_count);
                $rv = array();
                for ($i = 0; $i < $results2['stroke_count']; $i = $i + 1) {
                    $rv[]=$i;
                }
                $results2['stroke_count'] = $rv;
                $max=max($results2['stroke_count']);

                $response = [
                    'historydata' => $results2,
                    'max'=>$max
                ];
            }
        }
//        } catch (Exception $e) {
//            $statusCode = 400;
//        }

return Response::json($response, $statusCode);
        ob_end_flush();
    }

}


