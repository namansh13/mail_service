<?php

session_start();

$name=explode('/',$_GET['filename']);

$filename=$name[count($name)-1];
$dir="user/".$_SESSION['username']."/inbox/read";

if(strcmp($dir."/".$filename,$_GET['filename'])==0)
{
$_SESSION['mailfile']=$dir."/".$filename;
$_SESSION['mailsubject']=$_GET['subject'];

header("location:mail.php");
}
else{

rename($_GET['filename'],$dir."/".$filename);

$_SESSION['mailfile']=$dir."/".$filename;
$_SESSION['mailsubject']=$_GET['subject'];

header("location:mail.php");
}

?>