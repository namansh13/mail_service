<?php 
session_start();

if(!isset($_SESSION["username"])){
echo "<script type='text/javascript'>alert('Please login again!');</script>";
header("Location:login.php");
}
?>


<html>
<title>Inbox</title>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="../js/jquery.easing.1.3.js" type="text/javascript"></script>

<script>
$(document).ready(function() {
	$("#option").change(function(){
	
	 var favorite = [];
            $.each($("input[name='mail']:checked"), function(){            
                favorite.push($(this).val());
            });
	
	var option = $(this).find('option:selected').val();
	if(option=="delete"){
          
	  $.ajax({
                    url: 'deletemail.php',
                    type: 'POST',
                    data: { fileArray: favorite },
                    success: function(data) {
                       
                        
			window.location.reload(true);
                    }
                });
	}
	
	});
});
</script>
<script>
$(document).ready(function() {
	$("#option").change(function(){
	 var favorite = [];
            $.each($("input[name='mail']:checked"), function(){            
                favorite.push($(this).val());
            });
	
	var option = $(this).find('option:selected').val();
	if(option=="unread"){
          
	  $.ajax({
                    url: 'markUnread.php',
                    type: 'POST',
                    data: { fileArray: favorite },
                    success: function(data) {
                       
                       window.location.reload(true);
			
                    }
                });
	}
	});
});
</script>
<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('mail');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>



</head>


<style type="text/css">

body{
	color: rgb(136,136,136);
   	text-align: center;
	background-image: url(<?php echo $_SESSION["Background"].".jpg";?>);
  	-webkit-background-size: cover;
  }



.mailbox{
	position:relative;
   	top:50px;  	
   	margin:0 auto;
    	border: 1px solid black;
    	width:800px;
	background: rgba(0, 0, 0, 0.6)
   
}

.select{ 
	display: inline-block; 
	width: 40%; 
	text-align:left;	
}
.sender{ 
	display: inline-block; 
	width: 20%; 
	text-align:left;
}
.checkbox{ 
	float: left; 
	width: 5%; 
	text-align:left;
}
.subject{ 
	display: inline-block;
	width: 53%; 
	text-align:left;
}
.date{
	 float: right; 
	width: 20%; 
	text-align:right;
}



.footer{
	position: absolute; 
	bottom: 5px;
	text-align: center;
	width:99%;
	
}


</style>


<body bgproperties="fixed">


<div style="position:fixed;left:0px;"><a href="homepage.php" style="color:rgb(206,206,206);text-decoration:none;"><- Back</a><br></div>
</div>
<div class="mailcontent">
<div class="mailbox" style="background:rgba(0,0,0,1);">

<div class="checkbox"><input type="checkbox" onClick="toggle(this)"></div>

<div class="sender" style="display: inline-block;width: 30%;text-align:left;"><select id="option" style="background: rgba(255, 255, 255, 0.8);" >
   <option value="None">-- What to do --</option>
   <option value="delete">Delete</option>
   <option value="unread">Mark as unread</option>

</select></div>

</div>

<?php
    $dir = "user/".$_SESSION["username"]."/inbox/unread";
    $dir1="user/".$_SESSION["username"]."/inbox/read";
  	

          
  	$directory = opendir($dir);
	
  	
  	 $list1 = array();
    while($file = readdir($directory)){
        if ($file != '.' and $file != '..'){
            // add the filename, to be sure not to
            // overwrite a array key
            $ctime = filectime($dir."/".$file) . ',' . $file;
	
            $list1[$ctime] = $dir."/".$file;
        }
    }
    closedir($directory);
	
	$directory = opendir($dir1);
	$list2 = array();
	  while($file1 = readdir($directory)){
        if ($file1 != '.' and $file1 != '..'){
           
            $ctime = filectime($dir1."/".$file1) . ',' . $file1;
		
            $list2[$ctime] = $dir1."/".$file1;
        }
    }
    closedir($directory);
	
	$list=array_merge($list1,$list2);

    krsort($list);

        foreach ($list as $file) 

       {
		$read=false;
		if(in_array($file,$list2)){
		$read=true;
		}
		
	   	$name12=explode('/',$file);

		$file_name_rdir=$name12[count($name12)-1];
	
	   	  $x= explode('.',$file_name_rdir);
            
		
		date_default_timezone_set("Asia/Calcutta");

		$date1=	date('d_m_y', filemtime($file));
		$today=date('d_m_y');	

		if($date1<$today){
		if($date1<$today-14){
		$filetime=date(" d/m/Y", filemtime($file));
		}
		else{
		$filetime=date(" D h:i A", filemtime($file));
		}
		}
		else{
		$filetime=date("h:i A", filemtime($file));
		}
	
      

	 
	    $y= explode('_',$file_name_rdir);
		$y[0]=wordlimit($y[0],20);
		$y[1]=wordlimit($y[1],67);
		if(empty($y[1])){
		$y[1]=" " ;
		}
		if($read){
		echo "<div class='mailbox' style='background: rgba(120, 120, 120, 0.2);'>
   		<div class='checkbox'><input type='checkbox' value='".$file."' name='mail'></div>";
		echo "<a href='mail1.php?filename=".$file."&subject=".$y[1]."' style='color:rgb(206,206,206);text-decoration:none;'>
         	
  		 <div class='sender'>".$y[0]."</div>
		 <div class='subject'>".$y[1]."</div>
 		 <div class='date'>".$filetime."</div>
   		</div></a>";

		
		}
		else{
		echo "<div class='mailbox'>
   		<div class='checkbox'><input type='checkbox' value='".$file."' name='mail'></div>";
   		echo "<a href='mail1.php?filename=".$file."&subject=".$y[1]."' style='color:rgb(206,206,206);text-decoration:none;'>
         
  	 	<div class='sender'>".$y[0]."</div>
	 	<div class='subject'>".$y[1]."</div>
 	 	<div class='date'>".$filetime."</div>
   </div></a>";
	}
		
          
        
    }

function wordlimit($str,$len){
if(strlen($str)<$len){

return $str;
}
if(!strpos($str," ")){
return substr($str,0,$len-3)."...";
}
$str=substr($str,0,$len-3);

$str=trim($str);
$n=strrpos($str," ");

$str=substr($str,0,$n);
return $str."...";

}




echo "<br>"  ;
echo "<br>"  ; 
echo "<br>"  ; 
echo "<br>"  ;         
        
    
?>



<div class="footer"><?php include 'copyright.php'; ?></div>
</div>




</body>
</html>