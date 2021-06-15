<?php

include '../partials/connecting.php';
include'../partials/header.php';
$sql=('SELECT * FROM druh');
$result_druh = $databaza->query($sql);

echo('<table>
<thead><tr>
    <th class="btn">DELETE</th>
    <th class="btn">Update</th>
    <th>Id</th>
    <th>Názov</th>
    <th>Info</th>
    <th>Poradie</th>
    <th>Tabulka</th>
    <th>Ucastnikov</th>
</tr></thead>
<tbody id="hlavnatabulka"><tr><td colspan="8">');
$a=0;
while($row = $result_druh->fetch_assoc()) {
    $a++;
    echo('
    <form id="druh-edit-form'.$row[druh_id].'" action="druh-edit.php/" method="get">
    <table><tr>
            <td class="btn"><button type="submit" class="druh-delete'.$a.'" id="druh-delete'.$row[druh_id].'" value="submit">Delete '.$row[druh_id].'</button></td>
            <td class="btn"><button type="submit" class="druh-edit'.$a.'" id="druh-edit'.$row[druh_id].'" value="submit">Update</button></td>
            <td><input type="number" class="input_id" id="check_id'.$row[druh_id].'" name="id" value="'.$row[druh_id].'" readonly></td>
            <td><input type="text" class="input_id" id="check_name'.$a.'" name="nazov" value="'.$row[nazov].'"></td>
            <td><input type="text" class="input_id" id="check_info'.$a.'" name="info" value="'.$row[info_druh].'"></td>
            <td><input type="number" class="input_id" id="check_poradie'.$a.'" name="poradie" value="'.$row[druh_poradie].'"></td>
            <td><input type="number" class="input_id" id="check_tabulka'.$a.'" name="tabulka" value="'.$row[tabulka].'"></td>
            <td><input type="number" class="input_id" id="check_ucastnikov'.$a.'" name="ucastnikov" value="'.$row[ucastnikov].'"></td>
        </tr></table>
        </form>
    ');
};
echo('</td></tr></tbody>
<tfoot> <td colspan="8"><form id="druh-upload" action="druh-upload.php/" method="get">
        <table><tr>
        <td class="btn"></td>
        <td class="btn"><button type="submit" class="druh-upload'.$a.'" value="submit">Upload</button></td>
        <td><input type="number" class="input_id" id="id_upload'.$row[druh_id].'" name="id" value="'.$row[druh_id].'"></td>
        <td><input type="text" class="input_id" id="nazov_upload'.$row[nazov].'" name="nazov" value="'.$row[nazov].'" required></td>
        <td><input type="text" class="input_id" id="info_upload'.$row[info_druh].'" name="info_upload" value="'.$row[info_druh].'"></td>
        <td><input type="number" class="input_id" id="poradie_upload'.$row[druh_poradie].'" name="poradie_upload" value="'.$row[druh_poradie].'" required></td>
        <td><input type="number" class="input_id" id="tabulka_upload'.$row[druh_tabulka].'" name="tabulka_upload" value="'.$row[tabulka].'" required></td>
        <td><input type="number" class="input_id" id="ucastnikov_upload'.$row[druh_ucastnikov].'" name="ucastnikov_upload" value="'.$row[ucastnikov].'" required></td>
        </tr></table></form>
        
        </td>
</tfoot>
</table>');


include'../partials/footer.php';
?>
<div id="demo"></div>
<script src='../js/editdruh.js'></script>