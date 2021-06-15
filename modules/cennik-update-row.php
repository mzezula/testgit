<?php
include '../partials/connecting.php';

//echo('id: '.$_GET[id].' stadion: '.$_GET[stadion].' druh:'.$_GET[druh].' pocet: '.$_GET[pocet].' cena: '.$_GET[cena]);

$sql = ('UPDATE cennik SET stadion_id="' . $_GET[stadion] . '", druh_kurzu="' . $_GET[druh] . '", pocet_clenov="' . $_GET[pocet] . '",cena="' . $_GET[cena] . '" WHERE id_cennik=' . $_GET[id]);
$sql = ('INSERT INTO `cennik` VALUES ('.$_GET[id].','.$_GET[stadion].','. $_GET[druh] . ','. $_GET[pocet] . ','. $_GET[cena] . ') ON DUPLICATE KEY UPDATE id_cennik='.$_GET[id].', stadion_id="'.$_GET[stadion].'", druh_kurzu="'. $_GET[druh] . '", pocet_clenov="'. $_GET[pocet] . '",cena="'. $_GET[cena] . '"');
/*id_cennik	stadion_id	druh_kurzu	pocet_clenov	cena*/


if ($databaza->query($sql) === TRUE) {
    $info = $sql;
    echo '<table><tbody><tr>
        <td><form class="cennik-delete"  id="id_delete_' . $_GET[id] . '" action="cennik-delete.php" method="get">
            <input type="submit" value="X">
            <input type="text" name="id_cennik" value="' . $_GET[id] . '">
        </form></td>
        <td><form id="id_form_' . $_GET[id] . '" action="cennik-update.php" method="get">
            <input type="submit" value=" Edit ">
            <input type="text" name="id_cennik" value="' . $_GET[id] . '">
        </form></td>
        <td>';
    foreach ($result_stadion as $roww => $row_stadion) {//---------- vypis stadiona
        if ($_GET[stadion] == $row_stadion[stadi_id]) {
            echo $row_stadion[stadion];
        };
    };
    echo '</td>
        <td>';
    foreach ($result_druh as $roww => $row_druh) {
        if ($_GET[druh] == $row_druh[druh_id]) {
            echo $row_druh[nazov];
        };
    };
    echo '</td>
        <td>' . $_GET[pocet] . '</td>
        <td>cena: ' . $_GET[cena] . '</td>
        </td>
        </tr></tbody></table>';
} else {
    die($info = 'NO_success');
};

$databaza->close();

?>