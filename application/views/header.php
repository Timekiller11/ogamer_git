<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Legends Ogame Tool</title>
	<script src="<?php echo asset_url(); ?>js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/navigationjs"></script>
	 
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/navigation.css">
</head>
	<body>
		<nav id="nav-main">
			<ul>
				<li><a href="/">Home</a></li>
				<li><a href="/speed_calculator">Speed Calculator</a></li>
				<li><a href="/blind_lanx">Blind Lanx</a></li>
				<li><a href="/help_guides">Guides</a></li>
				<li><a href="/fleet_composition">Fleet composition</a></li>
			</ul>
		</nav>
		<div id="nav-trigger">
			<span>Menu</span>
		</div>
		<nav id="nav-mobile"></nav>
		