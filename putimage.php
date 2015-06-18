<?php
session_start();
include 'database_config.php';

if(isset($_GET['image'])){
$image=explode('.',$_GET['image']);


$db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
 $sql =$sql="UPDATE User SET Background='".$image[0]."' where username='".$_SESSION["username"]."'";

 $result=mysqli_query($db,$sql) or die(mysqli_error($db)) ;
 $row = mysqli_fetch_array($result);
 mysqli_close($db);
 header("Location:background.php");

}
?>