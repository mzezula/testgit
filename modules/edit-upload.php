<?php
include '../partials/connecting.php';
//include'../partials/header.php';

$sql = "select * FROM stadion";
$stadion = $databaza->query($sql);

/* zistenie  stadiona*/
$a=1;
$stadi = array();
while($row = $stadion->fetch_assoc()) {
//   echo $a."id: " . $row["id"]. " - Name: " . $row["stadion"]."<br>";
$stadi[$a]=$row["stadion"];$a++;
};
if ($_GET["zapnuty"]!=1) {$_GET["zapnuty"]=0;}
if ($_GET["vykon_dos1"]!=1) {$_GET["vykon_dos1"]=0;};
if ($_GET["vykon_dos2"]!=1) {$_GET["vykon_dos2"]=0;};
if ($_GET["vykon_det1"]!=1) {$_GET["vykon_det1"]=0;};
if ($_GET["vykon_det2"]!=1) {$_GET["vykon_det2"]=0;};

$stadi=$_GET['stadion'];
$nazov=$_GET['druh'];
$datum=$_GET['date'];
$date = new DateTime('2008-07-01T22:35:17.02');
$new_date_format = $date->format('Y-m-d');
$zapnuty=$_GET['zapnuty'];
$vykon_dos1=$_GET['vykon_dos1'];
$vykon_dos2=$_GET['vykon_dos2'];
$vykon_det1=$_GET['vykon_det1'];
$vykon_det2=$_GET['vykon_det2'];

if ($_GET["time1"]) {
$time1=$_GET["time1"];
$data_time1="$time1[0]$time1[1]$time1[3]$time1[4]00";
} else $data_time1="NULL";
if ($_GET["time2"]) {
$time2=$_GET["time2"];
$data_time2="$time2[0]$time2[1]$time2[3]$time2[4]00";
} else $data_time2="NULL";
if ($_GET["time3"]) {
$time3=$_GET["time3"];
$data_time3="$time3[0]$time3[1]$time3[3]$time3[4]00";
} else $data_time3="NULL";
if ($_GET["time4"]) {
$time4=$_GET["time4"];
$data_time4="$time4[0]$time4[1]$time4[3]$time4[4]00";
} else $data_time4="NULL";

$sql = "INSERT INTO `kurz` (`stadion_id`, `druh_kurzu`, `datum`, `zapnuty`, `vykon_dos1`, `vykon_dos2`, `vykon_det1`, `vykon_det2`,`time1`,`time2`,`time3`,`time4`)
VALUES ($stadi,$nazov,'$datum',$zapnuty,$vykon_dos1,$vykon_dos2,$vykon_det1,$vykon_det2,$data_time1,$data_time2,$data_time3,$data_time4)";

if ($databaza->query($sql) === TRUE) {
// echo "New record created successfully";
$sql=('SELECT id FROM kurz ORDER BY id DESC limit 1');
$last_id = $databaza->query($sql);
while($row_id = $last_id->fetch_assoc()) {$last=$row_id['id'];};

die($last);
} else {

die($last='NO_success');
}

$last_id = $databaza->insert_id;


$databaza->close();
?>
