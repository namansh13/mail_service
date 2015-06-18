<?php
session_start();
?>

<html>
<title>Update Password</title>
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


 

$newpassword=create_hash($_POST['newpassword']);

 $db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$sql="UPDATE login SET password='".$newpassword."' where username='".$_POST['username']."'";
$result=mysqli_query($db,$sql) ;
if($result){
echo "Password changed succesfully, now you can login...";
header("Refresh: 3;URL=inbox.php");
}
else{
echo "some error has occured, try again";
header("Refresh: 3;URL=forgetPasswordchange.php");
}




?>

</body>
</html>