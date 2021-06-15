<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @font-face {font-family: Ubuntu; src: url("Ubuntu-B.ttf");}
  </style>
  <link rel="stylesheet" href="css/styleform.css?v=1.2" type="text/css" media="screen" />
</head>

<body>
  <?php 
//------------------------   STADION    --------------------------- 

   

  include'partials/connecting.php';
  if (!empty($databaza)) {
      $result_stadion = $databaza->query($sqlstadion);
  } else {
      echo'nepripojeny';
      die();
  }
  $sqlstadion = "select * FROM stadion ORDER BY stadi_id";
  if (!empty($databaza)) {
      $result_stadion = $databaza->query($sqlstadion);
  }
  $sqldruh = "select * FROM druh";
  if (!empty($databaza)) {
      $result_druh = $databaza->query($sqldruh);
  }
  echo('<h1>Vyberte si kurz</h1>');
  $sql = "select * FROM kurz where stadion_id=1";
  $result = $databaza->query($sql);

  $result_stadion = $databaza->query($sqlstadion);

    echo '<div class="pas1">
      <div class="select_stadion">
      <h2>Vyberte si stadión</h2> ';
      while($row_stadion = $result_stadion->fetch_assoc()) {
        echo '<div class="btn stadion"><input id="stadion'.$row_stadion[stadi_id].'" type="button" value="'.$row_stadion[stadion].'"></div>';
      };
    echo '</div>
    </div>';
    //--   ---------------------   DRUH   ----------------------------//
    echo'<div id="druh-kurzu"></div>';
    //--    ---------------- vypis datumov stadiona   ----------------//
    echo'<div id="vypiskurzov"></div>';
    //--    ---------------- zvol si úroveň dieťa/dospelý  -----------//
    echo'<div id="vypisuroven"></div>';
    //--    ----------------------- Cena  -----------------------------//
    echo'<div id="cena"></div>';
    //--    ----------------------- Druh platby -----------------------------//
    echo'<div id="platba"></div>';
    //--   ---------------------   info   ----------------------------//
    echo'<div class="info"></div>';
  ?>
</body>

<script src='js/jquerymini.js'></script>
<script>	
  platba=0;
  var vykoncisloarray=[0,0,0,0];
  var speed=300;
  var ab=[];
  a=0; 
  $('.select_stadion input').each(function(){
    $('#cena').hide();
    a=a+1;
    ab[a]=$(this).attr('id');
    //console.log(ab[a]);
    $('#'+ab[a]).parent().click(function() {
      $('#vypisuroven').hide();
      $('.select_stadion input').css("box-shadow","none");
      stadion=$(this).children().attr('id'); //-- zisti ktory stadion si klikol  --//
      $(this).children().css({"box-shadow":" 2px 2px 12px 8px rgba(0,0,200,0.4) inset","border-radius":"5px"});
      info(stadion,"","","","",platba);
      
      var req = $.ajax({
        url:'formdruh.php?id_stadion='+stadion,
        type: 'GET'
      });
          req.done(function(data) {
            druh_kurzov=$(data);
            $('#vypiskurzov').slideUp(0);
            $('#druh-kurzu').slideUp(0);
            $('#druh-kurzu').html(druh_kurzov);
           $('#druh-kurzu').slideDown(speed);  
          selectDruh();
         });
    });
    
   });
function selectDruh() {
  $('#cena').hide();
var ab2=[];
  a2=0; 
  $('.select_druh input').each(function(){
    a2=a2+1;
    ab2[a]=$(this).attr('id');
 
    $('#'+ab2[a]).parent().click(function() {
      druh_kurzu=$(this).children().attr('id'); //-- zisti ktory druh_kurzu si klikol  --//
      $('#druh-kurzu1,#druh-kurzu2,#druh-kurzu3,#druh-kurzu4,#druh-kurzu5').css("box-shadow","none");
      $(this).children().css({"box-shadow":" 2px 2px 12px 8px rgba(0,0,200,0.4) inset","border-radius":"5px"});
      //console.log(druh_kurzu);
      info(stadion,druh_kurzu,"","",platba);
      var req = $.ajax({
        url:'formkurz.php?id_druh_kurzu='+druh_kurzu+'&id_stadion='+stadion,
        type: 'GET'
      });
          req.done(function(data) {
            vypis_kurzov=$(data);
            $('#vypisuroven').slideUp(0);
            $('#vypiskurzov').slideUp(0);
            $('#vypiskurzov').html(vypis_kurzov);
           $('#vypiskurzov').slideDown(speed);
          selectkurz();
          pageScroll();
         });
    });
   });
   
};
function selectkurz() {
  $('#cena').hide();
  var ab2=[];
  a2=0; 
  $('.select_kurz input').each(function(){
    a2=a2+1;
    ab2[a]=$(this).attr('id');
    //console.log(ab2[a]);
    $('#'+ab2[a]).parent().click(function() {
      //console.log($(this).children());
      select_datum_id=$(this).children().attr('id'); //-- zisti ktory datum_kurzu si klikol  --//
      $('.select_kurz input').css("box-shadow","none");
      $(this).children().css({"box-shadow":" 2px 2px 12px 8px rgba(0,0,200,0.4) inset","border-radius":"5px"});
      info(stadion,druh_kurzu,select_datum_id,"","","");
      var req = $.ajax({
        url:'urovenkurzu.php?id_druh_kurzu='+select_datum_id,
        type: 'GET'
      });
          req.done(function(data) {
            vypis_kurzov=$(data);
           $('#vypisuroven').slideUp(0);
           $('#vypisuroven').html(vypis_kurzov);
           $('#vypisuroven').slideDown(speed);
           selecturoven(); 
          pageScroll(); 
         });
      
    });
   });
   
};

