<?php

include "functions.php";

function masterconnect(){

	global $dbcon;
	$dbcon = mysqli_connect('127.0.0.1', 'Ezreal', '209xs6v3wXPEOB70FNE7', 'adminpanel','12306') or die ('Database connection failed');
}

function loginconnect(){

	global $dbconL;
	$dbconL = mysqli_connect('127.0.0.1', 'Ezreal', '209xs6v3wXPEOB70FNE7', 'adminpanel','12306');
}

function Rconconnect(){

	global $rcon;
	$rcon = new \Nizarii\ArmaRConClass\ARC('127.0.0.1', 2301, '9l2zgKVXCj7zSQCWvXOI');
}

global $DBHost;
$DBHost = '127.0.0.1';
global $DBUser;
$DBUser = 'Ezreal';
global $DBPass;
$DBPass = '209xs6v3wXPEOB70FNE7';
global $DBName;
$DBName = 'adminpanel';

global $RconHost;
$RconHost = '127.0.0.1';
global $RconPort;
$RconPort = 2301;
global $RconPass;
$RconPass = '9l2zgKVXCj7zSQCWvXOI';

global $maxCop;
$maxCop = 9;
global $maxMedic;
$maxMedic = 6;
global $maxAdmin;
$maxAdmin = 3;
global $maxDonator;
$maxDonator = 7;

global $apiUser;
$apiUser = '11';
global $apiPass;
$apiPass = '1';
global $apiEnable;
$apiEnable = 0;

?>
