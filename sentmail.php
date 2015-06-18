<?php
session_start ();

if (! isset ( $_SESSION ["username"] )) {
	echo "<script type='text/javascript'>alert('Please login again!');</script>";
	header ( "Location:login.php" );
}
?>

<html>
<head>
<title>Sent mail</title>


<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
body {
	color: rgb(136, 136, 136);
	text-align: center;
	background-image: url(<? php echo $ _SESSION [ 
		"Background" 
] . ".jpg";
?>);
	-webkit-background-size: cover;
}

.mailcontet {
	position: relative;
	top: 50px;
	margin: 0 auto;
	border: 1px solid white;
	width: 800px;
	height: 90%;
	background: rgba(0, 0, 0, 0) overflow : hidden;
}

.mailbox {
	overflow: auto;
	position: relative;
	display: inline-block;
	margin: 0 auto;
	border: 1px solid black;
	width: 800px;
	background: rgba(0, 0, 0, 0.4)
}

.select {
	display: inline-block;
	width: 40%;
	text-align: left;
}

.sender {
	display: inline-block;
	width: 20%;
	text-align: left;
}

.checkbox {
	float: left;
	width: 5%;
	text-align: left;
}

.subject {
	display: inline-block;
	width: 53%;
	text-align: left;
}

.date {
	float: right;
	width: 20%;
	text-align: right;
}

.footer {
	position: relative;
	bottom: 5px;
	text-align: center;
	width: 99%;
}
</style>


<body bgproperties="fixed">


	<div style="position: fixed; left: 0px;">
		<a href="homepage.php"
			style="color: rgb(206, 206, 206); text-decoration: none;"><- Back</a><br>
	</div>
	</div>


	<div class="mailbox" style="background: rgba(0, 0, 0, 1);">

		<div class="checkbox">
			<input type="checkbox" onClick="toggle(this)">
		</div>

		<div class="sender"
			style="display: inline-block; width: 30%; text-align: left;">
			<select id="option" style="background: rgba(255, 255, 255, 0.8);">
				<option value="None">-- What to do --</option>
				<option value="delete">Delete</option>

			</select>
		</div>

	</div>

<?php
$dir = "user/" . $_SESSION ["username"] . "/sentmail";

$directory = opendir ( $dir );

$list = array ();
while ( $file = readdir ( $directory ) ) {
	if ($file != '.' and $file != '..') {
		
		$ctime = filectime ( $dir . "/" . $file ) . ',' . $file;
		
		$list [$ctime] = $dir . "/" . $file;
	}
}
closedir ( $directory );

krsort ( $list );

foreach ( $list as $file ) 

{
	
	$name12 = explode ( '/', $file );
	
	$file_name_rdir = $name12 [count ( $name12 ) - 1];
	
	$x = explode ( '.', $file_name_rdir );
	
	date_default_timezone_set ( "Asia/Calcutta" );
	
	$date1 = date ( 'd_m_y', filemtime ( $file ) );
	$today = date ( 'd_m_y' );
	
	if ($date1 < $today) {
		if ($date1 < $today - 14) {
			$filetime = date ( " d/m/Y", filemtime ( $file ) );
		} else {
			$filetime = date ( " D h:i A", filemtime ( $file ) );
		}
	} else {
		$filetime = date ( "h:i A", filemtime ( $file ) );
	}
	
	$y = explode ( '_', $file_name_rdir );
	$y [1] = wordlimit ( $y [1] );
	
	echo " <div class='mailbox'>
	<div class='checkbox'><input type='checkbox' value='" . $file . "' name='mail'></div>";
	
	echo "<a href='sentmaildisplay.php?filename=" . $file . "&subject=" . $y [1] . "' style='color:rgb(206,206,206);text-decoration:none;'>
        
   
  	 <div class='sender'>" . $y [0] . "</div>
	 <div class='subject'>" . $y [1] . "</div>
 	 <div class='date'>" . $filetime . "</div>
   </a></div>";
}
function wordlimit($str) {
	if (strlen ( $str ) < 67) {
		
		return $str;
	}
	
	$str = substr ( $str, 0, 64 );
	
	$str = trim ( $str );
	$n = strrpos ( $str, " " );
	
	$str = substr ( $str, 0, $n );
	return $str . "...";
}

?>
<?php

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

?>












</body>
</html>