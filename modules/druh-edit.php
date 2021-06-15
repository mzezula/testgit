<?php
include '../partials/connecting.php';
echo('id: '.$_GET[id].' nazov: '.$_GET[nazov].' info:'.$_GET[info].' poradie:'.$_GET[poradie]);
$sql=('UPDATE druh SET nazov="'.$_GET[nazov].'", info_druh="'.$_GET[info].'", druh_poradie='.$_GET[poradie].', ucastnikov='.$_GET[ucastnikov].',tabulka='.$_GET[tabulka].' WHERE druh_id='.$_GET[id]);
echo('<br>');
echo('<br>'.$sql);
if ($databaza->query($sql) === TRUE) {
    $info=$sql;
    } else {
    die($info='NO_success');
    };

    $databaza->close();

?>