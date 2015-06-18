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
.horizontal{

	position: absolute; 
	top: 50px;
        left: 0px;
	width:100%;
	height:10%;
	background-color: black;
	text-align: center;
	color:white;
}


.content{
    position:relative;
    width:375px;
    margin:0 auto;
    top:150px ;
    background: rgba(0, 0, 0, 0.2)
    text-align: center;
    
}

label{

display:inline-block;
width:160px;
margin-right:30px;
text-align:right;

}

</style>


<body bgproperties="fixed">
<center><h1>Change Password</h1><center>
<div style="float:left;position:fixed;"><a href="homepage.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a>
</div><br>
<?php

if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Location:login.php");
}

?>



<div class="content">


<form action="changeforgetpasswordsuccess.php" method="post">
<input type="text" value="<?php echo $_GET['username']; ?>" name="username" hidden><br>
<label for='newpassword'>New Password : </label><input type="password" name="newpassword" placeholder="New Password"><br>
<label for='retypenewpassword'>Retype New Password : </label><input type="password" name="rnewpassword" placeholder="Retype PAssword"><br>
<input type="submit" value="Update">
</form>




</body>
</html>