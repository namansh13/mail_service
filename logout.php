

<?php

session_start();
if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Already Logged out!');</script>";
header("Refresh:0.00001;URL= login.php");
exit;
}
?>

<html>


<title>Homepage</title>
<style>


body{
   background-image: url(<?php echo $_SESSION['Background'].".jpg";?>);
   -webkit-background-size: cover;
	color:grey;
   
    
  }
</style>
<body bgproperties="fixed">

<?php

echo "Logout succesfully. <br>";
echo "You are are redirecting to login page";


header("Refresh: 3; URL= login.php"); 
session_destroy();
?>
</body>
</html>