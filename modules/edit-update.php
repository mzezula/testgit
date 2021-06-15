
<?php
include '../partials/connecting.php';

$sql = "select * FROM stadion";
$stadion = $databaza->query($sql);

/* zistenie  stadiona*/
$a=1;
$stadi = array();
while($row = $stadion->fetch_assoc()) {
echo $a."id: " . $row["id"]. " - Name: " . $row["stadion"]."<br>";
$stadi[$a]=$row["stadion"];$a++;

};


if ($_GET["vykon_dos1"]!=1) $_GET["vykon_dos1"]="0"; else $_GET["vykon_dos1"]='1';
if ($_GET["vykon_dos2"]!=1) $_GET["vykon_dos2"]="0"; else $_GET["vykon_dos2"]="1";
if ($_GET["vykon_det1"]!=1) $_GET["vykon_det1"]="0"; else $_GET["vykon_det1"]="1";
if ($_GET["vykon_det2"]!=1) $_GET["vykon_det2"]="0"; else $_get["vykon_det2"]="1";
if ($_GET["zapnuty"]!=1) $_GET["zapnuty"]="0"; else $_GET["zapnuty"]="1";
?>


<?php
$id=$_GET["id"];
$stad=$_GET["stadion"];
$datum=$_GET["datum"];
$zapnuty=$_GET["zapnuty"];

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

//echo '<b>-'.$_GET["time1"].'-</b>';


//echo 'id='.$id.' stadion: '.$stad.'datum:'.$datum.'zapnuty'.$zapnuty.'time1:'.$data_time1.'time2:'.$data_time2.'time3:'.$data_time3.'time4:'.$data_time4;

$sql = 'UPDATE kurz SET
stadion_id='.$stad.',
datum=(str_to_date("'.$datum.'","%Y-%m-%d")),
zapnuty='.$_GET["zapnuty"].',
vykon_dos1='.$_GET["vykon_dos1"].',
vykon_dos2='.$_GET["vykon_dos2"].',
vykon_det1='.$_GET["vykon_det1"].',
vykon_det2='.$_GET["vykon_det2"].',
druh_kurzu='.$_GET["druh"].',
time1='.$data_time1.' ,
time2='.$data_time2.' ,
time3='.$data_time3.' ,
time4='.$data_time4.'
WHERE id='.$id.'
';
echo($sql);
if ($databaza->query($sql) === TRUE) {
echo " <p style='background: green;'>Record updated successfully</p>";
} else {
echo "<p style='background: red;'>Error updating record:" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();

?>

