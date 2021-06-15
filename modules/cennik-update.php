<?php
include"../partials/connecting.php";

$sql_last_id="SELECT MAX(id_cennik) as last_row FROM cennik"; //----- zisti posledne id --//
$result_last_id = $databaza->query($sql_last_id);
if ($result_last_id->num_rows > 0) {
    while($row = $result_last_id->fetch_assoc()) {
      $last_row= $row["last_row"]+1;  
    };
};

//--zisti ci je to posledne id alebo $_get --//
if ($_GET[id_cennik]){$id = $_GET[id_cennik];} else {$id=$last_row;};
if(!$id){echo 'niekde sa stala chyba';$id=0;};

$sql_cennik = "SELECT * FROM cennik join stadion ON stadi_id=cennik.stadion_id join druh ON druh_id=cennik.druh_kurzu WHERE id_cennik=$id";
$result_cennik = $databaza->query($sql_cennik);
   
$pocetriadkov=$result_cennik->num_rows;
if ($result_cennik->num_rows==0 ){
    $row_cennik[id_cennik]=$id;
    $row_cennik[stadion_id]=1;
    $row_cennik[druh_kurzu]=1;
    $row_cennik[pocet_clenov]=1;
    $row_cennik[cena] =0;
    riadok($id,$row_cennik,$result_druh,$result_stadion,$pocetriadkov);

};


foreach ($result_cennik as $row => $row_cennik) {
    riadok($id,$row_cennik,$result_druh,$result_stadion,$pocetriadkov);
};

function riadok($id,$row_cennik,$result_druh,$result_stadion,$pocetriadkov){

    echo '<table><tr><td><form class="update_row_cennik" id="form_id_'. $row_cennik[id_cennik] .'" action="cennik-update-row.php" method="get">
    <table>
    
         <tr>
             <td><input type="submit" value="update_id_' . $row_cennik[id_cennik] . '" id="id_' . $id . '"></td>
             <td><input type="number" name="id" value="' . $id . '"></td>
             <td><select name="stadion">';
    foreach ($result_stadion as $roww => $row_stadion) {//---------- vypis stadiona
        echo '<option value="' . $row_stadion[stadi_id] . '"';
        if ($row_cennik[stadion_id] == $row_stadion[stadi_id]) {
            echo ' selected="selected"';
        }
        echo '>' . $row_stadion[stadion] . '</option>';
    }
    echo '</select></td>
             <td><select name="druh">'; // ---------- vypis druhu kurzu
    foreach ($result_druh as $roww => $row_druh) {
        echo '<option value="' . $row_druh[druh_id] . '"';
        if ($row_cennik[druh_kurzu] == $row_druh[druh_id]) {
            echo 'selected="selected"';
        }
        echo '>' . $row_druh[nazov] . '</option>';
    }
    echo '</select></td>
            <td><select name="pocet">';
    for ($pocet = 0; $pocet <= 5; $pocet++) {
        echo '<option value="' . $pocet . '"';
        if ($row_cennik[pocet_clenov] == $pocet) {
            echo 'selected="selected>"';
        };
        echo '>' . $pocet . '</option>';
    };
    echo '</select></td>
             <td><input type="number" name="cena" value="' . $row_cennik[cena] . '"></input></td>
         </tr>
         
     </table>
 </form></td></tr></table>';
}