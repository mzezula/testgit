<?php
include_once   'partials/connecting.php';
$stad2=$_GET["id_stadion"];
$stadion=$stad2[7];
echo '<div class="pas1">
  <div class="select_druh">';
  echo'  <h2>Vyberte druh kurzu</h2> ';
  while($row_druh = $result_druh->fetch_assoc()) {
    $vypis_kurzov="select * from kurz where stadion_id=$stadion and druh_kurzu=$row_druh[druh_id] and zapnuty=1";     
    $result_vypis_kurzov = $databaza->query($vypis_kurzov);
    if ($result_vypis_kurzov->num_rows > 0) {   //-----   zisti ci je kurz na stadione volny      ----  //
      echo '<div class="btn"><input id="druh-kurzu'.$row_druh[druh_id].'" type="button" value="'.$row_druh[nazov].'"></div>';
    } else{
    //  echo '<div class="btn-disabled"><input id="druh-kurzu'.$row_druh[druh_id].'" type="button" value="'.$row_druh[nazov].'" disabled></div>';
    }
  };
echo '</div></div>';
 ?>