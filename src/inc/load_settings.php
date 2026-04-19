<?php
$res_usett = mysqli_query($conn, "SELECT * FROM settings");
$myrow_usett = mysqli_fetch_assoc($res_usett);
do {
    if ($myrow_usett['id']== 1)
        {
            $email_alert = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 2)
        {
            $text_alert = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 3)
        {
            $alert_low = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 4)
        {
            $alert_high = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 5)
        {
            $alert_delay = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 6)
        {
            $alert_sensor = $myrow_usett['value'];
        }
    if ($myrow_usett['id']== 7)
        {
            $temp_buffer = $myrow_usett['value'];
        }
} while ($myrow_usett = mysqli_fetch_assoc($res_usett));

$results = mysqli_query($conn, "SELECT * FROM sensors where sid=$alert_sensor");
$myrows = mysqli_fetch_assoc($results);
$mylocation = $myrows['web_location'];
$myromid = $myrows['romid'];
?>