function selecturoven() {
  $('#cena').hide();
  $('#vypisuroven > .pas1 > .select_druh > div > div > div > form').hide()
  var ab2=[];
  var vykoncisloarray=[0,0,0,0];//-- pole urovni
  a2=0; 
  
  $('#vypisuroven input').each(function(){  // -- prejdi poles s vygenerovanymi urovnami 
    a2=a2+1;
    ab2[a2]=$(this).attr('id');// -- vycucni idcka s vygenerovanymi urovnami
    $('#'+ab2[a2]).parent().click(function() {  //-- ak kliknes na niektore
      idcko=$(this).children().attr('id');//-- najdi id vybranej urovne
      vykoncislo=$(this).attr('class');//-- najdi class vybranej urovne
      vykoncislo=vykoncislo[9]; //-- najdi cislo vybranej urovne
      if($(this).children().attr('class')=="selected"){  //-- vypni uroven a pocet ludi ak to bolo predtym selecnute
        vykoncisloarray[vykoncislo]=0;//---- vymazanie poctu ludi ----//
        $(this).children().removeClass("selected");
        $(this).children().css({"box-shadow":"none"});
        $('.'+idcko).children().slideUp(speed);
        document.getElementById(idcko+1).selectedIndex=0;
      } else{  //-- zapni uroven zobraz pocet ludi ak nebol predtym selecnuty--//
        $('.'+idcko).children().css("margin-top","20px");
        $('.'+idcko).children().slideDown(speed);
        $(this).children().css({"box-shadow":" 2px 2px 12px 8px rgba(0,0,200,0.4) inset","border-radius":"5px"});
        $(this).children().addClass('selected');
        vykoncisloarray[vykoncislo]=0; //---- vymazanie poctu ludi ----//
      };
      prerataj();
      $( "#"+idcko+1 ).change(function() {prerataj()});

      function prerataj() {

         //--- ak sa meni pocet ludi tak vykonaj tento kod ---//
         vykoncislo=-1;
        $('.tab1 form').each(function(){  //-- prebehni vsetky pocty ludi vo vykonoch
          vykoncislo++;
          idcko0=$($(this).children()[1]).attr('id'); 
          vykoncisloarray[vykoncislo]=(document.getElementById(idcko0).value); //-- najdi hodnoutu poctu ludi v danej urovni
        
          pocetludi=1*vykoncisloarray[0]+1*vykoncisloarray[1]+1*vykoncisloarray[2]+1*vykoncisloarray[3];
        });
        
        cenakurzu(pocetludi);
        
          pageScroll();
        info(stadion,druh_kurzu,select_datum_id,vykoncisloarray,pocetludi,platba);
      };
    });
  });

};
//--scrolovanie --//
function pageScroll() {
  var $target = $('html,body'); 
$target.animate({scrollTop: $target.height()}, 1000);
  };
//  ------------------------------------ funkcie na vypocet Cena ------------------------------------//
function cenakurzu(pocetludi) {
 
  var req = $.ajax({
    url: 'cena.php?id_druh_kurzu='+druh_kurzu+'&id_stadion='+stadion+'&pocet_ludi='+pocetludi,
    dataType: 'json'
  });
    req.done(function(data) {
      console.log(data);
      console.log("vykon:"+vykoncisloarray);
      if(data.message=='no peoples'){$('#cena').html('<h2>Cena kurzu</h2>')};
      if(data.message=='success'){
        $('#cena').html('<h2>Cena kurzu: '+data.cena+'€</h2>');
        druhplatby(stadion,druh_kurzu)
      };
      if(data.message=='no price'){$('#cena').html('Niekde sa stala chyba. Tento kurz, pre počet ludí: '+pocetludi+' nieje v cenniku.')};
    
      $('#cena').slideDown(speed);
    });
  };
function druhplatby(stadion,druhkurzu){
  var req = $.ajax({
    url:'platba.php?id_druh_kurzu='+druh_kurzu+'&id_stadion='+stadion,
    type: 'GET'
  });
  req.done(function(data) {
    platba=$(data);
    $('#platba').html(platba);
    $('#platba').slideDown(speed);  
    pageScroll();
    
    info(stadion,druh_kurzu,select_datum_id,vykoncisloarray,pocetludi,platba);
  });
}

function info(stadion,druh_kurzu,select_datum_id,vykoncisloarray,pocetludi,platba) {
      console.log("preratane"+vykoncisloarray);
      text="Štadión: "+stadion+"<br>Druh kurzu: "+druh_kurzu+"<br>Kurz riadok: "+select_datum_id+"<br>uroveň: ";

      if (vykoncisloarray[0]) {
        text=text+"<br>uroven1 + ludi "+vykoncisloarray[0]+",";
      };
      if (vykoncisloarray[1]) {
        text=text+"<br>uroven2 + ludi "+vykoncisloarray[1]+",";
      };
      if (vykoncisloarray[2]) {
        text=text+"<br>uroven3 + ludi "+vykoncisloarray[2]+",";
      };
      if (vykoncisloarray[3]) {
        text=text+"<br>uroven4 + ludi "+vykoncisloarray[3];
      }
      text=text+"<br>celkom pocet ludi:"+pocetludi
      
      
        text=text+"<br>platba: "+$(platba);
        $('.info').html(text); 
      };

</script>	