<?php
session_start();

$files=$_POST['fileArray'];



$dir="user/".$_SESSION['username']."/inbox/unread";

foreach($files as $file){
$name=explode('/',$file);

$filename=$name[count($name)-1];
rename($file,$dir."/".$filename);

}


  echo "marked unread ";
	
  


?>