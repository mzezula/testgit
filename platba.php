<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @font-face {font-family: Ubuntu; src: url("Ubuntu-B.ttf");}
  </style>
  <link rel="stylesheet" href="css/styleform.css?v=1.2" type="text/css" media="screen" />
</head>
<?php
    include_once 'partials/connecting.php';

    $stadion=$_GET["id_stadion"];
    $stadion=str_replace("stadion","",$stadion);
    $druh_kurzu=$_GET["id_druh_kurzu"];
    
    $druh_kurzu=str_replace("druh-kurzu","",$druh_kurzu);
   
    $sql_platba= "SELECT * FROM platba WHERE platba_druh=$druh_kurzu AND platba_stadion=$stadion";
    //echo($sql_platba);
    
    if ($result_platba = $databaza->query($sql_platba)) {
       
       //--  vypis moznosti platby
            while($result = $result_platba->fetch_assoc()) {

            if($result[hotovost]==1){
                echo '<div class="btn"><input id="platba_hotovost" type="button" value="V hotovosti na mieste"></div>';
            }else{
                echo '<div class="btn-disabled"><input id="platba_hotovost" type="button" value="V hotovosti na mieste" disabled></div>';
            };
            
            if($result[ucet]==1){
                echo '<div class="btn"><input id="platba_ucet" type="button" value="Na účet"></div>';
            }
            else{
                echo '<div class="btn-disabled"><input id="platba_ucet" type="button" value="Na účet" disabled></div>';
            };
        };
        
    };
    
    
?>