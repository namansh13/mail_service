
<?php
session_start ();
include 'database_config.php';

$to = $_POST ['to'];
$subject = $_POST ['subject'];

$message = $_POST ['message'];
$message = wordwrap ( $message, 100, PHP_EOL );

$from = getemail ( $_SESSION ["username"] );
$cc = $_POST ['cc'];
$bcc = $_POST ['bcc'];

$header = "From: $from \r\n";
// $header = "Cc: $_POST['cc'] \r\n";
// $header = "Bcc: $_POST['bcc'] \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
$retval = mail ( $to, $subject, $message, $header );
if ($retval == true) {
	
	$_SESSION ['mailmessage'] = "Message sent successfully...";
	
	$filename = SentMailWrite ( $from, $to, $cc, $bcc, $subject, $message );
	$array = array ();
	if (! empty ( $to )) {
		$too = explode ( ',', $to );
		
		for($i = 0; $i < count ( $too ); $i ++) {
			
			if (! dest_inboxWrite ( $from, $too [$i], $filename, false, "" )) {
				array_push ( $array, $too [$i] );
			}
		}
	}
	if (! empty ( $cc )) {
		$cc = explode ( ',', $cc );
		
		foreach ( $cc as $value ) {
			if (! dest_inboxWrite ( $from, $value, $filename, false, "" )) {
				array_push ( $array, $value );
			}
		}
	}
	if (! empty ( $bcc )) {
		$bcc = explode ( ',', $bcc );
		foreach ( $bcc as $value ) {
			if (! dest_inboxWrite ( $from, $value, $filename, false, "" )) {
				array_push ( $array, $value );
			}
		}
	}
	if (count ( $array ) > 0)
		dest_inboxWrite ( $from, "", $filename, true, $array );
	header ( "location:homepage.php" );
} else {
	$_SESSION ['mailmessage'] = "Message could not be sent...";
	
	header ( "location:homepage.php" );
}
function getemail($username) {
	$db = mysqli_connect ( HOST, USER, PASSWORD, DATABASE );
	$sql = "SELECT Email FROM " . DATABASE . ".user where username ='$username'";
	$result = mysqli_query ( $db, $sql );
	$row = mysqli_fetch_array ( $result );
	mysqli_close ( $db );
	return $row ['Email'];
}
function SentMailWrite($from, $to, $cc, $bcc, $subject, $message) {
	date_default_timezone_set ( "Asia/Calcutta" );
	$sent = date ( "D j/m/y h:i:s A" );
	
	$dir = "user/" . $_SESSION ["username"] . "/sentmail";
	if (! is_dir ( $dir )) {
		mkdir ( $dir, 0777, true );
	}
	$curr_time = gettimeofday ( true ) * 10000;
	
	$subject = wordlimit ( $subject, 67 );
	
	$filename = $to . "_" . $subject . "_" . $curr_time . ".txt";
	$file = fopen ( $dir . "/" . $filename, "w" ) or die ( "unable to open file" );
	
	fwrite ( $file, "From : " . $from . PHP_EOL . PHP_EOL );
	
	fwrite ( $file, "Sent : " . $sent . PHP_EOL . PHP_EOL );
	
	fwrite ( $file, "To : " . $to . PHP_EOL . PHP_EOL );
	
	if (! empty ( $cc )) {
		
		fwrite ( $file, "Cc : " . $cc . PHP_EOL . PHP_EOL );
	}
	
	if (! empty ( $bcc )) {
		fwrite ( $file, "Bcc : " . $bcc . PHP_EOL . PHP_EOL );
	}
	
	fwrite ( $file, "Subject : " . $subject . PHP_EOL . PHP_EOL );
	
	fwrite ( $file, $message );
	
	fclose ( $file );
	return $dir . "/" . $filename;
}
function dest_inboxWrite($from, $to, $file, $flag, $array) {
	$db = mysqli_connect ( HOST, USER, PASSWORD, DATABASE );
	$sql = "SELECT username FROM " . DATABASE . ".user where Email ='" . $to . "'";
	$result = mysqli_query ( $db, $sql );
	$name = explode ( '/', $file );
	$name1 = explode ( '_', $name [count ( $name ) - 1] );
	
	mysqli_close ( $db );
	if (! $flag) {
		if (mysqli_num_rows ( $result ) == 1) {
			
			$filename = $from . "_" . $name1 [1] . "_" . $name1 [2];
			$row = mysqli_fetch_array ( $result );
			$username = $row ['username'];
			
			$dir = "user/" . $username . "/inbox/unread";
			if (! is_dir ( $dir )) {
				
				mkdir ( $dir, 0777, true );
			}
			
			copy ( $file, $dir . "/" . $filename );
			return true;
		} else {
			
			return false;
		}
	} else
		$array = array_unique ( $array );
	foreach ( $array as $value ) {
		if (! empty ( $value )) {
			$to .= $value . " , ";
		}
	}
	$to = substr ( $to, 0, strlen ( $to ) - 2 );
	$dir = $name [0] . "/" . $name [1] . "/inbox/unread";
	
	$filename = "administer@xyz.com" . "_Mail Failure_" . $to . ".txt";
	copy ( $file, $dir . "/" . $filename );
	
	$errormsg = "user doesnt exist, try to verify the email address";
	$line = "_________________________________________________________________";
	$highlight = "original message";
	
	$content = "' " . $to . "' " . $errormsg . PHP_EOL . PHP_EOL . $line . PHP_EOL . PHP_EOL . $highlight . PHP_EOL . PHP_EOL . file_get_contents ( $dir . "/" . $filename );
	
	file_put_contents ( $dir . "/" . $filename, $content );
	return true;
}
function wordlimit($str, $len) {
	if (strlen ( $str ) < $len) {
		
		return $str;
	}
	
	$str = substr ( $str, 0, $len - 3 );
	
	$str = trim ( $str );
	$n = strrpos ( $str, " " );
	
	$str = substr ( $str, 0, $n );
	return $str . "...";
}

?>
