<?php

session_start();
session_unset();

include 'database_config.php';
include 'hash_password.php';

$db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$username = mysqli_real_escape_string($db,$_POST['username']);
$sql="SELECT * FROM ".DATABASE.".login where username='".$username."'";

$result = mysqli_query($db,$sql) or die(mysqli_error($db));
 $row = mysqli_fetch_array($result);



if(Mysqli_num_rows($result)==1){

$validate=validate_password($_POST['password'],$row['password']);

if($validate==1){


$_SESSION["username"] = $username;


header("Location: homepage.php"); 
}
else{
$_SESSION["error"]="Invalid<br> Username/Password";


header("Location: login.php");


}

}

else{
$_SESSION["error"]="Invalid<br> Username/Password";


header("Location: login.php");


}

?>

