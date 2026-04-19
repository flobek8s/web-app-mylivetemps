<?php
//*-*-*-*-* Comments/Notes *-*-*-*-*//
// This page controls the head of every page
// Created October 6, 2023
//
//	*Update Log
//		- 10/07/2023 - added css
//    - 10/31/2023 - add font change to the mylivetemps menu header (CSS)
//*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-//
require_once('db.php');
require_once('load_settings.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>myLiveTemps</title>
        <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
        <link rel="manifest" href="/icon/site.webmanifest">
        <!-- <link href="bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- <script src="bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" href="bootstrap-5.3.2/icons-1.11.0/bootstrap-icons.css"> -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="css/main.css?v="<?php time(); ?> rel="stylesheet">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" aria-label="Menu">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <!-- <span class="navbar-toggler-icon"></span> -->
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-thermometer-half" viewBox="0 0 16 16">
          <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z"/>
          <path d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z"/>
        </svg>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php"><font class="head1">my</font><font class="head2">LiveTemps</font></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="settings.php">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="alerts.php">Alerts</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>