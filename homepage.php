<?php

session_start();
if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Refresh:0.5;URL=login.php");
exit;
}
else{

include 'database_config.php';

$db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$sql="select Background from ".DATABASE.".User where username='".$_SESSION["username"]."'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);
$_SESSION['Background']="/background/".$row['Background'];

mysqli_close($db);
}
?><br>

<html>


<title>Homepage</title>
<style>


body{
   background-image: url(<?php echo $_SESSION['Background'].".jpg";?>);
   -webkit-background-size: cover;
   color: rgb(136,136,136);
   
    
  }

.header{

	position: fixed; 
	top: 50px;
        left: 0px;
	width:100%;
	height:10%;
	background: rgba(0, 0, 0, 0.2);
	
}

.panel{
	position:absolute;
    left: 0px;
    top: 112px;
    background: rgba(0, 0, 0, 0.2);
    text-align: left;
    width:205px;


}

.content{
    position: relative;
    left: 0px;
    top: 100px;
    text-align:left;
    color:rgba(0,0,0,0.2);
}

.footer{
	position: absolute; 
	bottom: 5px;
	text-align: center;
	width:99%;
	
}

.mailmessage{
	margin: 0 auto;
	background-color:#FFF8DC;
	width:200px;
	text-align:center;
	
}

</style>


<body bgproperties="fixed">

<?php 
if(isset($_SESSION['mailmessage'])){
if(!is_null($_SESSION['mailmessage'])){
echo "<div class='mailmessage'>";
echo "<center>".$_SESSION['mailmessage']."</center>";
echo "</div>";
$_SESSION['mailmessage']=NULL;
}
}

?>
<div class="header">
<div style="color:white; position:relative; font-size: 20px;float:left; top:50%;">Welcome, <?php echo ucfirst($_SESSION['username']);?></div>
<div style="color:white; position:relative; font-size: 20px; top:50%;"></div>
<div style="color:white; position:relative; font-size: 20px;float:right; right:20px;top:50%;"><a href="logout.php" style="color:white;text-decoration:none;">Sign-out</a><br></div>
</div>
<div class="content">

<a href="inbox.php" style="text-decoration:none; color:rgba(206,206,206,0.7);">Inbox
<?php 
$dir = "user/".$_SESSION["username"]."/inbox/unread/";
$files = glob($dir . "*.txt");

if ( $files !== false )
{
    $filecount = count( $files );
	if($filecount!==0)
    echo "(".$filecount.")";
}



?>
</a><br>
<a href="compose.php"style="text-decoration:none;color:rgba(206,206,206,0.6);">Compose</a><br>
<a href="sentmail.php" style="text-decoration:none;color:rgba(206,206,206,0.6);">Sent Mail</a><br>
<a href="updateprofile.php" style="text-decoration:none;color:rgba(206,206,206,0.6);">Update Profile</a><br>

<a href="background.php" style="text-decoration:none;color:rgba(206,206,206,0.6);">Change Theme</a><br>
<a href="changepassword.php" style="text-decoration:none;color:rgba(206,206,206,0.6);">Change Password</a><br>

</div>

</body>




<div class="footer"><?php include 'copyright.php';?></div>




</html>



