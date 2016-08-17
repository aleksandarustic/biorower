<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use App\Session;
use Hashids\Hashids;
use Mail;
use Carbon;
use App\Message;
use App\Library\GlobalFunctions;
use App\Watching;
use Auth;
use Exception;
use App\User;
use Input;

class GetsessionsController extends Controller {

   public function store()
   {

      try{
          
           $statusCode = 200;
           $response = [
             'sessionIds'  => '',
           ];

           $email = explode(":", Input::get("account"));

           if ($email[0] == "twitter"){
              $user = User::where('twitter_id', $email[1])->get();
           }
           else if ($email[0] == "facebook"){
              $user = User::where('facebook_id', $email[1])->get();
         }          
           else{
            $user = User::where('email', $email[1])->get();
         }

         if ($user->isEmpty()){
             throw new Exception;
         }

         $userFirst = $user->first();

         $arrayIds = array();
         foreach (Input::get("sessionIds") as $valInput) {
            array_push($arrayIds, $valInput);
         }

         $sessions = Session::whereIn('id', $arrayIds)->with("sessionSummary")->get();

         $arraySessions = array();


            function UInt($var, $i){
                return      (ord($var[$i    ]) & 0xFF) |
                ((ord($var[$i + 1]) & 0xFF) << 8)  |
                ((ord($var[$i + 2]) & 0xFF) << 16) |
                ((ord($var[$i + 3]) & 0xFF) << 24);
            }
//
            function intBitsToFloat($bits){

                $s = (($bits >> 31) == 0) ? 1 : -1;
                $e = (($bits >> 23) & 0xff);
                $m = ($e == 0) ?
                    ($bits & 0x7fffff) << 1 :
                    ($bits & 0x7fffff) | 0x800000;

                $d = $s * $m * pow(2, $e - 150);

                return $d;
            }


            function Float($var, $i){
                return intBitsToFloat(UInt($var, $i));
            }




            function UShort($var, $i){
                return
                    ((ord($var[$i    ]) & 0xFF)) |
                    ((ord($var[$i + 1]) & 0xFF) << 8);
            }


            function complement2($num) {
                if (0x8000 & $num) {
                    $num = - (0x010000 - $num);
                }
                return $num;
            }
            $d1=array();
            $d2=array();
            $d3=array();
            $d4=array();
            
            $pc=Input::get("pc");
       

            

         foreach ($sessions as $session) {
            $tmp = array();
            //za biorower

            $tmp["ID"]              = $arrayIds[0];
            $tmp["name"]         = $session["name"];
            $tmp["description"]       = $session["description"];
            $tmp["dataVersion"]    = $session["dataVersion"];
            $tmp["deviceType"]        = $session["deviceType"];
            $tmp["serialNumber"]   = $session["serialNumber"];
            $tmp["firmwareVersion"] = $session["firmwareVersion"];

            $UA = array();
            $UA['type']          = $session["UA_type"];
            $UA['name']          = $session["UA_name"];
            $UA['serialNumber']    = $session["UA_serialNumber"];
            $UA['application']        = $session["UA_application"];
            $UA['appVersion']     = $session["UA_appVersion"];

            $tmp["userAgent"]     = $UA;

            $tmp["account"]       = Input::get("account");
            $tmp["UTC"]          = $session["utc"];
            $tmp["date"]         = $session["date"];
      
            $tmp["splits"]       = json_decode($session["data"]);


                    if($pc==1){
                
                foreach ($tmp["splits"][0] as $spl) {
                    $var1 = base64_decode($spl->signal->ang_l);
                    $var2 = base64_decode($spl->signal->ang_r);
                    $var3 = base64_decode($spl->signal->frc_l);
                    $var4 = base64_decode($spl->signal->frc_r);




                    for($i = 0; $i < strlen($var1)-1; $i= $i+2)
                    {

                        array_push($d1, complement2(UShort($var1, $i))." ");
                      
                    }
                     for($i4 = 0; $i4 < strlen($var2)-1; $i4= $i4+2)
                    {

                        array_push($d2, complement2(UShort($var2, $i4))." ");
                      
                    }
                    for($i2 = 0; $i2 < strlen($var3)-1; $i2= $i2+4)
                    {
                        array_push($d3,Float($var3, $i2)." ");
                       

                    }
                    for($i5 = 0; $i5 < strlen($var4)-1; $i5= $i5+4)
                    {
                        array_push($d4,Float($var4, $i5)." ");
                       

                    }
                    
                    $spl->signal->ang_l=$d1;
                    $spl->signal->ang_r=$d2;
                    $spl->signal->frc_l=$d3;
                    $spl->signal->frc_r=$d4;









                }


                
                
                
                
                                 }






            $summary_list = array();
            $summary_list["scnt"]     = $session->sessionSummary->stroke_count;
            $summary_list["time"]     = $session->sessionSummary->time;
            $summary_list["dist"]     = $session->sessionSummary->distance;
            $summary_list['cal']      = $session->sessionSummary->calories;
            $summary_list["sdist_avg"]     = $session->sessionSummary->stroke_distance_average;
            $summary_list["sdist_max"]     = $session->sessionSummary->stroke_distance_max;
            $summary_list["spd_avg"]   = $session->sessionSummary->speed_average;
            $summary_list["spd_max"]   = $session->sessionSummary->speed_max;
            $summary_list["pace500_avg"]= $session->sessionSummary->pace_average;
            $summary_list["pace500_max"]= $session->sessionSummary->pace_max;
            $summary_list["pace2k_avg"]    = $session->sessionSummary->pace2km_average;
            $summary_list["pace2k_max"]    = $session->sessionSummary->pace2km_max;
            $summary_list["hr_avg"]    = $session->sessionSummary->heart_rate_average;
            $summary_list["hr_max"]    = $session->sessionSummary->heart_rate_max;
            $summary_list["srate_avg"]     = $session->sessionSummary->stroke_rate_average;
            $summary_list["srate_max"]     = $session->sessionSummary->stroke_rate_max;
            $summary_list["pwr_avg"]   = $session->sessionSummary->power_average;
            $summary_list["pwr_max"]   = $session->sessionSummary->power_max;
            $summary_list["pwr_l_avg"]     = $session->sessionSummary->power_left_average;
            $summary_list["pwr_l_max"]     = $session->sessionSummary->power_left_max;
            $summary_list["pwr_r_avg"]     = $session->sessionSummary->power_right_average;
            $summary_list["pwr_r_max"]     = $session->sessionSummary->power_right_max;
            $summary_list["pwr_bal_avg"]= $session->sessionSummary->power_balance;
            $summary_list["pwr_bal_max"]= $session->sessionSummary->power_balance_max;
            $summary_list["ang_l_avg"]     = $session->sessionSummary->angle_left_average;
            $summary_list["ang_l_max"]     = $session->sessionSummary->angle_left_max;
            $summary_list["ang_r_avg"]     = $session->sessionSummary->angle_right_average;
            $summary_list["ang_r_max"]     = $session->sessionSummary->angle_right_max;
            $summary_list["ang_avg"]   = $session->sessionSummary->angle_average;
            $summary_list["ang_max"]   = $session->sessionSummary->angle_max;
            $summary_list["mml2"]     = $session->sessionSummary->mml_2_level;
            $summary_list["mml4"]     = $session->sessionSummary->mml_4_level;
            $tmp["summary"]          = $summary_list;
         
            array_push($arraySessions, $tmp);
         }

           $response = [
             'account' => Input::get("account"),
             'sessions'  => $arraySessions,
           ];
      }
      catch (Exception $e)
       {
          $statusCode = 400;
        }

      return Response::json($response, $statusCode);

   }

}