<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE){
  session_start();
}
?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>sgRNA Finder</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/tablebuilder.js"></script>
  <script src="js/particles.js"></script>
  <script src="js/biojs.js"></script>
  <script src="js/script.js"></script>
</head>
<body>

<a href="index.php" class="light-green-text">
    <header>
        <h4 class="center-align">sgRNA Finder</h4>
    </header>
</a>


<main id="particles-js">
<div id="body-content">
