<?php

session_start();
if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Refresh:0.5;URL=login.php");
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
<title>background</title>
<head>
<style type="text/css">

body{
background-image: url(<?php echo $_SESSION["Background"].".jpg";?>) ;
   -webkit-background-size: cover;
	color:grey;
	text-align:center;
	
	
	
  }

::-webkit-scrollbar { 
    display: none; 
}



.content{
	widht:500px;
	text-align:center;
	


}
.image{
	
	position: relative;
	margin:0 auto;
	float:left;
	left:150px;
	width: 300px;
	text-align:center;
	border: 1px ;
	color:grey;

}

.image + .image {
    margin-left: 30px;
    
}
.image:nth-child(3n+1) {
     margin-left: 0;  
} 

.back{
position: fixed;
}
</style>
</head>

<body bgproperties="fixed">


<div style="float:left;position:fixed;"><a href="homepage.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a>
</div><br>

<div class="content">
<?php
    $dir = '/xampp/htdocs/background';
    $file_display = array('jpg', 'jpeg', 'png', 'gif');

    if (file_exists($dir) == false) 
    {
        echo 'Directory "', $dir, '" not found!';
    } 
    else 
    {
        $dir_contents = scandir($dir);

        foreach ($dir_contents as $file) 
        {
	    $x= explode('.',$file);
            $file_type=strtolower(end($x));	
          
           if ($file !== '.' && $file !== '..' && in_array($file_type, $file_display) == true)     
            {

                $name = "/background/".basename($file);
		echo "<div class='image'>";
		echo explode('/',$name)[2]."<br>";
		$name_explode=explode('/',$name)[2];
	
		echo "<a href='putimage.php?image=".$name_explode."'><img src='".$name."' width='290' height='290' alt='".$name."'></a>";
                
		 echo "</div>";
            }
        }
    }
?>
</div>

</body>


<html>