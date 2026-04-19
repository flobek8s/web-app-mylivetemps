<?php
//****
//		sensor.php - displays details on an individual sensor / the sensor data is loaded in inc/get_individual_sensor.php
//		10/19/2018 - v1
//		12/17/2020 - v1.1 - removed the select only an hour worth of data, since the templog is being cleaned.
//		10/31/2023 - Update the SQL statement to just grab the last 20 records to get rid of the date and time query - last 20 is about is about 1.5 hours of data
//		11/03/2023 - removed code that looked for the alert sensor, not needed since the temp buffer is now in the python code
//****
require_once("inc/head.php");
$sensor = $_GET['sen'];
$result = mysqli_query($conn, "SELECT * FROM sensors where sid = $sensor");
$myrow = mysqli_fetch_assoc($result);
$s_romid = $myrow['romid'];
$sensor_location = $myrow['web_location'];

?>
<table style="width: auto;" class="table table-striped table-bordered table-condensed mx-auto mt-5">
	<thead>
		<tr>
			<th class="text-center" colspan="3" class="thead-default">
				<h4><svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path class="temp-icon" d="M480-80q-83 0-141.5-58.5T280-280q0-48 21-89.5t59-70.5v-320q0-50 35-85t85-35q50 0 85 35t35 85v320q38 29 59 70.5t21 89.5q0 83-58.5 141.5T480-80Zm-40-440h80v-40h-40v-40h40v-80h-40v-40h40v-40q0-17-11.5-28.5T480-800q-17 0-28.5 11.5T440-760v240Z"/></svg><font class="heading-md">Sensor Details for:</font> <font class="heading-sensor"><?php echo $sensor_location; ?></font></h4>
			</th>
		</tr>
		<tr><td align="center" colspan="3"><font class="heading-md">Readings for the last hour</font></td></tr>
		<tr>
			<th class="text-center bg-dark"><div class="text-white">Date</div></th>
			<th class="text-center bg-dark"><div class="text-white">Time</div></th>
			<th class="text-center bg-dark"><div class="text-white">Temp</div></th>
		</tr>
	</thead>
<?php
$calc = 0;
$cnt = 0;
$date = date("m/d/Y");
$read_time = date('H:i:s', time() - 3600); //subtract an hour from current time
//echo $date;
//$result_h = mysqli_query($conn, "SELECT * FROM `templog` where sensorid = \"$s_romid\" and date=\"$date\" and time24 >= \"$read_time\" order by autoid DESC");
$result_h = mysqli_query($conn, "SELECT * FROM `templog` where sensorid = \"$s_romid\" order by autoid DESC LIMIT 20");
$myrow_h = mysqli_fetch_assoc($result_h);
do {
    //if ($sensor == $alert_sensor)
    //    {
    //        $display_temp = $myrow_h['temp'] + $temp_buffer;
    //    }
    //else
    //    {
    //        $display_temp = $myrow_h['temp'];
    //    }
    echo "<tr><td align=center>".$myrow_h['date']."</td><td align=center>".$myrow_h['time12']."</td><td align=center>".$myrow_h['temp']."<font class=\"temp_buffer\">(".$myrow_h['temp_buffer'].")</font></td></tr>";
	$calc = $calc + $myrow_h['temp'];
	$cnt = $cnt + 1;

} while ($myrow_h = mysqli_fetch_assoc($result_h));
$avg = round($calc / $cnt,2);
echo "<tr><td></td><td align=center>Avg</td><td align=center>".$avg."</td></tr>";
?>
</table>
<?php
// require_once("inc/foot.php");
?>