<?php
//
// Konfiguracioni fajl za parametre
//

return [
	/////----------------- TOTAL PARAMETERS - Ukupni parametri / pocetak
	//// User module types
	// TOTAL NUMBER OF STROKES - ukupan broj zaveslaja/strokes
	'tscnt'	=>
		[
			'title' 		=> 'Total number of strokes',
			'tag'			=> 'scnt',
			'format'		=> '',
			'color'			=> 'FF0000FF',
		],
	// TOTAL TRAINING SESSIONS - ukupan broj treninga/sesija
	'sescnt'	=>
		[
			'title' 		=> 'Total training sessions',
			'tag'			=> 'sescnt',
			'format'		=> '',
			'color'			=> '',
		],
	// Total user Distance
	'tdist' => 
		[
			'unit'			=>	'[km]', // jedinica za parametar
			'title'			=> 	'Total distance', // naziv parametra
			'tag' 			=> 	'dist', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF0000FF', // boja koja se prikazuje u graficima
		],
	/////----------------- TOTAL PARAMETERS - Ukupni parametri / kraj

	
	/////------SESSION MODULE TYPES-----------  / 2000-2031 / Pocetak
	/// Parametri za jednu sesiju i total parametri jer se samo razlikuje za tri gore navedena parametra
	/// Za total parametre se ne koristi title

	//----- Stroke Count /  NUMBER OF STROKES - broj zaveslaja u jednoj sesiji/treningu
	'scnt'	=>
		[
			'title' 		=> 'Stroke Count',
			'tag'			=> 'scnt',
			'format'		=> '',
			'color'			=> 'FF0000FF',
		],
	//----- TIME - Trajanje jedne sesije ili ukupno vreme svih sesija /TOTAL TRAINING TIME/ 
	'time' => 
		[
			'unit'			=>	'[hh:mm:ss]', // jedinica za parametar
			'title'			=> 	'Time', // naziv parametra
			'tag' 			=> 	'time', // short name
			'description' 	=> 	'',
			'format' 		=>	'H:i:s', 
			'color'			=> 	'FF0000FF', // boja koja se prikazuje u graficima
		],

	//----- Distance
	'dist' => 
		[
			'unit'			=>	'[km]', // jedinica za parametar
			'title'			=> 	'Distance', // naziv parametra
			'tag' 			=> 	'dist', // short name
			'description' 	=> 	'',
			'format' 		=>	'3', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF0000FF', // boja koja se prikazuje u graficima
		],

	//----- Stroke Distance Average    / TOTAL STROKE DISTANCE AVERAGE / 
	'sdist_avg' => 
		[
			'unit'			=>	'[m]', // jedinica za parametar
			'title'			=> 	'Stroke Distance Average', // naziv parametra
			'tag' 			=> 	'sdist_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // broj decimalnih mesta
			'color'			=> 	'FF000080', // boja koja se prikazuje u graficima
		],

	//----- Stroke Distance Max
	'sdist_max' => 
		[
			'unit'			=>	'[m]', // jedinica za parametar
			'title'			=> 	'Stroke Distance Max', // naslov parametra
			'tag' 			=> 	'sdist_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // broj formatimalnih mesta
			'color'			=> 	'FF00FF00', // boja koja se prikazuje u graficima
		],

	//----- Speed Average
	'spd_avg' => 
		[
			'unit'			=>	'[m/s]', // jedinica za parametar
			'title'			=> 	'Speed Average', // naslov parametra
			'tag' 			=> 	'spd_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // broj decimalnih mesta
			'color'			=> 	'FFFFFFFF', // boja koja se prikazuje u graficima
		],

	//----- Speed Max
	'spd_max' => 
		[
			'unit'			=>	'[m/s]', // jedinica za parametar
			'title'			=> 	'Speed Max', // naslov parametra
			'tag' 			=> 	'spd_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // broj decimalnih mesta
			'color'			=> 	'FFFF0000', // boja koja se prikazuje u graficima
		],

	//----- Pace 500m Average
	'pace500_avg' => 
		[
			'unit'			=>	'[mm.ss]', // jedinica za parametar
			'title'			=> 	'Pace 500m Average', // naslov parametra
			'tag' 			=> 	'pace500_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FFFF0000', // boja koja se prikazuje u graficima
		],

	//----- Pace 500m Max
	'pace500_max' => 
		[
			'unit'			=>	'[mm.ss]', // jedinica za parametar
			'title'			=> 	'Pace 500m Max', // naslov parametra
			'tag' 			=> 	'pace500_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FFFF8000', // boja koja se prikazuje u graficima
		],

	//----- Pace 2km Average
	'pace2k_avg' => 
		[
			'unit'			=>	'[mm.ss]', // jedinica za parametar
			'title'			=> 	'Pace 2km Average', // naslov parametra
			'tag' 			=> 	'pace2k_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FFFF8000', // boja koja se prikazuje u graficima
		],

	//----- Pace 2km Max
	'pace2k_max' => 
		[
			'unit'			=>	'[mm.ss]', 
			'title'			=> 	'Pace 2km Max', 
			'tag' 			=> 	'pace2k_max', 
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FFFF8000', 
		],

	//----- Heart Rate Average / TOTAL HR AVERAGE 
	'hr_avg' => 
		[
			'unit'			=>	'[bpm]', // jedinica za parametar
			'title'			=> 	'Heart Rate Average', // naslov parametra
			'tag' 			=> 	'hr_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF804000', // boja koja se prikazuje u graficima
		],	

	//----- Heart Rate Max 
	'hr_max' => 
		[
			'unit'			=>	'[bpm]', // jedinica za parametar
			'title'			=> 	'Heart Rate Max', // naslov parametra
			'tag' 			=> 	'hr_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF804000', // boja koja se prikazuje u graficima
		],		

	//----- Stroke Rate Average
	'srate_avg' => 
		[
			'unit'			=>	'[spm]', // jedinica za parametar
			'title'			=> 	'Stroke Rate Average', // naslov parametra
			'tag' 			=> 	'srate_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],	

	//----- Stroke Rate Max
	'srate_max' => 
		[
			'unit'			=>	'[spm]', // jedinica za parametar
			'title'			=> 	'Stroke Rate Max', // naslov parametra
			'tag' 			=> 	'srate_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],

	//----- Calories
	'cal' => 
		[
			'unit'			=>	'[kCal]', // jedinica za parametar
			'title'			=> 	'Calories', // naslov parametra
			'tag' 			=> 	'cal', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // broj decimala
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],	

	//----- Power Left Average
	'pwr_l_avg' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Left Average', // naslov parametra
			'tag' 			=> 	'pwr_l_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],

	//----- Power Left Max
	'pwr_l_max' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Left Max', // naslov parametra
			'tag' 			=> 	'pwr_l_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],

	//----- Power Right Average
	'pwr_r_avg' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Right Average', // naslov parametra
			'tag' 			=> 	'pwr_r_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF008000', // boja koja se prikazuje u graficima
		],

	//----- Power Right Max
	'pwr_r_max' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Right Max', // naslov parametra
			'tag' 			=> 	'pwr_r_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF008000', // boja koja se prikazuje u graficima
		],													

	//-----  Power Average   / TOTAL POWER AVERAGE /
	'pwr_avg' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Average', // naslov parametra
			'tag' 			=> 	'pwr_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  Power Max  
	'pwr_max' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Max', // naslov parametra
			'tag' 			=> 	'pwr_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],	

	//-----  Power Balance Average 
	'pwr_bal_avg' => 
		[
			'unit'			=>	'[%]', // jedinica za parametar
			'title'			=> 	'Power Balance Average', // naslov parametra
			'tag' 			=> 	'pwr_bal_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],	

	//-----  Power Balance Max
	'pwr_bal_max' => 
		[
			'unit'			=>	'[%]', // jedinica za parametar
			'title'			=> 	'Power Balance Max', // naslov parametra
			'tag' 			=> 	'pwr_bal_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],	

	//-----  Angle Left Average
	'ang_l_avg' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Left Average', // naslov parametra
			'tag' 			=> 	'ang_l_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  Angle Left Max
	'ang_l_max' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Left Max', // naslov parametra
			'tag' 			=> 	'ang_l_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  Angle Right Average
	'ang_r_avg' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Right Average', // naslov parametra
			'tag' 			=> 	'ang_r_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  Angle Right Max
	'ang_r_max' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Right Max', // naslov parametra
			'tag' 			=> 	'ang_r_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],								

	//----- Angle Average / TOTAL ANGLE AVERAGE / 
	'ang_avg' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Average', // naslov parametra
			'tag' 			=> 	'ang_avg', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//----- Angle Max 
	'ang_max' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Max', // naslov parametra
			'tag' 			=> 	'ang_max', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  MML 2 Level
	'mml2' => 
		[
			'unit'			=>	'[mmol/l]', // jedinica za parametar
			'title'			=> 	'MML 2 Level', // naslov parametra
			//'tag' 		=> 	'mml2_lvl', // short name
			'tag' 			=> 	'mml2', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],

	//-----  MML 4 Level
	'mml4' => 
		[
			'unit'			=>	'[mmol/l]', // jedinica za parametar
			'title'			=> 	'MML 4 Level', // naslov parametra
			//'tag' 		=> 	'mml4_lvl', // short name
			'tag' 			=> 	'mml4', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF606060', // boja koja se prikazuje u graficima
		],	


	//// -------- STROKE MODULE TYPES  / Pocetak
	// Parametri za jedan zaveslaj/stroke
	// 1000-1014

	//----- Time / Stroke time
	'stime' =>
		[
			'unit'			=>	'[ss.hh]', // jedinica za parametar
			'title'			=> 	'Time', // naziv parametra
			'tag' 			=> 	'time', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // broj decimalnih mesta
			'color'			=> 	'FF0000FF', // boja koja se prikazuje u graficima
		],

	//----- Distance
	'sdist' => 
		[
			'unit'			=>	'[m]', // jedinica za parametar
			'title'			=> 	'Distance', // naziv parametra
			'tag' 			=> 	'dist', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // ogranicenje decimala
			'color'			=> 	'FF0000FF', // boja koja se prikazuje u graficima
		],		

	//----- Speed 
	'sspd' => 
		[
			'unit'			=>	'[m/s]', // jedinica za parametar
			'title'			=> 	'Speed', // naslov parametra
			'tag' 			=> 	'spd', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // broj decimalnih mesta
			'color'			=> 	'FF800080', // boja koja se prikazuje u graficima
		],

	//----- Pace 500m
	'space500' => 
		[
			'unit'			=>	'[mm.ss]', // jedinica za parametar
			'title'			=> 	'Pace 500m', // naslov parametra
			'tag' 			=> 	'pace500', // short name
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FF000080', // boja koja se prikazuje u graficima
		],

	//----- Pace 2km
	'space2k' => 
		[
			'unit'			=>	'[mm.ss]', // jedinica za parametar
			'title'			=> 	'Pace 2km', // naslov parametra
			'tag' 			=> 	'pace2k', // short name
			'description' 	=> 	'',
			'format' 		=>	'i:s', // format mm.ss
			'color'			=> 	'FF000080', // boja koja se prikazuje u graficima
		],

	//----- Heart Rate
	'hr' => 
		[
			'unit'			=>	'[bpm]', // jedinica za parametar
			'title'			=> 	'Heart Rate', // naslov parametra
			'tag' 			=> 	'hr', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF00FF00', // boja koja se prikazuje u graficima
		],

	//----- Stroke Rate 
	'srate' => 
		[
			'unit'			=>	'[spm]', // jedinica za parametar
			'title'			=> 	'Stroke Rate', // naslov parametra
			'tag' 			=> 	'srate', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFFFF', // boja koja se prikazuje u graficima
		],

	//----- Calories
	'scal' => 
		[
			'unit'			=>	'[kCal]', // jedinica za parametar
			'title'			=> 	'Calories', // naslov parametra
			'tag' 			=> 	'cal', // short name
			'description' 	=> 	'',
			'format' 		=>	'2', // broj decimala
			'color'			=> 	'FFFF0000', // boja koja se prikazuje u graficima
		],

	//----- Power Left 
	'pwr_l' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Left', // naslov parametra
			'tag' 			=> 	'pwr_l', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFec7b15', // boja koja se prikazuje u graficima
		],
		
	//----- Power Right
	'pwr_r' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power Right', // naslov parametra
			'tag' 			=> 	'pwr_r', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FF1192cb', // boja koja se prikazuje u graficima
		],
		
	//----- Power Right Average
	'pwr' => 
		[
			'unit'			=>	'[W]', // jedinica za parametar
			'title'			=> 	'Power', // naslov parametra
			'tag' 			=> 	'pwr', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', // za prikaz parametra, ogranicenje decimala ili format vremena
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],

	//-----  Power Balance Max
	'pwr_bal' => 
		[
			'unit'			=>	'[%]', // jedinica za parametar
			'title'			=> 	'Power Balance', // naslov parametra
			'tag' 			=> 	'pwr_bal', // short name
			'description' 	=> 	'',
			'format' 		=>	'1', // ogranicenje decimala 
			'color'			=> 	'FFFFFF60', // boja koja se prikazuje u graficima
		],

	//-----  Angle Left
	'ang_l' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Left', // naslov parametra
			'tag' 			=> 	'ang_l', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FFec7b15', // boja koja se prikazuje u graficima
		],
	//-----  Angle Right
	'ang_r' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle Right', // naslov parametra
			'tag' 			=> 	'ang_r', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FF1192cb', // boja koja se prikazuje u graficima
		],
	//-----  Angle
	'ang' => 
		[
			'unit'			=>	'[°]', // jedinica za parametar
			'title'			=> 	'Angle', // naslov parametra
			'tag' 			=> 	'ang', // short name
			'description' 	=> 	'',
			'format' 		=>	'0', //  ogranicenje decimala 
			'color'			=> 	'FFFF8000', // boja koja se prikazuje u graficima
		],			
	//// -------- STROKE MODULE TYPES  / kraj

];
