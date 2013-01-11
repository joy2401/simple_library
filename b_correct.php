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

$num = $_POST['number'];
$name = $_POST['name'];
//$num = $_POST ['number'];
$status = $_POST['status'];
$amount = $_POST['amount'];
$writer = $_POST['writer'];
$press = $_POST['press'];
$type = $_POST['type'];

if( !$num ) 
{
	echo "修改的书本编号不能为空!"."<br>";
	echo "请点"."<a href='b_correct.html' target='_self'>这里</a>"."重新修改！";
}
else if ( !($name || $status || $amount || $writer || $press || $type  ) )
{
	echo "修改的内容全为空!"."<br>";
	echo "请点"."<a href='correct.html' target='self'>这里</a>"."重新修改！";
}
else 
{
	if(! is_numeric($num))
	{
		echo "书本编号输入不合法<br>";
		echo "请点"."<a href='correct.html' target='self'>这里</a>"."重新添加！";
		die();
	}

  $sql1 = "SELECT * from book WHERE bnumber = '$num';";
  
  $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	  echo "修改前书本信息如下：<br>";
    	echo "<table border='1'>";
      echo "<tr> <th>名称</th> <th>编号</th> <th>状态</th>  <th>馆中数量</th> <th>作者</th> <th>出版社</th> <th>类型</th></tr>";
      echo "<tr> <td>".$rs['bname']."</td>";
      echo " <td>".$rs['bnumber']."</td>";
      echo "<td>".$rs['status']."</td>";
      echo "<td>".$rs['bamount']."</td>";
      echo "<td>".$rs['writer']."</td>";
      echo "<td>".$rs['press']."</td>";
      echo "<td>".$rs['type']."</td>";
      echo " </tr>";
      echo "</table>";
      echo "<br><br><br><br>";
      
      //避免查询语句里出现”，“号
      $sql2 = "UPDATE book SET bnumber = '$num'" ;
      if ( $name ) $sql2 = $sql2.",bname = '$name'";
      if ( $status ) $sql2 = $sql2.",status = '$status'";
      if ( $amount ) $sql2 = $sql2.",bamount = '$amount'";
      if ( $writer ) $sql2 = $sql2.",writer = '$writer'";
      if ( $press ) $sql2 = $sql2.",press = '$press'";
      if ( $type ) $sql2 = $sql2.",type = '$type'";
      $sql2 = $sql2." where bnumber = '$num'" ;
      
      mysql_query($sql2) or die(mysql_error());
      
      $sql1 = "SELECT * from book WHERE bnumber = '$num';";
      $result1 = mysql_query($sql1)
                or die(mysql_error());
      $rs = mysql_fetch_array($result1 , MYSQL_ASSOC);
      
      echo "修改后书本信息如下：<br>";
    	echo "<table border='1'>";
      echo "<tr> <th>名称</th> <th>编号</th> <th>状态</th>  <th>馆中数量</th> <th>作者</th> <th>出版社</th> <th>类型</th></tr>";
      echo "<tr> <td>".$rs['bname']."</td>";
      echo " <td>".$rs['bnumber']."</td>";
      echo "<td>".$rs['status']."</td>";
      echo "<td>".$rs['bamount']."</td>";
      echo "<td>".$rs['writer']."</td>";
      echo "<td>".$rs['press']."</td>";
      echo "<td>".$rs['type']."</td>";
      echo " </tr>";
      echo "</table>";
      echo "<br><br><br><br>";
	  echo '<br><a href="admin_operation.html">返回</a>';
  	
  }
  else
  {
  	echo "修改的书本编号不存在!"."<br>";
   	echo "请点"."<a href='b_correct.html' target='_self'>这里</a>"."重新修改！";
   }
    mysql_close( $link );
}
?>
</body>
</html>