<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	include "inc/connect.php"; 	
	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);
	
	$username = $_POST['name'];
	$password = $_POST['pass'];
 
 	$sql = "SELECT * from user WHERE name = '$username' AND password = '$password';";
	
	$result = mysql_query($sql)
           or die(mysql_error()); 
		   
	
 if($arr=mysql_fetch_array($result))
 {
 	echo "登陆成功！"."<br>";
 	echo "欢迎管理员";
 	echo $arr['name'];
 	echo " ."."<br>";
 		 	//注册用户  
    ob_start();  
    session_start();  
    echo "正在跳转到管理员界面！";
    echo "<meta http-equiv='refresh' content='1; url=admin_operation.html'>";
    //身份验证成功，进行相关操作  
    // echo "已登录<br>";  
    //echo "请点<a href='operation.php'>这里</a>继续操作";   	
mysql_close( $link );
}
else
{
	echo "登陆失败，请<a href='u_login.html'>重新登录</a>";  
    die();  
}

	
	
?>
</body>
</html>