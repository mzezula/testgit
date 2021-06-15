<?php
    include '../partials/connecting.php';

$id=$_GET["id"];
$nazov=$_GET["nazov"];
$info=$_GET["info_upload"];
$poradie=$_GET["poradie_upload"];
$tabulka=$_GET["tabulka_upload"];
$ucastnikov=$_GET["ucastnikov_upload"];

echo('id: '.$id.' nazov : '.$nazov.' info: '.$info);

$sql = "INSERT INTO `druh` (`druh_id`, `nazov`, `info_druh`, `druh_poradie`, `tabulka`, `ucastnikov`) VALUES (NULL, '$nazov', '$info', '$poradie', '$tabulka', '$ucastnikov')";
echo('<br>'.$sql);
if ($databaza->query($sql) === TRUE) {
    // echo "New record created successfully";
    $sql=('SELECT druh_id FROM druh ORDER BY druh_id DESC limit 1');
    $last_id = $databaza->query($sql);
    while($row_id = $last_id->fetch_assoc()) {$last=$row_id['druh_id'];};
        die($last);
    } else {
    die($info='NO_success');
    }
    $last_id = $databaza->insert_id;
    $databaza->close();
?>

