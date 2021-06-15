<?php
    include_once 'partials/connecting.php';
    $id=$_GET["id_druh_kurzu"];

    $id_druh_kurzu=substr("$id",-3);
    $sqluroven = "SELECT * FROM kurz WHERE id=$id_druh_kurzu";



    $result_uroven = $databaza->query($sqluroven);

    $uroven_id=array("vykon_dos1","vykon_dos2","vykon_det1","vykon_det2");
    $uroven_text=array("Dospelý začiatočník","Dospelý pokročilý","Dieťa začiatočník","Dieťa pokročilý");
    
    echo '<div class="pas1">
        <div class="select_druh">';
    
          
    while($row = $result_uroven->fetch_assoc()) {
        
        while($row0 = $result_druh->fetch_assoc()) {
            if($row[druh_kurzu]==$row0[	druh_id])
                $maximal_ucastnikov=$row0[ucastnikov];
        };
        echo'  <h2>Vyberte si úroveň</h2><h2>(Pozor. Maximálny počet účastníkov je:'.$maximal_ucastnikov.')</h2> ';
        echo '<div class="tab1">';
            for ($i=0; $i < count($uroven_id) ; $i++) { 
               
                if($row[$uroven_id[$i]]=='1'){ 
                    echo '<div class="uroven">';
                    echo '<div class="btn vykon'.$i.'"><input id="'.$uroven_id[$i].'" type="button" value="'.$uroven_text[$i].'"></div>';
                    echo('<div class="urovenvykon '.$uroven_id[$i].'"><form><label for="'.$uroven_text[$i].'">Zvol počet účastníkov</label>
                    <select id="'.$uroven_id[$i].'1" name="'.$uroven_id[$i].'">');
                    
                    for($b=0;$b< $maximal_ucastnikov+1;$b++){
                        echo('<option value="'.$b.'">&nbsp;&nbsp;'.$b.' </option>');
                    };
                    echo('</select></form></div>');
                echo'</div>';};
                
            };
        echo'</div>';
   };

    echo'</div></div>';

?>