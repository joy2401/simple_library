<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改读者信息</title>
</head>

<body>
<?php
include "inc/connect.php"; 	
	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);

$name = $_POST['name'];
$num = $_POST['number'];
$amount = $_POST['amount'];
$pass= $_POST['pass'];

if( !$num ) 
{
	echo "修改的读者编号不能为空!"."<br>";
	echo "请点"."<a href='r_correct.html' target='_self'>这里</a>"."重新修改！";
}
else if ( !($name || $amount || $pass || $num  ) )
{
	echo "修改的内容全为空!"."<br>";
	echo "请点"."<a href='correct.html' target='self'>这里</a>"."重新修改！";
}
else 
{
	if(! is_numeric($num))
	{
		echo "读者编号输入不合法<br>";
		echo "请点"."<a href='correct.html' target='self'>这里</a>"."重新添加！";
		die();
	}

  $sql1 = "SELECT * from reader WHERE rnumber = '$num';";
  
  $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	  echo "修改前读者信息如下：<br>";
    	echo "<table border='1'>";
      echo "<tr> <th>读者名称</th> <th>读者编号</th> <th>最大借阅量</th> <th>口令</th></tr>";
      echo "<tr> <td>".$rs['rname']."</td>";
      echo " <td>".$rs['rnumber']."</td>";
      echo "<td>".$rs['ramount']."</td>";
      echo "<td>".$rs['rpass']."</td>";
      echo " </tr>";
      echo "</table>";
      echo "<br>";
      
      //避免查询语句里出现”，“号
      $sql2 = "UPDATE reader SET rnumber = '$num'" ;
      if ( $name ) $sql2 = $sql2.",rname = '$name'";
      if ( $pass ) $sql2 = $sql2.",rpass = '$pass'";
      if ( $amount ) $sql2 = $sql2.",ramount = '$amount'";
      if ( $num ) $sql2 = $sql2.",rnumber = '$num'";
      $sql2 = $sql2." where rnumber = '$num'" ;
      
      mysql_query($sql2) or die(mysql_error());
      
      $sql1 = "SELECT * from reader WHERE rnumber = '$num';";
      $result1 = mysql_query($sql1)
                or die(mysql_error());
      $rs = mysql_fetch_array($result1 , MYSQL_ASSOC);
      
      echo "修改后读者信息如下：<br>";
    	echo "<table border='1'>";
      echo "<tr> <th>读者名称</th> <th>读者编号</th> <th>最大借阅量</th> <th>口令</th></tr>";
       echo "<tr> <td>".$rs['rname']."</td>";
      echo " <td>".$rs['rnumber']."</td>";
      echo "<td>".$rs['ramount']."</td>";
      echo "<td>".$rs['rpass']."</td>";
      echo " </tr>";
      echo "</table>";
      echo "<br>";
	  echo '<br><a href="admin_operation.html">返回</a>';
  	
  }
  else
  {
  	echo "修改的读者编号不存在!"."<br>";
   	echo "请点"."<a href='r_correct.html' target='_self'>这里</a>"."重新修改！";
   }
    mysql_close( $link );
}
?>
</body>
</html>