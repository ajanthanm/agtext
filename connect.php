<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
$my=mysql_connect("localhost","root","");
if(!$my)
 echo "s";
 else
 echo "sucess";

mysql_select_db("food");
$threadno=$_POST["person"];
$date=$_POST["food"];
$kg=$_POST["place"];
$price=$_POST["pet"];
$color=$_POST["tree"];

echo "<br>";
$sql="insert into details (person,food,place,pet,tree)values('$threadno','$date','$kg','$price','$color')";

$i=mysql_query($sql);
if  (!$i)
echo "failed";
else
echo "success"; 


?>
</body>
</html>
