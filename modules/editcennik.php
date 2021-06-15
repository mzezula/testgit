<style>
  /*  li {
        float: left;
        width: 100px;
    }

    ul {
        display: inline-block;
        width: 100%;
    }
    */
</style>
<?php
include('../partials/header.php');
include('../partials/connecting.php');
echo'<table id="main-table">';

foreach ($result_cennik as $row => $row_cennik) {
    echo '<tr><td><table><tr>
        <td><form class="cennik-delete"  id="id_delete_' . $row_cennik[id_cennik] . '" action="cennik-delete.php" method="get">
            <input type="submit" value="X">
            <input type="text" name="id_cennik" value="' . $row_cennik[id_cennik] . '">
        </form></td>
        <td><form class="cennik-update" id="id_form_' . $row_cennik[id_cennik] . '" action="cennik-update.php" method="get">
            <input type="submit" value="Edit">
            <input type="text" name="id_cennik" value="' . $row_cennik[id_cennik] . '">
        </form></td>
        <td>' . $row_cennik[stadion] . '</td>
        <td>' . $row_cennik[nazov] . '</td>
        <td>' . $row_cennik[pocet_clenov] . '</td>
        <td>cena: ' . $row_cennik[cena] . '</td>
        </tr></table>
        </td></tr>';
    $last_row = $row_cennik[id_cennik] + 1;
};
echo '</table>
            <a id="new-row" href="#" >pridaj riadok</a>
     ';

include '../partials/footer.php';
?>

<script>
updaterow=$('.update_row_cennik')[0];
/*
    reload_update();
    reload_new_click();
    reload_delete();
    reloadHandlerRow();
    */

//    function reload_new_click(){//------------------------------vytvor novy riadok-------------------------------//
    $('#new-row').on('click', function (){

        var form = $(this);
        var req = $.ajax({
            url: "../modules/cennik-update.php",
            type: 'GET',
            data: form.serialize()
        });
        req.done(function (data) {
            $('#main-table').append(data).fadeIn(300);
            reloadHandlerRow();
        });
    });
 //   };

//function reload_delete() {
    $('.cennik-delete').on('submit', function (e) {//------------------------------cennik delete-------------------------------//
        e.preventDefault();

        thisid = $(this).attr('id').replace(/id_delete_/gi, '');
        console.log('id-delete-' + thisid);

        var form = $(this);
        var req = $.ajax({
            url: form.attr('action'),
            type: 'GET',
            data: form.serialize()
        });
        req.done(function (data) {
            $('#id_delete_' + thisid).parent().parent().parent().parent().html(data).fadeIn(300);
        });
    });
//};
 //   function reload_update() {//------------------------------cennik update edit-------------------------------//
    buttonx = $('.cennik-update');
    button_length = $(buttonx).length;
        $(buttonx).on('submit', function (e) {
            e.preventDefault();
            thisid = $(this).attr('id');
            console.log('click:' + thisid);
            var form = $(this);
            var req = $.ajax({
                url: form.attr('action'),
                type: 'GET',
                data: form.serialize()
            });
            req.done(function (data) {
                console.log(thisid+data);
                remove=$('#' + thisid).parents("tr");
                $(remove).html(data);
                $(remove).show(1000);
              
                setTimeout(reloadHandlerRow, 1110) ;
                console.log('ides');
            });
            
        });      
 //   };
    function reloadHandlerRow() {//------------------------------cennik update upload-------------------------------//
        updaterow=$('.update_row_cennik');
        console.log(updaterow);
        $(updaterow).on('submit', function (e) {
            e.preventDefault();
            thisid = $(this).attr('id');
            $(this).hide(500);
            var form = $(this);
            var req = $.ajax({
                url: form.attr('action'),
                type: 'GET',
                data: form.serialize()
            });
            req.done(function () {
                var form = $(this);
                var req = $.ajax({
                    url: "../modules/editcennik.php",
                    type: 'GET',
                    data: form.serialize()
                });
                req.done(function (data2) {
                console.log(data2);
                thisid = thisid.replace(/form_id_/gi, '');
                thisid="id_delete_"+thisid;
                ape=$(data2).find('#'+thisid).parents('tr')[1];
                $('#main-table').append(ape);
                console.log(thisid);
                });
            });
        });
        buttonx = $('.cennik-update'); 
   };
</script>

<?php
                                                    // -- a toto je samotna tabulka -- //
$pocet_druhov0 = "SELECT COUNT(*) AS total FROM druh";
$pocet_druhov = $databaza->query($pocet_druhov0);
foreach ($pocet_druhov as $roow => $pocet_druhov) {
    $kurzov_je = $pocet_druhov[total];
};
foreach ($result_stadion as $roww => $row_stadion) {//---------- vypis stadiona
    echo '<table><tr><td>' . $row_stadion[stadion] . '</td></tr><tr>';
    echo '<td>Pocet clenov</td>';
    foreach ($result_druh as $rowd => $row_druh) {//---------- vypis druhu
        echo '<td>' . $row_druh[nazov] . '</td>';
    };
    echo('</tr>');
    $sql_cennik0 = "SELECT * FROM cennik WHERE stadion_id=$row_stadion[stadi_id] ORDER BY druh_kurzu ";
    $result_cennik0 = $databaza->query($sql_cennik0);
    for ($a = 1; $a <= 5; $a++) {
        $sql_cennik1 = "SELECT * FROM cennik WHERE stadion_id=$row_stadion[stadi_id] ORDER BY druh_kurzu";
        $result_cennik1 = $databaza->query($sql_cennik1);
        $sql_cennik2 = "SELECT * FROM cennik WHERE stadion_id=$row_stadion[stadi_id] and pocet_clenov=$a ORDER BY druh_kurzu";
        $result_cennik2 = $databaza->query($sql_cennik2);
        //echo $sql_cennik2;
        $riadok = array(0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($result_cennik2 as $row01 => $row_cennik2) {
            // echo'<td>'.$row_cennik2[cena].'</td>';
            for ($bb = 1; $bb <= $kurzov_je; $bb++) {
                if ($bb == $row_cennik2[druh_kurzu]) {
                    $riadok[$bb] = $row_cennik2[cena];
                };
            };
        };
        echo '<tr><td>pocet clenov:' . $a . '</td>';
        for ($bb = 1; $bb <= $kurzov_je; $bb++) {
            //echo '<td>' . $riadok[$bb] . '</td>';
            if ($riadok[$bb] > 0) {
                echo '<td>' . $riadok[$bb] . '</td>';
            } else {
                echo '<td>-</td>';
            };
        };
        echo '</tr>';
    };
    echo '</tr></td></tr></table>';
};

?>

