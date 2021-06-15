<?php
    include '../partials/connecting.php';

    $stadi_id=$_GET["id"];
    //echo ('stadion-id:'.$stadi_id.'<br>');
echo ('stadion-id:'.$_GET["id"].'<br>');

$sql=('delete from stadion where stadi_id='.$stadi_id);
echo $sql;

if ($databaza ->query($sql) === TRUE) {
echo " <p style='background: white;padding: 20px;margin:20px;'>Record delete'.$stadi_id.' successfully</p>";
} else {
echo "<p style='background: red;'>Error delete record:" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();


?>