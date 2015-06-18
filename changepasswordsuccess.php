<?php
session_start();
?>

<html>
<title>Change Password</title>
<style>
body{
background-image: url(<?php echo $_SESSION["Background"].".jpg";?>);
   -webkit-background-size: cover;
	color:grey;
  }

<body bgproperties="fixed">
</style>
<?php

include 'database_config.php';
include 'hash_password.php';

 $db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
 $sql = "SELECT password FROM ".DATABASE.".login where username ='".$_SESSION["username"]."'";
 $result=mysqli_query($db,$sql) ;
 $row = mysqli_fetch_array($result);

$validate=validate_password($_POST['oldpassword'],$row['password']);
 
 if($validate==1){
$newpassword=create_hash($_POST['newpassword']);
$sql="UPDATE login SET password='".$newpassword."' where username='".$_SESSION["username"]."'";
$result=mysqli_query($db,$sql) ;
if($result){
echo "Password changed succesfully, redirecting to home Page...";
header("Refresh: 3;URL=homepage.php");
}
else{
echo "some error has occured, try again";
header("Refresh: 3;URL=changePassword.php");
}

}
else{
echo "Password is wrong, try again";
header("Refresh: 3;URL=changePassword.php");
}


?>

</body>
</html>