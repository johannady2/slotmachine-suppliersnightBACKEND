<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Slot Machine</title>


  <!-- Custom styles for this template -->
  <link href="adminstyle.css" rel="stylesheet">


  </head>

<body>

	<header>
		<div class="header-content-container">
			<ul class="navigation">
				<li class="preferencesnav"><a href='index.php'>Preferences</a></li>
				<li class="logoutnav"><a href="logout.php">logout</a></li>

			</ul>
		</div>
	</header>
		<div class="container">
<?php include_once'connect.php';?>
<?php include_once 'functions.php' ?>
