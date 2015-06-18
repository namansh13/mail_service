<?php 

$a=array();
for($i=0;$i<100;$i++){
$a[$i]=$i+1;
}
for($i=0;$i<count($a);$i++){
if($i<10){
echo $a[$i].".  This is a number <br>";
}
else{
echo $a[$i].". This is a number <br>";
}
}


?>