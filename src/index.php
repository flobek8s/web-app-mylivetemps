<?php
//*-*-*-*-* Comments/Notes *-*-*-*-*//
// index.php
// main page, shows temp gauge with sensor temps
// Created October 10, 2023
//
//	*Update Log
//    - 10/10/2023 - 
//		- 11/03/2023 - removed code that looked for the alert sensor, not needed since the temp buffer is now in the python code
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//

require_once('inc/head.php');
require_once('inc/get_current_temps.php');
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Water', <?php echo $as_temp ?>,]
        ]);

        var options = {
          width: 575, height: 425,
          redFrom: 100, redTo: 145,
          yellowFrom:145, yellowTo: 160,
          greenFrom:160, greenTo: 180,
          minorTicks: 10,
          majorTicks: ['100', '110', '120', '130', '140', '150', '160', '170', '180'],
          min: 100,
          max: 180
        };
        var container = document.getElementById('chart_div');
        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        google.visualization.events.addListener(chart, 'ready', function () {
        Array.prototype.forEach.call(container.getElementsByTagName('circle'), function(circle) {
            if (circle.getAttribute('fill') === '#4684ee') {
                circle.setAttribute('fill', '#000000');
            }
        });
        Array.prototype.forEach.call(container.getElementsByTagName('path'), function(path) {
            if (path.getAttribute('stroke') === '#c63310') {
                path.setAttribute('stroke', '#ff0000');
                path.setAttribute('fill', '#000000');
            }
            });
        });
        chart.draw(data, options);
      }
    </script>
    
<div class="container-fluid w-100 mt-1 border-0">
  <div class="justify-content-center" id="chart_div" style="display: flex; justify-content: center; background:#FFFFFF;"></div>
  <table class="table table-sm table-striped table-bordered w-100 mx-auto">
    <thead>
      <tr>
        <th colspan="2" class="thead-default">
        <h3><svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path class="temp-icon" d="M480-80q-83 0-141.5-58.5T280-280q0-48 21-89.5t59-70.5v-320q0-50 35-85t85-35q50 0 85 35t35 85v320q38 29 59 70.5t21 89.5q0 83-58.5 141.5T480-80Zm-40-440h80v-40h-40v-40h40v-80h-40v-40h40v-40q0-17-11.5-28.5T480-800q-17 0-28.5 11.5T440-760v240Z"/></svg> <font class="heading-lg">Current Temps</font><font class="heading-datetime"><?php echo $current_datetime_d." ".$current_datetime_t12;?></font></h3>
        </th>
      </tr>				
      <tr>
        <th class="w-50 bg-dark"><div class="text-white">Sensor</div></th>
        <th class="text-center w-50 bg-dark"><div class="text-white">Current Temp</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
    foreach($temp_array as $item)
      {
        //if ($item[0] == 1)
        //  {
        //    $temp_display = $item[3] + $temp_buffer;
        //    echo "<tr><th scope=\"row\">"."<a href=\"http://woodmaster.local/sensor.php?sen=".$item[0]."\">".$item[2]."</a>"."</th><td class=\"text-center\">".$temp_display."&deg; $item[7]</td></tr>\n";
        //  }
        //else
        //  {
            echo "<tr><th scope=\"row\">"."<a href=\"sensor.php?sen=".$item[0]."\">".$item[2]."</a>"."</th><td class=\"text-center\">".$item[3]."&deg; $item[7]<font class=\"temp_buffer\">($item[16])</font><font class=\"temp_buffer\">($item[17])</font></td></tr>\n";
        //  }     
      }
 
    $url = "temps.php";
				
    ?>
    <tr><td colspan="2" bgcolor="white"><p class="mt-2"><a class="btn btn-primary" href="<?php echo $url; ?>" role="button">More Detail</a></p></td></tr>
    </tbody>
    </table>
  <br><br>
</div>
  <?php