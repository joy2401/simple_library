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
$pass= $_POST['pass'];
$amount = $_POST['amount'];

if(!($name&&$num&&$amount&&$pass)) 
{
	echo "添加的内容有空信息!"."<br>";
	echo "请点"."<a href='r_add.html' target='_self'>这里</a>"."重新添加！";
}
else
{
if(!is_numeric($num))
	{
		echo "读者编号输入不合法<br>";
		echo "请点"."<a href='r_add.html' target='_self'>这里</a>"."重新添加！";
		die();
	}
	
	 $link=mysql_connect($DBHOST,$DBUSER,$DBPWD);
  	 $db=mysql_select_db($DBNAME,$link);

     $sql1 = "SELECT * from reader WHERE rnumber = '$num';";
  
     $result1 = mysql_query($sql1)
                or die(mysql_error());
                
  if($rs = mysql_fetch_array($result1 , MYSQL_ASSOC))
  {
  	echo "编号为".$num."的读者，已经存在!"."<br>";
  	echo "请点"."<a href='r_add.html' target='_self'>这里</a>"."重新添加！";
  	
  }
  else
  {
  	$sql2 ="INSERT INTO reader VALUE ('$name' , '$num' , '$amount' ,  '$pass')";
    $success = mysql_query($sql2)
           or die(mysql_error());
           
    if(!$success)
    {
	   echo "数据库操作失败";
    }
    else
   {           
  	$sql1 = "SELECT * from reader WHERE rnumber = '$num';";

    $result = mysql_query($sql1)
           or die(mysql_error()); 
           
    if ($rs = mysql_fetch_array($result , MYSQL_ASSOC))
    {
    	echo "您添加的新读者信息如下：<br>";
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
   }
  }
  mysql_close( $link );
}
	
?>

</body>
</html>