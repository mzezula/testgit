<?php
include '../partials/connecting.php';
include '../partials/header.php';
$sqlstadion = "select * FROM stadion ORDER BY stadi_id";
if (!empty($databaza)) {
    $result_stadion = $databaza->query($sqlstadion);
}
$sqldruh = "select * FROM druh";
if (!empty($databaza)) {
    $result_druh = $databaza->query($sqldruh);
}
echo('<h1>Editovanie kurzov</h1>');
$sql = "select * FROM kurz where stadion_id=1";
$result = $databaza->query($sql);

$result_stadion = $databaza->query($sqlstadion);
// ----------------------------------  vyber stadiona ------------------------------- //
echo '<form id="edit-stadion" action="editkurz-table.php" method="get">';
echo "<label for='vyber_stadion'>Vyber štadión:</label><select name='vyber_stadion' id='vyber_stadion'><option value=''>Všetky štadióny</option>";
while ($row_stadion = $result_stadion->fetch_assoc()) {
    echo '<option value="' . $row_stadion[stadi_id] . '">' . $row_stadion[stadion] . '</option>';
};
echo ' </select>';

echo "<label for='vyber_kurz'>Vyber kurzu:</label><select name='vyber_kurz' id='vyber_kurz'><option value=''>Všetky kurzy</option>";
while ($row_druh = $result_druh->fetch_assoc()) {
    echo '<option value="' . $row_druh[druh_id] . '">' . $row_druh[nazov] . '</option>';
};
echo ' </select><input type="submit" value="Vybrať">
 </form>';


echo('<table id="hlavna_tabulka">');
if ($result->num_rows > 0) {
    // output data of each row
    $a = 0;
    echo '<thead><tr>';
    echo('
        <th class="rotate"><div><span title="Zmazanie riadku">X</span></div></th>
        <th class="rotate"><div><span title="Riadkovanie">Riadok</span></div></th>
        <th class="rotate"><div><span title="Unikátne id">ID</span></div></th>
        <th class="rotate"><div><span title="Štadión">Štadion</span></div></th>
        <th class="rotate"><div><span title="Dátum kurzu">Dátum</span></div></th>
        <th class="rotate"><div><span title="Druh kurzu">Druh</span></div></th>
        <th class="rotate"><div><span title="Spustenie kurzu">Zap</span></div></th>
        <th class="rotate"><div><span title="Zapnutie kurzu pre dospelých úroveň začiatočník">vdo1</span></div></th>
        <th class="rotate"><div><span title="Zapnutie kurzu pre dospelých úroveň pokročilí">vdo2</span></div></th>
        <th class="rotate"><div><span title="Zapnutie kurzu pre deti úroveň začiatočník">vde1</span></div></th>
        <th class="rotate"><div><span title="Zapnutie kurzu pre dospelých úroveň pokročilí">vde2</span></div></th>
        <th class="rotate"><div><span title="Čas kurzu 1">time1</span></div></th>
        <th class="rotate"><div><span title="Čas kurzu 2">time2</span></div></th>
        <th class="rotate"><div><span title="Čas kurzu 3">time3</span></div></th>
        <th class="rotate"><div><span title="Čas kurzu 4">time4</span></div></th>');
    echo '</tr></thead><tbody>';
    echo("<tr>");

    echo "
        <td><button id='ii100' type='button'>X</button></td>
        ";
    echo "
        <td><input id='zero00' class='input-edit' type='submit' value='" . $a . "'></td>
        <td><input style='width: 30px;text-align: center' type='text' name='id' value='00' readonly></td>
        <td><select name='stadion'><option value='Dubravka'>Dubravka</option></select></td>
        <td><input type='date'></td>
        <td><select name='druh'><option value='individualny'>individualny</option></select></td>
        <td><input type='checkbox'  name='zapnuty' value='1'></td>
        <td><input type='checkbox'  value='1'></td>
        <td><input type='checkbox'  value='1'></td>
        <td><input type='checkbox'  value='1'></td>
        <td><input type='checkbox'  value='1'></td>
        <td><input type='time' name='time1' value=''></td>
        <td><input type='time' name='time2' value=''></td>
        <td><input type='time' name='time3' value=''></td>
        <td><input type='time' name='time4' value=''></td>
        ";
    echo('</tr></tbody></table>');
    $a = 0;
    //echo "<div id='top-table'>";
    include('../modules/editkurz-table.php');

};

echo('</div>');


?>

<h2>Nový dátum</h2>
<div class="pull-right">
    <form id="edit-upload" action="edit-upload.php" method="get">
        <table id="new-table">
            <tr>
                <td>
                    <?php echo "<select name='stadion'> ";  // -------------------------------------- vypis stadiona
                            $result_stadion = $databaza->query($sqlstadion);

                        foreach ($result_stadion as $roww => $row_stadion) {
                            echo '<option value="' . $row_stadion[stadi_id] . '"';
                            if ($row[stadion_id] == $row_stadion[stadi_id]) {
                                echo ' selected="selected"';
                            }
                            echo ">" . $row_stadion[stadion] . "</option>";
                        }
                        echo ' </select></td>';
                    ?>
                   
                </td>
                <td>
                    <input type="date" id="datum" name="date">
                </td>
                <td>
                    <?php
                        echo"<select name='druh' style='background: " . ($color2[($row["stadion_id"])]) . "'>"; // ---------- vypis druhu kurzu
                            foreach ($result_druh as $roww => $row_druh) {
                            echo '<option value="' . $row_druh[druh_id] . '"';
                            if ($row[druh_kurzu] == $row_druh[druh_id]) {
                                echo ' selected="selected"';
                            }
                            echo ">" . $row_druh[nazov] . "</option>";
                        }
                    ?>
                </td>


                <td>
                    <input type="checkbox" id="zapnuty" name="zapnuty" value="1"><label for="zapnuty">zapnutie
                        kurzu</label><br>
                </td>
                <td>
                    <input type="checkbox" id="vykon_dos1" name="vykon_dos1" value="1"><label for="vykon_dos1">výkon
                        dospelý začiatočník</label>
                </td>
                <td>
                    <input type="checkbox" id="vykon_dos2" name="vykon_dos2" value="1"><label for="vykon_dos2">výkon
                        dospelý pokročilý</label>
                </td>
                <td>
                    <input type="checkbox" id="vykon_det1" name="vykon_det1" value="1"><label for="vykon_det1">výkon
                        deti začiatočník</label>
                </td>
                <td>
                    <input type="checkbox" id="vykon_det2" name="vykon_det2" value="1"><label for="vykon_det2">výkon
                        deti pokročilý</label>
                </td>
                <td>
                    <input type="time" id="time1" name="time1" value=""><label for="time1">Time1</label>
                </td>
                <td>
                    <input type="time" id="time2" name="time2" value=""><label for="time2">time2</label>
                </td>
                <td>
                    <input type="time" id="time3" name="time3" value=""><label for="time3">time3</label>
                </td>
                <td>
                    <input type="time" id="time4" name="time4" value=""><label for="time4">time4</label>
                </td>
            </tr>
        </table>
        <input type="submit" value="Odoslať">
    </form>
</div>
<div id="demo"></div>
<span class="counter" id="2"></span>
<?php
include '../partials/footer.php';

?>
<script src='../js/editkurz.js?v=1.3'></script>