<?php namespace App\Http\Controllers\Braining;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as req;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Setting;
use Exception;
use App\User;
use Input;
class SettingController extends Controller {




    public function store()
    {

        $statusCode = 200;

        try{
            $response = [
              'response'  => '',
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



                $cilj=input::get("cilj");

            $userFirst = $user->first();

            if ($user->isEmpty()){
                $statusCode = 403;
            }
            else
            {
                            if($cilj==1){
                                $history=Setting::where("user_id", $userFirst->id)->where("name", "history")->get();
                                $progress=Setting::where("user_id", $userFirst->id)->where("name", "progress")->get();
                                
                                   if(count($history)==0){
                                       $history=new Setting();
                                       $history->user_id=$userFirst->id;
                                       $history->dateStart= date("Y-m-d H:i:s",strtotime("-1 months")); 
                                       $history->rangeType="month";
                                       $history->parametar1="scnt";
                                       $history->parametar2="nista";
                                       $history->parametar3="nista";
                                       $history->name="history";
                                       $history->groupType='none';
                                       $history->save();
                                
                                   }
                                     if(count($progress)==0){
                                       $progress=new Setting();
                                       $progress->user_id=$userFirst->id;
                                       $progress->dateStart=date("Y-m-d H:i:s",strtotime("-1 year")); 
                                       $progress->rangeType="year";
                                       $progress->parametar1="scnt";
                                       $progress->parametar2="nista";
                                       $progress->parametar3="nista";
                                       $progress->name="progress";
                                       $progress->groupType="week";
                                       $progress->save();
                                
                                   }
                                     $history=Setting::where("user_id", $userFirst->id)->where("name", "history")->get();
                                $progress=Setting::where("user_id", $userFirst->id)->where("name", "progress")->get();
                                   
                                   
                                     $response = [
                           'response' => 'ok','history' => $history,'progress'=>$progress,
                           ];
                                   
                                   

                            }
                            if($cilj==2){

                                  $name=Input::get("name");
                                  $date_start=Input::get("date_start");
                                  $range_type=Input::get("range_type");

                                  $parametar1=Input::get("parametar1");
                                  $parametar2=Input::get("parametar2");
                                  $parametar3=Input::get("parametar3");
                                  $groupType=Input::get("groupType");



                                  Setting::where('user_id', $userFirst->id)->where("name", $name)
                                   ->update(array('name' => $name,'dateStart'=>$date_start,'rangeType'=>$range_type,'parametar1'=>$parametar1,'parametar2'=>$parametar2,'parametar3'=>$parametar3,'groupType'=>$groupType));

                                   $response = [
                  'response' => 'ok',
                ];

                            }










            }

         }
         catch (Exception $e)
        {
            $statusCode = 400;
        }

        return Response::json($response, $statusCode);
    }


}