<html>

<style>
body{
    
    color: rgb(136,136,136);
    text-align: center;
   background-image: url(<?php echo "/background/login3.jpg";?>);
   -webkit-background-size: cover;
  }
.content{
    position:relative;
    width:375px;
    margin:0 auto;
    top:150px ;
   
    background: rgba(0, 0, 0, 0.2)
    text-align: center;
    
}
label{

display:inline-block;
width:130px;
//margin-right:30px;
text-align:left;

}

</style>
<body>
<div class="content">
<form action="forgetpasswordrecall.php" method="post">

<label for='username'>User Name : </label><input type='text' name='username' ><br>
<label for='email2'>Secondary Email : </label><input type='text' name='email2' ><br>
<input type="submit" value="Submit" name="submit">





</div>
</body>
</html>
