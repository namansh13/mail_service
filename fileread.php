<?php

$file="user/naman/inbox/unread/naman_Testing is good for application_14104349142903.txt";
$buffer=fread($file,filesize("words.txt"));
echo $buffer;



fclose($file);

?>