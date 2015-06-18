<?php

include 'database_config.php';
include 'hash_password.php';

function insert($username,$email,$email2,$password,$addressl1,$addressl2,$addressl3,$contactno,$SecurityQuestion,$SecurityAnswer){
  $db=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	
  $result = mysqli_query($db,"SELECT * FROM ".DATABASE.".User where username='".$username."'");
  if(mysqli_num_rows($result)>0){
	return false;
   }

  else{
	

	$sql1="INSERT INTO login (username,password) VALUES ('$username','$password')";
	$result1= mysqli_query($db,$sql1) or die(mysqli_error($db)) ;

	$sql="INSERT INTO User (username,Email ,Secondary_mail ,AddressLine1,AddressLine2,AddressLine3,contact,SecurityQuestion,SecurityAnswer)
      VALUES ('$username', '$email','$email2','$addressl1','$addressl2','$addressl3',$contactno,'$SecurityQuestion','$SecurityAnswer')";
      
	$result=mysqli_query($db,$sql) or die(mysqli_error($db)) ;
	if($result && $result1){
        return true;
      }

      else{
      return false;
      }

  }
}	
	$password=create_hash($_POST['password']);

  if(insert($_POST['username'],$_POST['email'],$_POST['email2'],$password,$_POST['addressl1'],$_POST['addressl2'],$_POST['addressl3'],
     $_POST['contactno'],$_POST['SecurityQuestion'],$_POST['SecurityAnswer']))
   {

	$dir="user/".$_POST['username']."/inbox/read";
	if(!is_dir($dir)){
	mkdir($dir,0777,true);
	}
	$dir="user/".$_POST['username']."/inbox/unread";
	if(!is_dir($dir)){
	mkdir($dir,0777,true);
	}
	$dir="user/".$_POST['username']."/sentmail";
	if(!is_dir($dir)){
	mkdir($dir,0777,true);
	}
	
     echo "Registration succesful, Redirecting to login page ";
     header("Refresh: 3; URL= login.php"); 
   }
  else{
     echo "registration fail " ;
     header("Refresh: 10; URL= userregistration.php"); 
   }




?>