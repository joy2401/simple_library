<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
	include "inc/connect.php"; 
  	$link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	$db=mysql_select_db($DBNAME,$link);
	
	$sql="select * from book";
  	$result=mysql_query($sql,$link);
	if($rs = mysql_fetch_array($result , MYSQL_ASSOC))
	{
		echo "图书馆中图书信息如下：<br>";
		echo "<table border='1'>";
		echo "<tr> <th>名称</th> <th>编号</th> <th>状态</th>  <th>馆中数量</th> <th>作者</th> <th>出版社</th> <th>类型</th><th>操作</th></tr>";
		echo "<tr> <td>".$rs['bname']."</td>";
  		echo " <td align='center'>".$rs['bnumber']."</td>";
  		echo "<td align='center'>".$rs['status']."</td>";
 		echo "<td align='center'>".$rs['bamount']."</td>";
  		echo "<td align='center'>".$rs['writer']."</td>";
  		echo "<td align='center'>".$rs['press']."</td>";
  		echo "<td align='center'>".$rs['type']."</td>";
		echo "<td align='center'><a href=b_del_finish.php?id=".$rs['bnumber'].">删除</a></td>";
  		echo " </tr>";
}
	else
{
		echo "数据库中没有可以浏览的信息<br>";
}
	while($rs = mysql_fetch_array($result, MYSQL_ASSOC))
{
		echo "<table border='1'>";
		echo "<tr> <th>名称</th> <th>编号</th> <th>状态</th>  <th>馆中数量</th> <th>作者</th> <th>出版社</th> <th>类型</th><th>操作</th></tr>";
		echo "<tr> <td>".$rs['bname']."</td>";
  		echo " <td>".$rs['bnumber']."</td>";
  		echo "<td>".$rs['status']."</td>";
  		echo "<td>".$rs['bamount']."</td>";
  		echo "<td>".$rs['writer']."</td>";
  		echo "<td>".$rs['press']."</td>";
  		echo "<td>".$rs['type']."</td>";
		echo "<td align='center'>[<a href=b_del_finish.php?id=".$rs['bnumber'].">删除</a>]</td>";
  		echo " </tr>";  
}
	echo "</table>";
	echo '<br><a href="admin_operation.html">返回</a>';
	mysql_close( $link );			
?>

</body>
</html>