<?php
include '../partials/connecting.php';
include'../partials/header.php';

$sql = "select * from platba join stadion on stadion.stadi_id=platba_stadion join druh on druh.druh_id=platba_druh order by platba_stadion,platba_druh";
$result_platba = $databaza->query($sql);
$sqlstadion = "select * FROM stadion ORDER BY stadi_id";
$result_stadion = $databaza->query($sqlstadion);
$sqldruh = "select * FROM druh";
$result_druh = $databaza->query($sqldruh);
$a=0;while($row_stadion = $result_stadion->fetch_assoc()) {$a++;$stadion[$a]=$row_stadion[stadion];};
$a=0;while($row_druh = $result_druh->fetch_assoc()) {$a++;$druh[$a]=$row_druh[nazov];};


echo('<h1>Editovanie platieb</h1>');


    if ($result_platba->num_rows > 0) {
        echo('<table><thead><tr><th>Delete</th><th>Update</th><th>Id</th><th>Štadión</th><th>Druh</th><th>Hotovosť</th><th>Účet</th></tr></thead>
        <tbody id="hlavnatabulka">');
        $a=0;
        while($row_platba = $result_platba->fetch_assoc()) {
            $a++;
            echo('<tr>
            <td colspan="7">
                <form id="platba-edit'.$row_platba[platba_id].'" action="platba-edit.php/" method="get">

                <table>
                    <tr>
                        <td><button type="submit" class="delete-platba'.$a.'" id="delete-platba'.$row_platba[platba_id].'" value="submit">Delete</button></td>

                        <td><button type="submit" class="platba-edit'.$a.'" value="submit">Update</button></td>
                        
                        <td><input type="text" class="input_id" id="check_id'.$row_platba[platba_id].'" name="id" value="'.$row_platba[platba_id].'"></td>
                        <td>'.$stadion[($row_platba[platba_stadion])].'</td>
                        <td>'.$druh[($row_platba[platba_druh])].'</td>
                        ');
                        if($row_platba[hotovost]==1){
                            echo('<td><input type="checkbox" id="platba_hotovost'.$row_platba[platba_id].'_'.$row_platba[hotovost].'" name="hotovost" checked></td>');
                            } else {
                            echo ('<td><input type="checkbox" id="platba_hotovost'.$row_platba[platba_id].'_'.$row_platba[hotovost].'" name="hotovost"></td>');
                        };
                        if($row_platba[ucet]==1){
                            echo('<td><input type="checkbox" id="platba_ucet'.$row_platba[platba_id].'_'.$row_platba[ucet].'" name="ucet" checked></td>');
                            } else {
                            echo ('<td><input type="checkbox" id="platba_ucet'.$row_platba[platba_id].'_'.$row_platba[ucet].'" name="ucet"></td>');
                        };
                        echo('
                    </tr>
                </table>
                </form>
            </dr>
        </tr>');
        };
        echo('</tbody>');
    } else {echo('nie sme pripojeny');};

    //----------------------------------------nova platba --------------------------------------//
    echo('<tfoot>
    <tr id="uploadd">
   
        <td colspan="7">
            <form id="upload-platba" action="platba-upload.php/" method="get">
            <table>
            <tr>
                <td><button type="submit" id="" value="submit">Upload</button></td>
                <td></td>
                <td>new_id</td>
                <td><select name="stadion">'); // ---------- zvol stadion
                $result_stadion = $databaza->query($sqlstadion);
                while($row_stadion = $result_stadion->fetch_assoc()) {
                    echo ('<option value="'.$row_stadion[stadi_id].'">'.$row_stadion[stadion].'</option>');
                };
                echo ('</select></td>
                <td><select name="druh">'); // ---------- zvol druhu kurzu
                $result_druh = $databaza->query($sqldruh);
                while($row_druh = $result_druh->fetch_assoc()) {
                    echo ('<option value="'.$row_druh[druh_id].'">'.$row_druh[nazov].'</option>');
                };
                echo ('</select></td>
                <td><input type="checkbox" id="hotovost" name="hotovost"></td>
                <td><input type="checkbox" id="ucet" name="ucet"></td>
        </tr>
                </table>
                </form>
        
            </td>
    </tr>');
echo('</tfoot></table>');
include'../partials/footer.php';

?>
<div id="demo"></div>
<script src='../js/editplatba.js'></script>

