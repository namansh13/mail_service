<HTML>
<title>Register</title>
<head>


<style type="text/css">
input[type="text"], input[type="password"],select,textarea {

  background-color : #d1d1d1; 

}


body{
    color: rgb(136,136,136);
    text-align: center;
   background-image: url(<?php echo "/background/login3.jpg";?>);
   -webkit-background-size: cover;
  }


.content{
    position:relative;
    width:370px; 
    margin:0 auto;
    top:100px; 
    font-color:white;
    border: 1px solid black;
    background: rgba(0, 0, 0, 0.2);
    text-align: center;
    
   
}

.footer{
	color:grey;
	position: absolute; 
	bottom: 5px;
	
	width: 99%;
}

label{

display:inline-block;
width:130px;
//margin-right:30px;
text-align:left;

}

</style>

</head>
<center><h1>User Registration</h1></center>
<div style="float:left;position:fixed;"><a href="login.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a>
</div><br>


<body bgproperties="fixed">
<div class="content">
<form action="successRegistration.php" method="post">
<label for='username'>User Name : </label><input type="text" name="username" ><br>
<label for='email'>E-mail : </label><input type="text" name="email" ><br>
<label for='email'>Secondary E-mail: </label><input type="text" name="email2" ><br>
<label for='password'>Password : </label><input type="password" name="password" ><br>
<label for='addressl1'>Address Line 1 : </label><input type="text" name="addressl1" ><br>
<label for='addressl2'>Address Line 2 : </label><input type="text" name="addressl2" ><br>
<label for='addressl3'>Address Line 3 : </label><input type="text" name="addressl3" ><br>
<label for='contact'>Contact : </label><input type="text" name="contactno" ><br>
<label for='securityquestion'>Security Question : </label><select name="SecurityQuestion" >
    <option value="" disabled="disabled" selected="selected">Security Question</option>
    <option value="Birth Place">Birth Place</option>
    <option value="First School Name">First School Name</option>
    <option value="First Phone Number">First Phone Number</option>
</select><br>
<label for='securityanswer'>Security Answer : </label><input type="text" name="SecurityAnswer" ><br>


<input type="submit" value="Register"><br>
</form>
</div>




<div class="footer"><?php include 'copyright.php'; ?></div>
</body>
</html>