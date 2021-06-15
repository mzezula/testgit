<?php
include '../partials/connecting.php';

$stadion_onoff=$_GET["stadion_onoff"];
if ($stadion_onoff=="true"){$stadion_onoff=1;} else {$stadion_onoff=0;};
$stadi_id=$_GET["stadi_id"];

$sql=('update stadion set stadion_onoff='.$stadion_onoff.' where stadi_id='.$stadi_id);
echo $sql;

if ($databaza->query($sql) === TRUE) {
echo " <p style='background: white;padding: 20px;margin:20px;'>Record updated successfully</p>";
} else {
echo "<p style='background: red;'>Error updating record:" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();


?>