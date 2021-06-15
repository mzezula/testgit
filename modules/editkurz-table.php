<?php
include '../partials/connecting.php';
echo'<section>';
$sqldruh = "select * FROM druh";
if (!empty($databaza)) {
    $result_druh = $databaza->query($sqldruh);
};
$sqlstadion = "select * FROM stadion ORDER BY stadi_id";
if (!empty($databaza)) {
    $result_stadion = $databaza->query($sqlstadion);
}
if($_GET["vyber_stadion"]){
    $idstadion=$_GET["vyber_stadion"];
    $sql = ("select * FROM kurz WHERE stadion_id=".$idstadion);}
else{$sql = ("select * FROM kurz where stadion_id");};

if($_GET["vyber_kurz"]){
    $druh_kurzu=$_GET["vyber_kurz"];
    $sql = $sql." AND druh_kurzu=".$druh_kurzu;};
echo $sql;
$result = $databaza->query($sql);

echo "<div id='top-table'>";

$a = 0;
foreach ($result as $roww => $row) {
    $a++;
    //---------------------------------------------Update ---------------------
    echo "
    <form id='edit-update" . $row["id"]. "' class='edit-update edit-update" . $row["id"] . "' action='edit-update.php/" . $row["id"] . "' method='get'>

        <table>
            <tr style='background: " . ($color[($row["stadion_id"])]) . "'>";

    //    -----------------------------------------Delete--------------------
    echo "
            <td><button id='delete-form" . $a . "' class='edit-delete delete-form" . $row["id"] . "' type='button'> " . $row["id"] . " X</button></td>";

    //  -------------------------------------------Data----------------------
    echo "
            <td><input id='input-edit" . $a . "' class='input-edit' type='submit' value='EDIT:" . $a . "'></td>
            <td><input style='width: 30px;text-align: center' type='text' name='id' value='" . $row["id"] . "' readonly></td>
            <td><select name='stadion'> ";  // -------------------------------------- vypis stadiona
    //  $result_stadion = $databaza->query($sqlstadion);

    foreach ($result_stadion as $roww => $row_stadion) {
        echo '<option value="' . $row_stadion[stadi_id] . '"';
        if ($row[stadion_id] == $row_stadion[stadi_id]) {
            echo ' selected="selected"';
        }
        echo ">" . $row_stadion[stadion] . "</option>";
    }
    echo " </select></td>
            <td><input type='date' name='datum' value='" . $row[datum] . "'></td>
            <td><select name='druh' style='background: " . ($color2[($row["stadion_id"])]) . "'>"; // ---------- vypis druhu kurzu
    //  $result_druh = $databaza->query($sqldruh);

    foreach ($result_druh as $roww => $row_druh) {
        echo '<option value="' . $row_druh[druh_id] . '"';
        if ($row[druh_kurzu] == $row_druh[druh_id]) {
            echo ' selected="selected"';
        }
        echo ">" . $row_druh[nazov] . "</option>";
    }
    echo " </select>
            </td>
            <td><input type='checkbox'  name='zapnuty' value='1' ";
    if ($row[zapnuty]) {
        echo 'checked ';
    }
    echo "></td>
            <td><input type='checkbox'  name='vykon_dos1' value ='1' ";
    if ($row[vykon_dos1]) {
        echo 'checked';
    }
    echo "></td>
            <td><input type='checkbox'  name='vykon_dos2' value='1' ";
    if ($row[vykon_dos2]) {
        echo 'checked';
    }
    echo "></td>
            <td><input type='checkbox'  name='vykon_det1' value='1' ";
    if ($row[vykon_det1]) {
        echo 'checked';
    }
    echo "></td>
            <td><input type='checkbox'  name='vykon_det2' value='1' ";
    if ($row[vykon_det2]) {
        echo 'checked';
    }
    echo "></td>
            <td><input type='time' name='time1' value='" . $row["time1"] . "'></td>
            <td><input type='time' name='time2' value='" . $row["time2"] . "'></td>
            <td><input type='time' name='time3' value='" . $row["time3"] . "'></td>
            <td><input type='time' name='time4' value='" . $row["time4"] . "'></td>
            ";
    echo('</tr>
        </table>
    </form>');
}


echo('</div>');
echo'</section>';
?>