<?php
 include_once   'partials/connecting.php';
 $stad2=$_GET["id_stadion"];
 $druh2=$_GET["id_druh_kurzu"];
    $stadion=$stad2[7];
    $druh_kurzu=$druh2[10];
    echo '<div class="pas1">
      <div class="select_kurz">';
      echo'  <h2>Vyberte dátum kurzu</h2> ';
        $vypis_kurzov="select * from kurz where stadion_id=$stadion and druh_kurzu=$druh_kurzu and zapnuty=1";
        $result_vypis_kurzov = $databaza->query($vypis_kurzov);
       //-----   zisti ci je kurz na stadione volny      ----  //
        if ($result_vypis_kurzov->num_rows>0) {
            while($row_kurz = $result_vypis_kurzov->fetch_assoc()) {
              
                for ($i=1; $i < 5; $i++) { 
                  if ($row_kurz[time.$i]) {
                    echo '<div class="btn"><input id="id_'.$row_kurz[id].'" type="button" value="'.$row_kurz[datum];
                    echo ' sa začína o '.date("H:i",strtotime($row_kurz[time.$i])).'"></div>';};
                    //    echo '<div class="btn"><input id="datu_kurzu_'.date("d-m-Y", strtotime($row_kurz[datum])).'_'.date("H-i",strtotime($row_kurz[time.$i])).'" type="button" value="'.$row_kurz[datum];
                    //    echo ' sa začína o '.date("H:i",strtotime($row_kurz[time.$i])).'"></div>';};
               
                  };
            };
        } else{
          echo '<div><p>Zrejme nieje volný žiadny kurz!</p></div>';
        }
       
    echo '</div></div>';
    ?>