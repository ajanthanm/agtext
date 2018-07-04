<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
mysql_connect("localhost","root","");
mysql_select_db("agtext");
if($_POST)
{
	$color=$_POST["textfield1"];
	$sql="insert into color(name)values('$color')";
	
	mysql_query($sql);
	echo "$sql";
	//print_r($i);

}
else
{
echo "success";
}
?>

</body>
</html>
