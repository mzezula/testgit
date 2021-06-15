<?php
include '../partials/connecting.php';

$hotovost=$_GET["hotovost"];
if ($hotovost){$hotovost=1;} else {$hotovost=0;};
$ucet=$_GET["ucet"];
if ($ucet){$ucet=1;} else {$ucet=0;};


$sql=('update platba set hotovost='.$hotovost.', ucet='.$ucet.' where platba_id='.$_GET["id"]);
echo $sql;

if ($databaza->query($sql) === TRUE) {
echo " <p style='background: white;padding: 20px;margin:20px;'>Record updated successfully</p>";
} else {
echo "<p style='background: red;'>Error updating record:" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();
?>