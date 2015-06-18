<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>


<meta charset="utf-8" />
<title>Login</title>

<head>
<style type="text/css">
input[type="text"], input[type="password"],textarea {

  background-color : #d1d1d1; 

}


body{
    
    color: rgb(136,136,136);
    text-align: center;
   background-image: url(<?php echo "/background/login3.jpg";?>);
   -webkit-background-size: cover;
  }


.login{
    position: absolute;
    Right: 0px;
    top: 200px;
    border: 1px solid black;
    text-align: center;
    width:205px;
   
}

.footer{
	color:grey;
	position: absolute; 
	bottom: 5px;
	
	width: 99%;
}

</style>

</head>

<body bgproperties="fixed">

<div class="login">
<center><h2>Login</h2></center>
<?php 

session_start();

if(isset($_SESSION["error"])){
echo "<font color='maroon'>".$_SESSION["error"]."</font>";
session_destroy();
}
else{
echo "<br><br>";
}

?>
<form action="homepage1.php" method="post">

<center><input type="text" name="username" placeholder="User Name"><br>
<input type="password" name="password" placeholder="Password" ><br>
<input type="submit" value="Login"><br><br></center>

</form>


<a href="forgetPassword.php" style="color:rgb(136,136,136);text-decoration:none;">Forget Password..?</a><br>
<a href="userregistration.php" style="color:rgb(136,136,136);text-decoration:none;">New User..?</a><br>
</div>

<div class="footer"><?php include 'copyright.php'; ?></div>
</div>

</body>
</html>

