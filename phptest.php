<?php
echo 'test <br>';

class dog
{
    public $name;
    public $weight;
    public $farba;

    public function getFarba($farba)
    {
        return $this->farba=$farba;

    }

    public function getWeight($vaha)
    {
        $this->weight=$vaha;
    }

     public function getName($meno)
     {
         $this->name=$meno;
     }
     function stek(){
        echo'<br>haf<br>';
     }
}
$pes = new dog();

$pes->getName('test psa a jeho mena');
$pes->getWeight(20);
$pes->getFarba('green');
echo $pes->name;
echo $pes->weight;
echo $pes->farba;
$pes->stek();

?>