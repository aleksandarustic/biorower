<?php namespace App\Library;
    
use Image;
use App\User;
use App\Profile;

use DB;
use Carbon;


    class GlobalFunctions {

		public static function test(){
			return "aaa";
		}    	

		// stara verzija 000/000/000/23
		// 000/000/000/
		public static function getFileDirectory($id) {
			    $level1 = ($id / 100000000) % 100000000;
			    $level2 = (($id - $level1 * 100000000) / 100000) % 100000;
			    $level3 = (($id - ($level1 * 100000000) - ($level2 * 100000)) / 100) % 1000;
			    $file   = $id - (($level1 * 100000000) + ($level2 * 100000) + ($level3 * 100));
			
			    return '/' . sprintf("%03d", $level1)
			         . '/' . sprintf("%03d", $level2)
			         . '/' . sprintf("%03d", $level3)
			         . '/';
			         //. '/' . $id;
		}

		//iz /000/000/000/23.jpg do 23
		public static function getIDZaSliku($dirSlike) {
			$arrayDirs = explode('/', $dirSlike);
			$slika = explode('.', $arrayDirs[4]);
			return $slika[0];
		}

		public static function NapraviDirektorijume($arrayDirektorijumi)
		{

			//$dirImages = Yii::getPathOfAlias('webroot.images').DIRECTORY_SEPARATOR;
			//$dirImages = str_replace(stripslashes("//"), stripslashes("\\"), $dirImages);

			$dirImages = storage_path().DIRECTORY_SEPARATOR."profile_images".DIRECTORY_SEPARATOR;

			/*
				if ($drugiDir == 'tmb')
				{
					$dirImages = Yii::getPathOfAlias('webroot.images.tmb').DIRECTORY_SEPARATOR;
				}
			*/
			
			//$dirImages = str_replace(stripslashes("/"), stripslashes('\\\\\\'), Yii::getPathOfAlias('webroot.images').DIRECTORY_SEPARATOR);				
			
			if (!file_exists($dirImages.$arrayDirektorijumi[1]))
				{
					mkdir($dirImages.$arrayDirektorijumi[1]);						
				}
			if (!file_exists($dirImages.$arrayDirektorijumi[1].DIRECTORY_SEPARATOR.$arrayDirektorijumi[2]))
				{
					mkdir($dirImages.$arrayDirektorijumi[1].DIRECTORY_SEPARATOR.$arrayDirektorijumi[2]);						
				}
			if (!file_exists($dirImages.$arrayDirektorijumi[1].DIRECTORY_SEPARATOR.$arrayDirektorijumi[2].DIRECTORY_SEPARATOR.$arrayDirektorijumi[3]))
				{
					mkdir($dirImages.$arrayDirektorijumi[1].DIRECTORY_SEPARATOR.$arrayDirektorijumi[2].DIRECTORY_SEPARATOR.$arrayDirektorijumi[3]);						
				}	
			
			return 	$dirImages.$arrayDirektorijumi[1].DIRECTORY_SEPARATOR.$arrayDirektorijumi[2].DIRECTORY_SEPARATOR.$arrayDirektorijumi[3].DIRECTORY_SEPARATOR;			
		}

		public static function PIPHP_ImageCrop($image, $x, $y, $w, $h)
		{
		   // Plug-in 15: Image Crop
		   //
		   // This plug-in takes a GD image and returns a cropped
		   // version of it. If any arguments are out of the
		   // image bounds then FALSE is returned. The arguments
		   // required are:
		   //
		   //    $image:   The image source
		   //    $x & $y:  The top-left corner
		   //    $w & $h : The width and height

		   $tw = imagesx($image);
		   $th = imagesy($image);
		   if ($x > $tw || $y > $th || $w > $tw || $h > $th)
		      return FALSE;
		   $temp = imagecreatetruecolor($w, $h);
		   imagecopyresampled($temp, $image, 0, 0, $x, $y, $w, $h, $w, $h);
		   return $temp;
		}		

		public static function ProveraEkstenzije($extenzija)
		{
			$arrayDozvoljeneExtenzije = array("jpg","png","gif","jpeg");
			if (in_array($extenzija,$arrayDozvoljeneExtenzije))
				return true;
			else
				return false;
		}
		
		public static function CropSaveAndResizeImage($extenzija, $fullfileName, $x1, $y1, $w, $h)
		{

			switch ($extenzija) {
				case "jpg":
			    case "jpeg":
					$image = imagecreatefromjpeg(storage_path().$fullfileName);
					$copy =  GlobalFunctions::PIPHP_ImageCrop($image, $x1, $y1, $w, $h);
					imagejpeg($copy, storage_path().$fullfileName);
					$img = Image::make(storage_path().$fullfileName)->resize(250, 250);
					$img->save();
			        break;
			    case "png":
					$image = imagecreatefrompng(storage_path().$fullfileName);
					$copy =  GlobalFunctions::PIPHP_ImageCrop($image, $x1, $y1, $w, $h);
					imagepng($copy, storage_path().$fullfileName);
					$img = Image::make(storage_path().$fullfileName)->resize(250, 250);
					$img->save();
			        break;
			    case "gif":
					$image = imagecreatefromgif(storage_path().$fullfileName);
					$copy =  GlobalFunctions::PIPHP_ImageCrop($image, $x1, $y1, $w, $h);
					imagegif($copy, storage_path().$fullfileName);
					$img = Image::make(storage_path().$fullfileName)->resize(250, 250);
					$img->save();
			        break;
			} 
		}
		

		public static function getEncKey()
		{
			return 'MySecretSaltWaterfall1024';
		}

		public static function getEncKeyUserId()
		{
			return 'MyscsaltUser10785';
		}		

		public static function getEncKeyRaceId()
		{
			return 'MyscsaltRace1212431';
		}

		public static function getEncKeyRequestForRace()
		{
			return 'MyscsaltRaceRequestUser';
		}		

		public static function getEncKeyForMessages()
		{
			return 'MyscsaltMyMessages';
		}	

		public static function getEncKeyForComment()
		{
			return 'MyscsaltmmComment';
		}

		public static function getEncKeyForResetPasswordID()
		{
			return 'MyscsaltmmRSDPSD';
		}

		public static function getEncKeyForResetPasswordEmail()
		{
			return 'MyscsaltmmRSDEmail';
		}

		public static function getEncKeyForResetPasswordTime()
		{
			return 'MyscsaltmmRSDTime';
		}		

		public static function getNewFreeLinkName($allUsers, $passedPartOfEmail)
		{
			if (!$allUsers->isEmpty()){
				$nameTry = $passedPartOfEmail;
				$counter = 0;
			    for ($i=0; $i<count($allUsers)+1; $i++) {
			    	$finded = false;
			    	foreach ($allUsers as $key => $value) {
				    	if ($nameTry == $value->linkname){
				    		$finded = true;
				    		break;
				    	}
			    	}
			    	if ($finded){
			    		$counter = $counter + 1;
			    		$nameTry .= $counter;
		    		}
		    		else{
		    			return $nameTry;
		    			break;
		    		}
			    }
			}
			else{
				return $passedPartOfEmail;
			}
		}

		public static function addUserViaSocialConn($password, $network, $id){

			DB::beginTransaction();

			try
			{
				$profile = new Profile();
				$profile->save();

		 		$user = new User();
		 		$user->profile_id = $profile->id;

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 9);
		 		$user->password = bcrypt($randomString);

		 		if ($network == "facebook"){
		 			$user->facebook_id = $id;
		 		}
		 		else if ($network == "twitter"){
		 			$user->twitter_id = $id;
		 		}

		 		$token = bin2hex(openssl_random_pseudo_bytes(16));
				$user->auth_token = $token;

				$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 7);
				$user->email = "e.".$randomString.time()."@btemp.com";

				$allUsers = User::where('linkname', 'LIKE',  $randomString . '%')->get();
				$user->linkname = GlobalFunctions::getNewFreeLinkName($allUsers, $randomString);

				$user->display_name = $randomString;

		 		$user->save();

		 		DB::commit();

		 		return $user;
			}
			catch (Exception $e){
				DB::rollBack();
			}

		}






		/********************************/

		
		public static function GetHistoryStatistics($groupType, $rangeType, $dateStart, $userId, $totalStatisticsWithNoGrouping = false){

				$groupBy = "";
				$positionDate = "";
				switch ($groupType) {
					    case (""):
					    	$positionDate = "";
					        $groupBy = "";
					        break;
					    case ("day"):
					    	$positionDate = "WEEKDAY(date) as position_in_date,";
					        $groupBy = "GROUP BY date";
					        break;
					    case ("week"):
					    	$positionDate = "WEEKOFYEAR(date) as position_in_date,";
					        $groupBy = "GROUP BY WEEK(date)";
					        break;					        
					    case ("month"):
					    	$positionDate = "MONTH(date) as position_in_date,";
					        $groupBy = "GROUP BY MONTH(date)";
					        break;
					    case ("year"):
					    	$positionDate = "0 as position_in_date,";
					        $groupBy = "GROUP BY YEAR(date)";
					        break;	
				}

				$firstDay = new Carbon\Carbon($dateStart);
				$lastDay = new Carbon\Carbon($dateStart);

				switch ($rangeType){
				    case ("week"):
				        $lastDay = clone $firstDay;
				        $lastDay->addDays(6);
				        break;
				    case ("month"):
				    	$lastDay = clone $firstDay;
				    	$lastDay->addMonth();
						$lastDay->day = 0;
				        break;
				    case ("year"):
				    	$lastDay = clone $firstDay;
				        $lastDay->addYear();
				        break;
				    case ("all"):
				    	$firstDay = Carbon\Carbon::createFromDate(1970, 1, 1);
				    	$lastDay = Carbon\Carbon::now();
				        break;
				}

				if ($groupBy == "" && !$totalStatisticsWithNoGrouping){
					$results = DB::select(DB::raw(
						"SELECT ".GlobalFunctions::GetParametersValuesBySessionsQuery($positionDate).
						" FROM data_biorower_sessions
						 	  INNER JOIN sessions
						 	  ON data_biorower_sessions.id = sessions.data_biorower_sessions_id
						 WHERE sessions.user_id = ".$userId.
						 " AND deleted=0 AND date>=\"".$firstDay."\" AND date<=\"".$lastDay."\"".
						 " ORDER BY date ASC"
						 ));
				}
				else{
					$results = DB::select(DB::raw(
						"SELECT ".GlobalFunctions::GetParametersValuesByAverageQuery($positionDate).
						" FROM data_biorower_sessions
						 	  INNER JOIN sessions
						 	  ON data_biorower_sessions.id = sessions.data_biorower_sessions_id
						 WHERE sessions.user_id = ".$userId.
						 " AND deleted=0 AND date>=\"".$firstDay."\" AND date<=\"".$lastDay."\""
						 .$groupBy.
						 " ORDER BY date ASC"
						 ));
				}

				//return $firstDay." ".$lastDay;
				//"datetime":[],"time":[],"power":[]

				return GlobalFunctions::PrepareArrayParametersStatistics($results);

		}

		public static function PrepareArrayParametersStatistics($arrayParameters){

			$arrayGlobal = [];
			foreach ($arrayParameters as $keyOut => $valueOut) {
				foreach ($arrayParameters[$keyOut] as $keyInn => $valueInn) {
					$arrayGlobal = $arrayGlobal + array($keyInn=>array());
					array_push($arrayGlobal[$keyInn], $valueInn);
				}
			}
			return $arrayGlobal;
		}

		public static function GetTotalStatistics($userId){

			$results = DB::select(DB::raw(
				"SELECT ".GlobalFunctions::GetParametersValuesByAverageQuery("").
				"FROM data_biorower_sessions
				 	  INNER JOIN sessions
				 	  ON data_biorower_sessions.id = sessions.data_biorower_sessions_id
				 WHERE sessions.user_id = ".$userId));

			return $results;
		}

		public static function GetParametersValuesBySessionsQuery($positionDate){

			return 
				$positionDate."
				date,
				0 as sescnt,
				stroke_count as scnt,
				time as time,
				distance as dist,
				stroke_distance_average as sdist_avg,
				stroke_distance_max as sdist_max,
				speed_average as spd_avg,
				speed_max as spd_max,
				pace_average as pace500_avg,
				pace_max as pace500_max,
				pace2km_average as pace2k_avg,
				pace2km_max as pace2k_max,
				heart_rate_average as hr_avg,
				heart_rate_max as hr_max,
				stroke_rate_average as srate_avg,
				stroke_rate_max as srate_max,
				calories as cal,
				power_average as pwr_avg,
				power_max as pwr_max,
				power_left_average as pwr_l_avg,
				power_left_max as pwr_l_max,
				power_right_average as pwr_r_avg,
				power_right_max as pwr_r_max,
				power_balance as pwr_bal_avg,
				power_balance_max as pwr_bal_max,
				angle_average as ang_avg,
				angle_max as ang_max,
				angle_left_average as ang_l_avg,
				angle_left_max as ang_l_max,
				angle_right_average as ang_r_avg,
				angle_right_max as ang_r_max,
				mml_2_level as mml2,
				mml_4_level	as mml4		
			";
		}

		public static function getEmptyDataHistory(){
				return '{"position_in_date":[0],"date":["1970-01-01 00:00:00"],"training_sessions":[0],"stroke_count":["0"],"time":[0],"distance":[0],"stroke_distance_average":[0],"stroke_distance_max":[0],"speed_average":[0],"speed_max":[0],"pace_average":[0],"pace_max":[0],"pace2km_average":[0],"pace2km_max":[0], heart_rate_average":[0],"heart_rate_max":[0],"stroke_rate_average":[0],"stroke_rate_max":[0],"calories":[0], power_average":[0],"power_max":[0],"power_left_average":[0],"power_left_max":[0],"power_right_average":[0],"power_right_max":[0],"power_balance":[0],"power_balance_max":[0],"angle_average":[0],"angle_max":[0],"angle_left_average":[0],"angle_left_max":[0],"angle_right_average":[0],"angle_right_max":[0],"mml_2_level":[0],"mml_4_level":[0]}';

		}

		public static function GetParametersValuesByAverageQuery($positionDate){
			return 
				$positionDate."
				date,
				COUNT(*) as sescnt,
				SUM(stroke_count) as scnt,
				SUM(time) as time,
				SUM(distance) as dist,
				(SUM(time*stroke_distance_average)/SUM(time)) as sdist_avg,
				MAX(stroke_distance_max) as sdist_max,
				(SUM(time*speed_average)/SUM(time)) as spd_avg,
				MAX(speed_max) as spd_max,
				(SUM(time*pace_average)/SUM(time)) as pace500_avg,
				MAX(pace_max) as pace500_max,
				(SUM(time*pace2km_average)/SUM(time)) as pace2k_avg,
				MAX(pace2km_max) as pace2k_max,
				(SUM(time*heart_rate_average)/SUM(time)) as hr_avg,
				MAX(heart_rate_max) as hr_max,
				(SUM(time*stroke_rate_average)/SUM(time)) as srate_avg,
				MAX(stroke_rate_max) as srate_max,
				SUM(calories) as cal,
				(SUM(time*power_average)/SUM(time)) as pwr_avg,
				MAX(power_max) as pwr_max,
				(SUM(time*power_left_average)/SUM(time)) as pwr_l_avg,
				MAX(power_left_max) as pwr_l_max,
				(SUM(time*power_right_average)/SUM(time)) as pwr_r_avg,
				MAX(power_right_max) as pwr_r_max,
				(SUM(stroke_count*power_balance)/SUM(stroke_count)) as pwr_bal_avg,
				MAX(power_balance_max) as pwr_bal_max,
				(SUM(stroke_count*angle_average)/SUM(stroke_count)) as ang_avg,
				MAX(angle_max) as ang_max,
				(SUM(stroke_count*angle_left_average)/SUM(stroke_count)) as ang_l_avg,
				MAX(angle_left_max) as ang_l_max,
				(SUM(stroke_count*angle_right_average)/SUM(stroke_count)) as ang_r_avg,
				MAX(angle_right_max) as ang_r_max,
				(SUM(time*mml_2_level)/SUM(time)) as mml2,
				(SUM(time*mml_4_level)/SUM(time)) as mml4
			";
		}	

}

