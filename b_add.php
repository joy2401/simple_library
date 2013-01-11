<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?php
  include "inc/connect.php"; 

$name = $_POST['name'];
$num = $_POST['number'];
$status = $_POST['status'];
$amount = $_POST['amount'];
$writer = $_POST['writer'];
$press = $_POST['press'];
$type = $_POST['type'];

if(!($name && $num && $status && $amount && $writer && $press && $type ) ) 
{
	echo "添加的内容有空信息!"."<br>";
	echo "请点"."<a href='b_add.html' target='_self'>这里</a>"."重新添加！";
}
else
{
if(! is_numeric($num))
	{
		echo "书本编号输入不合法<br>";
		echo "请点"."<a href='b_add.html' target='_self'>这里</a>"."重新添加！";
		die();
	}
	
	 $link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	 $db=mysql_select_db($DBNAME,$link);

     $sql1 = "SELECT * from book WHERE bnumber = '$num';";
  
     $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	echo "编号为".$snum."的书本，已经存在!"."<br>";
  	echo "请点"."<a href='b_add.html' target='_self'>这里</a>"."重新添加！";
  	
  }
  else
  {
  	$sql2 ="INSERT INTO book VALUE ('$num' , '$name' , '$status' , '$amount' , 
                                   '$writer' , '$press' , '$type')";
    $success = mysql_query($sql2)
           or die(mysql_error());
           
    if(!$success)
    {
	   echo "数据库操作失败";
    }
    else
   {           
  	$sql1 = "SELECT * from book WHERE bnumber = '$num';";

    $result = mysql_query($sql1)
           or die(mysql_error()); 
           
    if ($rs = mysql_fetch_array($result , MYSQL_ASSOC))
    {
    	echo "您添加的新书信息如下：<br>";
    	echo "<table border='1'>";
      echo "<tr> <th>新书名称</th> <th>新书编号</th> <th>新书状态</th>  <th>入库数量</th> <th>新书作者</th> <th>新书出版社</th> <th>新书类型</th></tr>";
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
   }
  }
  mysql_close( $link );
}
	
?>

</body>
</html>