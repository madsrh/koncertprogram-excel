<!DOCTYPE html>
<html>
<head>
<title>Koncertprogram</title>
</head>

<body>
<style>
	body 
		{
		background-image: url("bg.jpg");
		background-size: cover;
		text-align: center;
		font-family: Arial,Helvetica Neue,Helvetica,sans-serif;  
		}
	h2 { font-family: Arial Black, Arial }
	h3 { margin-top: 32px; margin-bottom: 4px;}
	p { color: gray; }
</style>

<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/SimpleXLSX.php';

if ( $xlsx = SimpleXLSX::parse('Koncert.xlsx')) { // change the Excel filename here

	$dim = $xlsx->dimension();
	$num_cols = $dim[0];
	$num_rows = $dim[1];

	// Displays the total number of rows and cols 
	// echo $num_rows . ' rows';
	// echo '<br>';
	// echo $num_cols . ' cols';
    // echo '<hr>';

	echo '<h2>' . $xlsx->getCell(0, 'B1') . '</h2>'; // Get title

	$dato_fra_database = $xlsx->getCell(0, 'C1'); // Get date
	$unixtime = strtotime($dato_fra_database);
	setlocale (LC_ALL, 'da_DK.utf8'); // Convert to danish
	echo '<p>' . strftime('%A d. %e %B kl. ', $unixtime) . $xlsx->getCell(0, 'D1') . '</p>';

	echo '<hr style="width:90%; color: gray;">';

	for ($number = '2'; $number <= $num_rows ; $number++) 
	{
		$elev_cell = 'D' . $number;  // artist name
		$sang_cell = 'G' . $number; // song title
		$tidspunkt_cell = 'C' . $number;  // C cellen    
	
		$sang_title = $xlsx->getCell(0, $sang_cell);
		$cell_content = $xlsx->getCell(0, $elev_cell);
		$tidspunkt = $xlsx->getCell(0, $tidspunkt_cell);
			
		 
		
		// if(isset($tidspunkt)){ 
		//	echo '_______';	
		// } 


		if(isset($sang_title)){ // tjekker om cellen har indhold
			echo '<h3>' . $sang_title . '</h3>';	
		} 

		if(isset($cell_content)){
			echo '<span>' . $xlsx->getCell(0, $elev_cell) . '</span><br>';
		} 

	
	
		//	if(empty($sang_title) && !empty($xlsx->getCell(0, $next))) { echo 'TOM';}	

	}	

	echo SimpleXLSX::parseError();
}


?>

<p style="margin: 54px 0px 14px 0px;">
<!-- Link to logo -->
<img width="50%" src="https://jammerbugt.speedadmin.dk/Public/Files/JAMMERBUGT/logo-2021-med-drama_tynd-skrift_orange.png">
</p>

</body>
</html>
