<?php
include '../partials/connecting.php';
$sql_delete_cennik=('DELETE FROM cennik WHERE id_cennik='.$_GET[id_cennik]);
if ($databaza->query($sql_delete_cennik) === TRUE) {
    echo('delete-'.$_GET[id_cennik]);
} else {
    echo "<p style='background: red;'>Error delete record:" . $databaza->error;echo"</p>";
};
$databaza->close();
?>