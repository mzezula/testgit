<?php
 include '../partials/connecting.php';

$hotovost=$_GET["hotovost"];
if ($hotovost){$hotovost=1;} else {$hotovost=0;};
$ucet=$_GET["ucet"];
if ($ucet){$ucet=1;} else {$ucet=0;};

$stadi_id=$_GET["stadion"];
$druh=$_GET["druh"];

$sql=('insert into platba (platba_stadion, platba_druh, hotovost, ucet) values ('.$stadi_id.','.$druh.','.$hotovost.','.$ucet.')');
//echo ('<br>$sql:'.$sql);

if ($databaza->query($sql) === TRUE) {
    $sql=('SELECT platba_id FROM platba ORDER BY platba_id DESC limit 1');
    $last_id = $databaza->query($sql);
    while($row_id = $last_id->fetch_assoc()) {$last=$row_id['platba_id'];};
    die($last);
    //echo " <p style='background: white;padding: 20px;margin:20px;'>Record updated successfully</p>";
} else {
echo "<p style='background: red;'>Error updating record:" . $databaza->error;echo"</p>";
};

$databaza->close();


?>