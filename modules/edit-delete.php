<?php

    include '../partials/connecting.php';
  $id=$_GET["id"];


 $sql = 'DELETE FROM kurz WHERE id="'.$id.'"';
 echo($sql);
  if ($databaza->query($sql) === TRUE) {
    echo " <p style='background: #112a11;'>Record deleted successfully</p>";
    } else {
    echo "<p style='background: red;'>Error delete record:" . $databaza->error;echo"</p>";
    };
    $databaza->close();

?>