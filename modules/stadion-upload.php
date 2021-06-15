<?php
include '../partials/connecting.php';

$stadion_onoff=$_GET["stadion_onoff"];
if ($stadion_onoff=="on"){$stadion_onoff=1;} else {$stadion_onoff=0;};

$stadi_id=$_GET["stadi_id"];
$stadion_name=$_GET["stadion"];
$stadion_poradie=$_GET["stadion_poradie"];

echo('stadion_onoff='.$stadion_onoff. '<br>' );
echo('stadion='.$stadion_name.'<br>');
echo ('stadi_id='.$stadi_id.'<br>');

$sql=('insert into stadion (stadion,stadion_onoff,stadi_id,stadion_poradie) values ("'.$stadion_name.'",'.$stadion_onoff.','.$stadi_id.','.$stadion_poradie.')');
echo $sql;

if ($databaza->query($sql) === TRUE) {
echo " <p style='background: white;padding: 20px;margin:20px;'>Record updated successfully</p>";
} else {
echo "<p style='background: red;color=white;'>Error updating record:" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();


?>