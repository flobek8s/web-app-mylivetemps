<?php
//*-*-*-*-* Comments/Notes *-*-*-*-*//
// settings.php
// This page is to Update the settings that control the alerts and update and add cell numbers and emails that alerts can be sent to.
// Created October 6, 2023
//
//	*Update Log
//		- 10/07/2023 - added css for text box font sizes. body font size, <li> widths
//      - 10/07/2023 - added the option to update and add cell and email
//      - 10/09/2023 - added encrypt decrypt of the get variables so variables are not exposed
//      - 10/10/2023 - removed the way these variables were being encrypted and went with more basic encoding
//      - 10/10/2023 - cell and email can now be added and updated 
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//
require_once('inc/head.php');

?>
<div class="container-fluid mt-5 border-0">
<?php
if (!empty($_GET))
    {
        $_GET['s'] = base64_decode($_GET['s']);
        $_GET['d'] = base64_decode($_GET['d']);
    }

//*-*-*-*-* Start Post ID To Edit Setting *-*-*-*-*//
if (isset($_POST['update_value']))
    {
        $id = base64_decode($_POST['id']);
        $value = $_POST['value'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $text_display = $_POST['text_display'];
        $query = "UPDATE `settings` SET value = \"$value\" where id = $id";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$text_display." Updated</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Updated; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post ID To Edit Setting *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post ID To Edit Cell *-*-*-*-*//
if (isset($_POST['update_cell']))
    {
        $id = base64_decode($_POST['id']);
        $cell = $_POST['cell'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $name = $_POST['name'];
        $query = "UPDATE `alert_text` SET cell = \"$cell\", name = \"$name\" where id = $id";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$name." Updated</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Updated; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post ID To Edit Cell *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post ID To Edit Email *-*-*-*-*//
if (isset($_POST['update_email']))
    {
        $id = base64_decode($_POST['id']);
        $email = $_POST['email'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $name = $_POST['name'];
        $query = "UPDATE `alert_email` SET email = \"$email\", name = \"$name\" where id = $id";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$name." Updated</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Updated; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post ID To Edit Email *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post Add Cell *-*-*-*-*//
if (isset($_POST['add_cell']))
    {
        $cell = $_POST['cell'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $name = $_POST['name'];
        $id = 0;
        $query = "INSERT into `alert_text` (id, cell, name)
        VALUES ($id, \"$cell\", \"$name\")";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$name." Added</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Added; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post Add Cell *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post Add Email *-*-*-*-*//
if (isset($_POST['add_email']))
    {
        $email = $_POST['email'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $name = $_POST['name'];
        $id = 0;
        $query = "INSERT into `alert_email` (id, email, name)
        VALUES ($id, \"$email\", \"$name\")";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$name." Added</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Added; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post Add Email *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get ID To Edit Setting *-*-*-*-*//
if (isset($_GET['s']) == 'set')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        $result = mysqli_query($conn, "SELECT * FROM `settings` where id=$id");
        $myrow = mysqli_fetch_assoc($result);
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="id" value=<?php echo base64_encode($myrow['id']); ?>>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <input type="hidden" name="text_display" value="<?php echo $myrow['text_display']; ?>">
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0"><?php echo $myrow['text_display']?></li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="value" name="value" value="<?php echo $myrow['value']; ?>" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="update_value" class="btn btn-dark">Update</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get ID To Edit Setting *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Cell Numbers to Edit *-*-*-*-*//
if (isset($_GET['s']) == 'cell')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        $result = mysqli_query($conn, "SELECT * FROM `alert_text` where id=$id");
        $myrow = mysqli_fetch_assoc($result);
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="id" value=<?php echo base64_encode($myrow['id']); ?>>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="cell" name="cell" value="<?php echo $myrow['cell']; ?>" ></li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="name" name="name" value="<?php echo $myrow['name']; ?>" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="update_cell" class="btn btn-dark">Update</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Cell Numbers to Edit *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Email to Edit *-*-*-*-*//
if (isset($_GET['s']) == 'email')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        $result = mysqli_query($conn, "SELECT * FROM `alert_email` where id=$id");
        $myrow = mysqli_fetch_assoc($result);
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="id" value=<?php echo base64_encode($myrow['id']); ?>>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="email" name="email" value="<?php echo $myrow['email']; ?>" ></li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="name" name="name" value="<?php echo $myrow['name']; ?>" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="update_email" class="btn btn-dark">Update</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Email to Edit *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Cell Numbers to Add *-*-*-*-*//
if (isset($_GET['s']) == 'addcell')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0">Cell</li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="cell" name="cell" value="" ></li>
                <li class="list-group-item mb-0">Name</li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="name" name="name" value="" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="add_cell" class="btn btn-dark">Add</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Cell Numbers to Add *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Email to Add *-*-*-*-*//
if (isset($_GET['s']) == 'addemail')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0">Email Address</li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="email" name="email" value="" ></li>
                <li class="list-group-item mb-0">Name</li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="name" name="name" value="" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="add_email" class="btn btn-dark">Add</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Email to Add *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post ID To Edit Sensor *-*-*-*-*//
if (isset($_POST['update_sensor']))
    {
        $id = base64_decode($_POST['id']);
        $sensor = $_POST['sensor'];
        $notes = $_POST['notes'];
        $display = $_POST['display'];
        if ($display == "on")
            {
                $display = "On";
            }
        else
            {
                $display = "Off";
            }
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $romid = $_POST['romid'];
        $romid = base64_decode($romid);
        $query = "UPDATE `sensors` SET web_location = \"$sensor\", display=\"$display\", notes=\"$notes\" where sid = $id";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$romid." Updated</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Updated; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End Post ID To Edit Sensor *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Sensor to Edit *-*-*-*-*//
if (isset($_GET['s']) == 'sensor')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        $result = mysqli_query($conn, "SELECT * FROM `sensors` where sid=$id");
        $myrow = mysqli_fetch_assoc($result);
        if ($myrow['display'] == "On")
            {
                $display = "checked";
            }
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="id" value=<?php echo base64_encode($myrow['sid']); ?>>
            <input type="hidden" name="romid" value=<?php echo base64_encode($myrow['romid']); ?>>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0"><?php echo $myrow['romid']?></li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="sensor" name="sensor" value="<?php echo $myrow['web_location']; ?>" ></li>
                <li class="list-group-item mb-0"><div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" name="display" id="display" <?php echo $display; ?>>
                    <label class="form-check-label" for="display">Display?</label>
                </div></li>
                <li class="list-group-item mb-0">Notes</li>
                <li class="list-group-item mb-0 text-box"><input type="text" class="form-control" id="notes" name="notes" value="<?php echo $myrow['notes']; ?>" ></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="update_sensor" class="btn btn-dark">Update</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Sensor to Edit *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Post Sensor to Delete *-*-*-*-*//
if (isset($_POST['delete_sensor']))
    {
        $id = base64_decode($_POST['id']);
        $sensor = $_POST['sensor'];
        $notes = $_POST['notes'];
        $rurl = $_POST['rurl'];
        $rurl = base64_decode($rurl);
        $romid = $_POST['romid'];
        $romid = base64_decode($romid);
        $query = "DELETE FROM `sensors` WHERE sid = $id";
        $result = mysqli_query($conn, $query);

        ?>
        <div class="card container-card border-0">
		<div class="card-body container-card-body mx-auto border-top-0">
        <?php echo "<p><strong>".$romid." / ".$sensor." Deleted</strong></p>";
        ?>
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="card-text"><br>Deleted; Returning to settings page.</p>
        <div id="countdown"></div>

        <script type="text/javascript">
            var timeleft = 3;
            var downloadTimer = setInterval(function()
                {
                    if (timeleft <= 0)
                        {
                            clearInterval(downloadTimer);
                            document.getElementById("countdown").innerHTML = "Finished";
                        }
                    else 
                        {
                            document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
                        }
                    timeleft -= 1;
                }, 1000);
        </script>        
        <script>
            setTimeout(function()
                {
                    window.location.replace("<?php echo $rurl; ?>");
                }, 4000);
        </script>
        <?php
        exit();
    }
//*-*-*-*-* End POST Sensor to Delete *-*-*-*-*//

//######################################################

//*-*-*-*-* Start Get Sensor to Delete *-*-*-*-*//
if (isset($_GET['d']) == 'sensor')
    {
        $id = base64_decode($_GET['id']);;
        $rurl = $_GET['rurl'];
        $result = mysqli_query($conn, "SELECT * FROM `sensors` where sid=$id");
        $myrow = mysqli_fetch_assoc($result);
        ?>
        <form enctype="multipart/form-data" class="needs-validation mt-3" method="post" name="edit_form" novalidate>
            <input type="hidden" name="id" value=<?php echo base64_encode($myrow['sid']); ?>>
            <input type="hidden" name="romid" value=<?php echo base64_encode($myrow['romid']); ?>>
            <input type="hidden" name="rurl" value=<?php echo $rurl; ?>>
            <ul class="list-group list-group-flush w-50 mt-3 border-0 mx-auto">
                <li class="list-group-item mb-0 text-danger">Are you sure you want to delete this sensor?</li>
                <li class="list-group-item mb-0"><?php echo $myrow['romid']?></li>
                <li class="list-group-item mb-0 text-box"><?php echo $myrow['web_location']; ?></li>
                <li class="list-group-item mb-0">Notes</li>
                <li class="list-group-item mb-0 text-box"><?php echo $myrow['notes']; ?></li>
                <li class="list-group-item mb-0 mt-3"><button type="submit" name="delete_sensor" class="btn btn-danger">Delete</button></li>
            </ul>
        </form>
        <?php
        exit();
    }
//*-*-*-*-* End Get Sensor to Delete *-*-*-*-*//

//######################################################

//*-*-*-*-* Start loading Settings Options *-*-*-*-*//
$result = mysqli_query($conn, "SELECT * FROM `settings`");
$myrow = mysqli_fetch_assoc($result);
//$edit_icon = "<i class=\"bi bi-pencil-fill text-warning\" alt=\"Edit\" style='font-size: 16px;'></i></a>";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
    $rurl = "https://";   
else  
    $rurl = "http://";   
$rurl.= $_SERVER['HTTP_HOST'];   
$rurl.= $_SERVER['REQUEST_URI'];
$rurl = base64_encode($rurl);
$set_var = base64_encode('set');
do {
    $id = base64_encode($myrow['id']);
    $edit_icon = "<a href=settings.php?s=$set_var&id=$id&rurl=$rurl><i class=\"bi bi-pencil-fill text-dark edit-pencil\" alt=\"Edit\"></i></a>";
    ?>
    <ul class="list-group list-group-horizontal justify-content-center">
    <li class="list-group-item mb-2 border-0 border-bottom border-top border-start tool-tip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $myrow['tooltip']?>"><i class="bi bi-info-circle"></i></li>
    <li class="list-group-item mb-2 border-0 border-bottom border-top text-display"><?php echo $myrow['text_display'] ?></li>
    <li class="list-group-item mb-2 border-0 border-bottom border-top value"><?php echo $myrow['value'].$myrow['value_descriptor'] ?></li>
    <li class="list-group-item mb-2 border-0 border-bottom border-top border-end edit-icon"><?php echo $edit_icon ?></li>
    </ul>
    <?php
} while ($myrow = mysqli_fetch_assoc($result));

//Load Sensors
$result = mysqli_query($conn, "SELECT * FROM `sensors`");
$myrow = mysqli_fetch_assoc($result);
echo "<p class=\"text-center mt-3\">Sensors";
$set_var = base64_encode('sensor');
do {
    $id = base64_encode($myrow['sid']);
    $edit_icon = "<a href=settings.php?s=$set_var&id=$id&rurl=$rurl><i class=\"bi bi-pencil-fill text-dark\" alt=\"Edit\" style='font-size: 16px;'></i></a>";
    $del_icon = "<a href=settings.php?d=$set_var&id=$id&rurl=$rurl><i class=\"bi bi-x-lg text-danger\" alt=\"Delete\" style='font-size: 16px;'></i></a>"
    ?>
    <ul class="list-group list-group-horizontal justify-content-center">
    <li class="list-group-item mb-0 border-0 border-start border-top sensor-romid"><?php echo $myrow['romid'] ?></li>
    <li class="list-group-item mb-0 border-0 border-top sensor-location"><?php echo $myrow['web_location'] ?></li>
    <li class="list-group-item mb-0 border-0 border-top border-end edit-icon"><?php echo $edit_icon." ".$del_icon ?></li>
    </ul>
    <ul class="list-group list-group-horizontal justify-content-center">
    <li class="list-group-item mb-2 border-0 border-start border-bottom border-end sensor-note"><?php echo "<small>".$myrow['notes']."</small>" ?></li>
    </ul>
    <?php
} while ($myrow = mysqli_fetch_assoc($result));
$set_var = base64_encode('addcell');
?>
<ul class="list-group list-group-horizontal justify-content-center">
<li class="list-group-item mb-2 border-0 border-start border-bottom border-top border-end add-buttonz text-center"><a href="settings.php?s=<?php echo $set_var ?>&rurl=<?php echo $rurl ?>"><button type="button" class="btn btn-primary">Add Sensor</button></a></li>
</ul>
<?php

//Load Cell Numbers
// $result = mysqli_query($conn, "SELECT * FROM `alert_text`");
// $myrow = mysqli_fetch_assoc($result);
// echo "<p class=\"text-center mt-3\">Cell Numbers";
// $set_var = base64_encode('cell');
// do {
//     $id = base64_encode($myrow['id']);
//     $edit_icon = "<a href=settings.php?s=$set_var&id=$id&rurl=$rurl><i class=\"bi bi-pencil-fill text-dark\" alt=\"Edit\" style='font-size: 16px;'></i></a>";
//     ?>
<!-- //     <ul class="list-group list-group-horizontal justify-content-center">
//     <li class="list-group-item mb-2 border-0 border-start border-bottom border-top cell-display"><?php echo $myrow['cell'] ?></li>
//     <li class="list-group-item mb-2 border-0 border-bottom border-top cell-name"><?php echo $myrow['name'] ?></li>
//     <li class="list-group-item mb-2 border-0 border-bottom border-top border-end edit-icon"><?php echo $edit_icon ?></li>
//     </ul> -->
//     <?php
// } while ($myrow = mysqli_fetch_assoc($result));
// $set_var = base64_encode('addcell');
// ?>
<!-- // <ul class="list-group list-group-horizontal justify-content-center">
// <li class="list-group-item mb-2 border-0 border-start border-bottom border-top border-end add-buttonz text-center"><a href="settings.php?s=<?php echo $set_var ?>&rurl=<?php echo $rurl ?>"><button type="button" class="btn btn-primary">Add Cell</button></a></li>
// </ul> -->
<?php

//Load Emails
// $result = mysqli_query($conn, "SELECT * FROM `alert_email`");
// $myrow = mysqli_fetch_assoc($result);
// echo "<p class=\"text-center mt-3\">Emails";
// $set_var = base64_encode('email');
// do {
//     $id = base64_encode($myrow['id']);
//     $edit_icon = "<a href=settings.php?s=$set_var&id=$id&rurl=$rurl><i class=\"bi bi-pencil-fill text-dark\" alt=\"Edit\" style='font-size: 16px;'></i></a>";
    ?>
    <!-- <ul class="list-group list-group-horizontal justify-content-center">
    <li class="list-group-item mb-2 border-0 border-start border-bottom border-top email-display"><?php echo $myrow['email'] ?></li>
    <li class="list-group-item mb-2 border-0 border-bottom border-top email-name"><?php echo $myrow['name'] ?></li>
    <li class="list-group-item mb-2 border-0 border-bottom border-top border-end edit-icon"><?php echo $edit_icon ?></li>
    </ul> -->
    <?php
// } while ($myrow = mysqli_fetch_assoc($result));
// $set_var = base64_encode('addemail');
?>
<!-- <ul class="list-group list-group-horizontal justify-content-center">
<li class="list-group-item mb-2 border-0 border-start border-bottom border-top border-end add-buttonz text-center"><a href="settings.php?s=<?php echo $set_var ?>&rurl=<?php echo $rurl ?>"><button type="button" class="btn btn-primary">Add Email</button></a></li>
</ul> -->
<?php

echo "</div>";
//*-*-*-*-* End loading Settings Options *-*-*-*-*//

//######################################################
?>
<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<!-- Is the PYTHON reading the sms alert from the settings table whether to send a text or not? -->
<!-- Need to add email alerts to the python alert code as well -->
<!-- Add temp buffer to record in python code so it is like that in the table - add buffer to all temps -->
<!-- Add a new column to the table to show what the temp buffer was at that time -->
<!-- Update code to remove the if trigger sensor code - since all will have the buffer added -->
<!-- *DONE - Fix the code the sets the trend - need to select the last two records and then see what the trend is -->
<!-- Add Sensor -->
<!-- Delete Cell -->
<!-- Delete Email -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
