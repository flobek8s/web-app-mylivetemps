<?php
//****
//		grabs current temps for all sensors and stores them in an array.
//		4/12/2017 - v1.2
//		12/22/2017 - v1.3 - Update to use RPi table
//			- Queries
//			- trend if statements
//			- Array details
//		11.21.2019 - v1.4 - updated SQL statement to not include the sensors the user has set the Display to Off.
//		10/31/2023 - added high, low, and avg temps to the temp_array
//		11/03/2023 - updated querys for the temp trend, simplified to just get last two records and compare
//		11/03/2023 - added read temp and temp buffer to the temp_array
// 		11/03/2023 - removed the as_temp + temp_buffer since it is now in the python code
//
//****

//GET ALERT SENSOR TEMP
$result_as = mysqli_query($conn, "SELECT * FROM sensors where sid=$alert_sensor");
$myrow_as = mysqli_fetch_assoc($result_as);
$as_romid = $myrow_as['romid'];

$result_ast = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$as_romid\" order by autoid DESC LIMIT 1");
$myrow_ast = mysqli_fetch_assoc($result_ast);

//$as_temp = $myrow_ast['temp'] + $temp_buffer;
$as_temp = $myrow_ast['temp'];

//REST OF THE TEMPS

$result = mysqli_query($conn, "SELECT * FROM sensors where display = \"On\"");
$myrow = mysqli_fetch_assoc($result);
$temp_array = array();
do {
	$romid = $myrow['romid'];
	$id = $myrow['sid'];
	// $result_temp = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" order by autoid DESC, date ASC, time24 ASC LIMIT 1");
	// $myrow_temp = mysqli_fetch_assoc($result_temp);
	// $result_ck = mysqli_query($conn, "(SELECT * FROM templog where sensorid = \"$romid\" order by autoid DESC LIMIT 5) order by autoid ASC");
	// $myrow_ck = mysqli_fetch_assoc($result_ck);
	$result_temp = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" order by autoid DESC LIMIT 1");
	$myrow_temp = mysqli_fetch_assoc($result_temp);
	$result_ck = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" order by autoid DESC LIMIT 1,1");
	$myrow_ck = mysqli_fetch_assoc($result_ck);

	$result_high = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" order by temp DESC LIMIT 1");
	$myrow_high = mysqli_fetch_assoc($result_high);

	// $result_low = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" and temp > 120 order by temp ASC LIMIT 1");
	$result_low = mysqli_query($conn, "SELECT * FROM templog where sensorid = \"$romid\" order by temp ASC LIMIT 1");
	$myrow_low = mysqli_fetch_assoc($result_low);

	// $result_avg = mysqli_query($conn, "SELECT AVG(temp) FROM templog where sensorid = \"$romid\" and temp > 120");
	$result_avg = mysqli_query($conn, "SELECT AVG(temp) FROM templog where sensorid = \"$romid\" ");
	$myrow_avg = mysqli_fetch_assoc($result_avg);

	if ($myrow_temp['temp'] == $myrow_ck['temp'])
		{
			//$trend = "trend_flat";
            $trend = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"32\" viewBox=\"0 -960 960 960\" width=\"32\"><path class=\"trend-flat\" d=\"m700-300-57-56 84-84H120v-80h607l-83-84 57-56 179 180-180 180Z\"/></svg>";
			$trend_small = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"24\" viewBox=\"0 -960 960 960\" width=\"24\"><path class=\"trend-flat\" d=\"m700-300-57-56 84-84H120v-80h607l-83-84 57-56 179 180-180 180Z\"/></svg>";
		}
	if ($myrow_temp['temp'] > $myrow_ck['temp'])
		{
			//$trend = "trend_up";
            $trend = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"32\" viewBox=\"0 -960 960 960\" width=\"32\"><path class=\"trend-up\" d=\"m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z\"/></svg>";
			$trend_small = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"24\" viewBox=\"0 -960 960 960\" width=\"24\"><path class=\"trend-up\" d=\"m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z\"/></svg>";
		}
	if ($myrow_temp['temp'] < $myrow_ck['temp'])
		{
			//$trend = "trend_down";
            $trend = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"32\" viewBox=\"0 -960 960 960\" width=\"32\"><path class=\"trend-down\" d=\"M640-240v-80h104L536-526 376-366 80-664l56-56 240 240 160-160 264 264v-104h80v240H640Z\"/></svg>";
			$trend_small = "<svg xmlns=\"http://www.w3.org/2000/svg\" height=\"24\" viewBox=\"0 -960 960 960\" width=\"24\"><path class=\"trend-down\" d=\"M640-240v-80h104L536-526 376-366 80-664l56-56 240 240 160-160 264 264v-104h80v240H640Z\"/></svg>";
		}
	//update array
	// var_dump($myrow, $myrow_temp, $myrow_high, $myrow_low, $myrow_avg);
	//array_push($temp_array, array($id,$romid,$myrow['web_location'],$myrow_temp['temp'],$myrow_temp['autoid'],$myrow_temp['date'],$myrow_temp['time12'], $trend, $myrow_high['temp'], $myrow_high['date'], $myrow_high['time12'], $myrow_low['temp'], $myrow_low['date'], $myrow_low['time12'], $myrow_avg['AVG(temp)'], $trend_small, $myrow_temp['read_temp'], $myrow_temp['temp_buffer']));
	array_push($temp_array, array($id,$romid,$myrow['web_location'],$myrow_temp['temp'],$myrow_temp['autoid'],$myrow_temp['date'],$myrow_temp['time12'], $trend, $myrow_high['temp'], $myrow_high['date'], $myrow_high['time12'], $myrow_low['temp'], $myrow_low['date'], $myrow_low['time12'], $myrow_avg['AVG(temp)'], $trend_small, $myrow_temp['read_temp'], $myrow_temp['temp_buffer']));
} while ($myrow = mysqli_fetch_assoc($result));
$current_datetime_d = $temp_array[0][5];
$current_datetime_t12 = $temp_array[0][6];
//to set array index -> 'sensor' => $romid
//ARRAY-DETAILS - updated 12/22/2017
	//0 - ID
	//1 - ROMID
	//2 - Sensor Location
	//3 - Current Temp
	//4 - Temp Log Reading ID for current temp
	//5 - Current Temp DATE
	//6 - Current Temp TIME
	//7 - Trend
	//8 - High Temp
	//9 - High Temp Date
	//10 - High Temp Time 12hr
	//11 - Low Temp
	//12 - Low Temp Date
	//13 - Low Temp Time 12hr
	//14 - Avg Temp
	//15 - Trend Small
	//16 - Read Temp(before buffer)
	//17 - Temp Buffer

//echo $temp_array[0][5];
//$runtime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
//echo "<br><br>Run Time: $runtime seconds<br><br>\n";
// print("<pre>");
// print_r($temp_array);
// print("</pre>");
?>