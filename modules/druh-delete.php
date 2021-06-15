<?php
    include '../partials/connecting.php';

    $sql="DELETE FROM druh WHERE druh_id='$_GET[id]'";
    
    
    if ($databaza->query($sql) === TRUE) {
        echo($sql);
      } else {
      echo "<p style='background: red;'>Error delete record:" . $databaza->error;echo"</p>";
      };
      $databaza->close();
      
  
  ?>