<?php
$files=$_POST['fileArray'];
/*foreach($files as $file)
{
echo $file.",";
}*/

//$files=explode(',',$_POST['fileArray']);
foreach($files as $file){
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
	//header("location:inbox.php");
  }
}

?>