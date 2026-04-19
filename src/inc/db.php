<?php
$conn = mysqli_connect($_ENV['mysql_host'], $_ENV['mysql_user'], $_ENV['mysql_pass'], $_ENV['mysql_db']);
//if (mysqli_connect_errno($conn)) {
//    echo "Failed to connect to MySQL: " . mysqli_connect_error();
//}
mysqli_set_charset($conn, "utf8");
putenv("TZ=US/Eastern");
date_default_timezone_set('America/New_York');
?>
