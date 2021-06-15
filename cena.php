<?php
    header('Content-Type: text/javascript; charset=utf8');
    include_once 'partials/connecting.php';
     
    $stad2=$_GET["id_stadion"];
    $druh2=$_GET["id_druh_kurzu"];
    $clenov=$_GET["pocet_ludi"];
    $stadion=$stad2[7];
    $druh_kurzu=$druh2[10];
    $cena=0;

    if($clenov==0){
        //echo '<div class="cena">Pre pokračovanie zvolte počet účastníkov.</div>';
        
        die(json(0,'no peoples'));
    };
    $sql_cennik= "SELECT * FROM cennik WHERE druh_kurzu=$druh_kurzu AND stadion_id=$stadion AND pocet_clenov=$clenov";

    if ($result_cennik = $databaza->query($sql_cennik)) {
        $abc=0;
        foreach($result_cennik as $row => $cena){
            $abc=$abc+1;         
        };
        if($abc==1){die(json($cena[cena],'success'));};
    };
    
    if ( $abc == 0){    
        die(json(0,'no price'));
    };
    function json($cena,$message){
        $data = [
            'cena' => $cena,
            'message' => $message
        ];
        $json=json_encode($data);
        die($json);
    };
?>