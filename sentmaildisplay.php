<?php 
session_start();

if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Location:login.php");
}
?>

<html>
<title><?php  if(empty($_GET['subject']))
echo "Mail";
else
echo $_GET['subject']; 
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

<div style="position:fixed;left:0px;"><a href="sentmail.php" style="color:rgb(206,206,206);text-decoration:none;"><u><- Back</u></a><br></div>
</div>



<?php
if(isset($_GET['filename'])){


$filename=$_GET['filename'];
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