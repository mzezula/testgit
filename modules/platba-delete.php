<?php
    include '../partials/connecting.php';

    $platba_id=$_GET["id"];
    //echo ('stadion-id:'.$stadi_id.'<br>');
echo ('platba-id: '.$_GET["id"].'<br>');

$sql=('delete from platba where platba_id='.$platba_id);
echo $sql;

if ($databaza ->query($sql) === TRUE) {
echo " <p style='background: white;padding: 20px;margin:20px;'>Record delete'.$platba_id.' successfully</p>";
} else {
echo "<p style='background: red;'>Error delete record: platba_id='.$platba_id.'" . $databaza->error;echo"</p>";
};
echo '<br>';
$databaza->close();


?>