<?php

session_start();
if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Refresh:0.01;URL=login.php");
}

?><br>


<html>
<title>Compose</title>
<style type="text/css">
input[type="text"], input[type="password"],textarea {

  background-color : #d1d1d1; 

}
body{
    
    color: rgb(136,136,136);
    text-align: center;
   background-image: url(<?php echo $_SESSION["Background"].".jpg";?>);
   -webkit-background-size: cover;
  }

.subject{
    
    text-align: center;
   
   
}


.footer{
	position: absolute; 
	bottom: 5px;
	text-align: center;
	width:99%;
	
}

label{

display:inline-block;
width:80px;
//margin-right:30px;
text-align:left;

}

.header{

position:relative;
left:-40px;
}

</style>

<body bgproperties="fixed">

<div style="float:left;position:fixed;"><a href="homepage.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a>
</div><br>

<div class="header">
<form method="post" action="mailsentsuccess.php">

<label for='to'>To : </label><input type="text" name="to" size="100"><br>
<label for='cc'>Cc : </label><input type="text" name="cc" size="100"><br>
<label for='bcc'>Bcc : </label><input type="text" name="bcc" size="100"><br>
 <label for='subject'>Subject : </label><input type="text" name="subject" size="100"><br>
</div>
<div class="subject">
<label for='message'>Message : </label><textarea rows="23" cols="100" name="message"></textarea><br>
  <input type="submit" name="submit" value="Send">
  </form>
</form>



</div>

<div class="footer"><?php include 'copyright.php'; ?></div>
</div>

</body>
</html>