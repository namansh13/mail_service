<?php
session_start();
if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Location:login.php");
}
?>

<HTML>
<title>Profile Update</title>

<head>
<style>

body{
background-image: url(<?php echo $_SESSION["Background"].".jpg";?>);
   -webkit-background-size: cover;
	color:grey;
  }

.content{
    position:relative;
    width:370px; 
    margin:0 auto;
    top:100px; 
    font-color:white;

    background: rgba(206, 206, 206, 0.2)
    text-align: center;
    


}

label{

display:inline-block;
width:130px;
//margin-right:30px;
text-align:left;

}

fieldset{


width:400px;
margin:0px auto;

}
</style>

</head>
<center><h1>Update Profile</h1><center>



<body bgproperties="fixed">
<div style="position:absolute;left:0px;"><a href="homepage.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a><br></div>
</div>

<div class="content">
<form action="updateprofilesuccess.php" method="post">
<?php

include 'database_config.php';

$db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
 $sql = "SELECT * FROM ".DATABASE.".User where username ='".$_SESSION["username"]."'";
 $result=mysqli_query($db,$sql) ;
 $row = mysqli_fetch_array($result);
 mysqli_close($db);

 echo "<label for='username'>User Name : </label><input type='text' value='".$row['username'] ."' name='username' readonly style='background-color : #d1d1d1;' ><br>";
 echo "<label for='Email'>Email : </label><input type='text' value='".$row['Email'] ."' name='email' readonly style='background-color : #d1d1d1;'><br>";
 echo "<label for='Email'>Secondary E-mail : </label><input type='text' value='".$row['Secondary_mail'] ."' name='email2'  ><br>";
 echo "<label for='addressl1'>Address Line 1 : </label><input type='text' value='". $row['AddressLine1']."' name='addressl1' ><br>";
 echo "<label for='addressl2'>Address Line 2 : </label><input type='text' value='". $row['AddressLine2']."' name='addressl2' ><br>";
 echo "<label for='addressl3'>Address Line 3 : </label><input type='text' value='". $row['AddressLine3']."' name='addressl3' ><br>";
 echo "<label for='contact'>Contact : </label><input type='text' value='". $row['Contact']."' name='contact' ><br>";


$option[0]=$row['SecurityQuestion'];
$option[1]="Birth Place";
$option[2]="First School Name";
$option[3]="First Phone Number";
$option=array_unique($option);



echo "<label for='securtityquestion'>Security Question : </label><select   name='securityquestion'>";

 
            foreach($option as $value) {
                echo '<option value="'.$value.'">'.$value.'</option>';
            }
  
    
echo "</select><br>";
echo "<label for='securtityanswer'>Security Answer : </label><input type='text' value='". $row['SecurityAnswer']."' name='securityanswer' ><br>";
echo "<input type='submit' value='Update'>";
?>

</form>



</body>
</HTML>