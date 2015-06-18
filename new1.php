

<html>
<title>Inbox</title>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script src="../js/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("button").click(function(){
            var favorite = [];
            $.each($("input[name='mail']:checked"), function(){            
                favorite.push($(this).val());
            });
          
	 $.ajax({
      url   : "try.php", 
      type  : "POST",
      cache : false,
      data  : {
        fileArray : favourite
      }
    });

        });
    });
</script>
</head>


<style type="text/css">

body{
   	text-align: center;
	
  }


.mailbox{
	position:relative;
   	top:50px;
  	
   	margin:0 auto;
    	border: 1px solid black;
    	width:800px;
	background: rgba(0, 0, 0, 0.6)
   
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
	color:grey;
	position: relative; 
	bottom: 5px;
	width: 99%;
}

</style>


<body bgproperties="fixed">

<button style=""float:left;>Click me</button>
<h2>Inbox</h2>

<?php
    $dir = "user/naman/inbox/unread";
    $dir1="user/naman/inbox/read";
  	

          
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
		if($read){
		echo "<div class='mailbox' style='background: rgba(120, 120, 120, 0.2);'>
   		<div class='checkbox'><input type='checkbox' value=".$file." name='mail'></div>";
		echo "<a href='mail1.php?filename=".$file."&subject=".$y[1]."' style='color:rgb(206,206,206);text-decoration:none;'>
         	
  		 <div class='sender'>".$y[0]."</div>
		 <div class='subject'>".$y[1]."</div>
 		 <div class='date'>".$filetime."</div>
   		</div></a>";

		
		}
		else{
	echo "<div class='mailbox'>
   	 <div class='checkbox'><input type='checkbox' id='checkbox'></div>";
   echo "<a href='mail1.php?filename=".$file."&subject=".$y[1]."' style='color:rgb(206,206,206);text-decoration:none;'>
         
  	 <div class='sender'>".$y[0]."</div>
	 <div class='subject'>".$y[1]."</div>
 	 <div class='date'>".$filetime."</div>
   </div></a>";
	}

//if ($('.checkbox').prop('checked'))		
          
        
    }
?>







</body>
</html>