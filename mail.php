<?php 
session_start();

if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Location:login.php");
}
?>

<html>
<title><?php  if(empty($_SESSION['mailsubject']))
echo "Mail";
else
echo $_SESSION['mailsubject']; 
?></title>
<style type="text/css">

body{
   	text-align: center;
	background-image: url(<?php echo $_SESSION["Background"].".jpg";?>);
  	-webkit-background-size: cover;
  }

.mailarea{
	position:relative;
   	top:50px;
  	overflow:hidden;
   	margin:0 auto;
    	border: 1px solid black;
    	text-align: left;
    	width:800px;
	color:rgb(206,206,206);
   	background: rgba(0, 0, 0, 0.2)


}

</style>


<body bgproperties="fixed">
<div style="float:left;position:fixed;"><a href="inbox.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a>
</div><br>



<?php
if(isset($_SESSION['mailfile'])){


$filename=$_SESSION['mailfile'];
$file1 = $filename;
$lines = file($file1);

echo "<div class='mailarea'>";
foreach($lines as $line_num => $line)
{
echo $line;
echo "<br>";
}



echo "</div>";

}

else{
echo "unable to retrieve email, please try later...";
}

?>

</body>
</html>