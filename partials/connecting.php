<?php
// site url

$site_url="http://www.localhost/newpiruetka/";

$color=array('#F2D8A2','#FCC5A9','#E6A5AF','#E9A9FC','#837CF4');
$color2=array('#F5F44D','#A2E3F2','#C3A9FC','#E6A5AF','#FCD9A9');

$user = 'root';
$password = 'root';
$db = 'inventory';
$host = 'localhost';
$port = 3306;
$databaza = mysqli_connect($host,$user,$password,piruetka);
// Create connection on site;
/*$databaza = mysqli_connect("mysql80.websupport.sk", "PiruData1", "heslo1234P", "piruetka", 3314);*/


// Check connection
if (! $databaza) {die("Connection failed: " . mysqli_connect_error());} else {};



$sql = "select * FROM stadion join kurz on stadion_id = stadion.stadi_id  join druh on druh_id = druh_kurzu order by id";
$result = $databaza->query($sql);

$sqlstadion = "select * FROM stadion";
$result_stadion = $databaza->query($sqlstadion);

$sqldruh = "select * FROM druh";
$result_druh = $databaza->query($sqldruh);

$sql_platba= "SELECT * FROM druh  join platba ON platba_druh=druh_id JOIN stadion ON platba_stadion=stadi_id";
$result_platba= $databaza->query($sql_platba);

$sql_cennik= "SELECT * FROM cennik join stadion ON stadi_id=cennik.stadion_id join druh ON druh_id=cennik.druh_kurzu ORDER BY id_cennik";
$result_cennik= $databaza->query($sql_cennik);


?>