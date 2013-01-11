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
	
	$sql="select * from reader";
  	$result=mysql_query($sql,$link);
	if($rs = mysql_fetch_array($result , MYSQL_ASSOC))
	{
		echo "读者信息如下：<br>";
		echo "<table border='1'>";
		echo "<tr> <th>读者名称</th> <th>读者编号</th> <th>最大借阅量</th> <th>口令</th><th>操作</th></tr>";
      echo "<tr> <td>".$rs['rname']."</td>";
      echo " <td>".$rs['rnumber']."</td>";
      echo "<td>".$rs['ramount']."</td>";
      echo "<td>".$rs['rpass']."</td>";
	  echo "<td align='center'>[<a href=r_del_finish.php?id=".$rs['rnumber'].">删除</a>]</td>";
  		echo " </tr>";
}
	else
{
		echo "数据库中没有可以浏览的信息<br>";
}
	while($rs = mysql_fetch_array($result, MYSQL_ASSOC))
{
		echo "<table border='1'>";
		echo "<tr> <th>读者名称</th> <th>读者编号</th> <th>最大借阅量</th> <th>口令</th><th>操作</th></tr>";
      echo "<tr> <td>".$rs['rname']."</td>";
      echo " <td>".$rs['rnumber']."</td>";
      echo "<td>".$rs['ramount']."</td>";
      echo "<td>".$rs['rpass']."</td>";
	  echo "<td align='center'>[<a href=r_del_finish.php?id=".$rs['rnumber'].">删除</a>]</td>";
  		echo " </tr>";  
}
	echo "</table>";
	 echo '<br><a href="admin_operation.html">返回</a>';
	mysql_close( $link );			
?>

</body>
</html>