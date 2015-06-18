<?php 
include 'database_config.php';

$username=$_POST['username'];
$email2=$_POST['email2'];
 $db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$sql="SELECT * FROM ".DATABASE.".user where username='".$username."' and Secondary_mail='".$email2."'";
$result = mysqli_query($db,$sql) or die(mysqli_error($db));
 $row = mysqli_fetch_array($result);
 mysqli_close($db);

if(Mysqli_num_rows($result)==1){
 $db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$sql="SELECT * FROM ".DATABASE.".user where Email='".$email2."'";
$result = mysqli_query($db,$sql) or die(mysqli_error($db));
 $row = mysqli_fetch_array($result);
 mysqli_close($db);
$username1=$row['username'];

$dir="user/".$username1."/inbox/unread";
date_default_timezone_set("Asia/Calcutta");
$sent= date("D j/m/y h:i:s A");

$curr_time=gettimeofday(true)*10000;
$from="administrator@xyz.com";
$subject="Password Change";
$message="<a href='forgetpasswordchange.php?username=".$username."' style='color:rgb(136,136,136);text-decoration:none;'><u>Click here..?</u></a><br>";


$filename=$from."_".$subject."_".$curr_time.".txt";
$file=fopen($dir."/".$filename,"w") or die("unable to open file");

fwrite($file,"From : ".$from.PHP_EOL.PHP_EOL);

fwrite($file,"Sent : ".$sent.PHP_EOL.PHP_EOL);


fwrite($file,"To : ".$from.PHP_EOL.PHP_EOL);

fwrite($file,"Subject : ".$subject.PHP_EOL.PHP_EOL);

fwrite($file,$message);


fclose($file);


}
echo "Link send to your email, check after few minutes...";
header("Refresh:3;URL=login.php");
?>