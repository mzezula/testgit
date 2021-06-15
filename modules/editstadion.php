<?
include '../partials/connecting.php';
include'../partials/header.php';
?>


<h1>Editor štadiónov</h1>
<?

$sqlstadion = "select * FROM stadion ORDER BY stadi_id";
$result_stadion = $databaza->query($sqlstadion);
$new_row_stadion=0;
echo '
<table id="hlavnatabulka">
<thead><tr><td>delete</td><td>Update</td><td>stadi_id</td><td>Názov štadióna</td><td>Zapnutie štadióna</td><td>Štadión poradie</td></tr></thead>
<tbody>
    <tr>
        <td colspan="6">';
            while($row_stadion = $result_stadion->fetch_assoc()) {
            echo('

            <form id="edit-stadion'.$row_stadion[stadi_id].'"
                    action="stadion-update.php/"
                '.$row_stadion[stadi_id].'" method="get">
                <table>
                    <tr>
                        <td>
                            <button
                                    type="submit" id="delete-form'.$row_stadion[stadi_id].'" value="delete-form'.$row_stadion[stadi_id].'"">delete
                            </button>
                        </td>
                        <td>
                            <button
                                    type="submit" id="edit-form'.$row_stadion[stadi_id].'" value="submit">Update
                            </button>
                        </td>
                        <td><input type="number" name="stadi_id" value="'.$row_stadion[stadi_id].'" readonly></td>
                        <td>'.$row_stadion[stadion].'</td>
                        ');
                        if($row_stadion[stadion_onoff]==1){
                        echo('
                        <td>
                            <input type="checkbox"
                                id="stadion_onoff'.$row_stadion[stadi_id].'"
                                name="stadion_onoff" checked>
                        </td>

                        ');
                        }
                        else {
                        echo ('
                        <td><input type="checkbox" id="stadion_onoff'.$row_stadion[stadi_id].'"
                                name="stadion_onoff"></td>

                        ');}
                        echo('
                        <td>
                        <input type="number" name="stadion_poradie" value="'.$row_stadion[stadion_poradie].'">
                        </td>
                    </tr>
                    
                </table>
            </form>

            ');
   
            $new_row_stadion=$row_stadion[stadi_id]+1;
            };
            echo('
            </td></tr></tbody>');
            echo('<tfoot><tr><td colspan="6">
                <form id="upload-stadion" action="stadion-upload.php/" method="get">
                    <table>
                        <tr>
                        <td><button type="" value="">...
                        </button></td>
                            <td>
                                <button
                                        type="submit" value="submit">Upload
                                </button>
                            </td>
                            <td><input type="number" min="1" max="100" name="stadi_id" value="'.$new_row_stadion.'"
                            ></td>
                            <td><input type="text" name="stadion" value=""
                            ></td>
                            <td><input type="checkbox" id=stadion_id"'.$new_row_stadion.'" name="stadion_onoff"></td>
                            <td><input type="number" name="stadion_poradie" value=""
                            ></td>
                        </tr>
                    </table>
                </form>
            </td></tr></tfoot>
</table>
<div id="demo"></div>

<span class="counter" id="5"></span>
');
include'../partials/footer.php';
?>
<script src='../js/editstadion.js'></script>
