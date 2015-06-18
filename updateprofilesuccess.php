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
</style>

<?php

include 'database_config.php';

$db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);

 
$sql="UPDATE User SET 	Secondary_mail='".$_POST['email2']."',
			AddressLine1='".$_POST['addressl1']."',
		       AddressLine2='".$_POST['addressl2']."',
		       AddressLine3='".$_POST['addressl3']."',		
		       Contact =".$_POST['contact'].",
		       SecurityQuestion = '".$_POST['securityquestion']."',
		       SecurityAnswer = '".$_POST['securityanswer']."' where username='".$_SESSION["username"]."'";
 $result=mysqli_query($db,$sql) ;
if($result)
{
echo "Profile Updated, Redirecting to Home Page...";
header("Refresh:3;URL=homepage.php");
}


else{
echo "Some Error occured, Try Later ";
header("Refresh:3;URL=homepage.php");
}



?>