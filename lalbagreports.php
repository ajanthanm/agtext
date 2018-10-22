<?php 
include('template/header.php');
?>
<center><h3>View reports</h3></center>



<?php


$select=mysql_query("SELECT * FROM `designs` where name like '%lalbag%'");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<form action="lalbagreports.php"  method="get" id="formID">
<table align="left">
<tr>
<td>Start Date </td><td><input type="text"  class='validate[required] datepicker' style="width:150px;" type="text" name="stdate"  ></td>
<td>End Date</td><td><input id="datepicker" class='validate[required] datepicker' style="width:150px;" type="text" name="endate" ></td>
<td></td><td><input type="submit" value="Submit" class="btn btn-primary"></td>
</tr>
</table>
</form>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Design name</th>
<th>Avg weight</th>
<th>Cotton Weight</th>
<th>Cotton rate</th>
<th>300 Poly rate</th>
<th>150 Black</th>
<th>Couli amount</th>
<th>Total amount</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
if($_GET && $_GET['stdate']){
$stdate = strtotime($_GET['stdate']);
$endate = strtotime($_GET['endate']);
} else {
	$stdate = strtotime("-90 day", time());
	$endate = time();
}
$avgrate["48-Lalbag Jacd"] = 0.080;
$avgrate["54-Lalbag Jacd"] = 0.093;
$avgrate["60-Lalbag Jacd"] = 0.101;
$avgrate["63-Lalbag Jacd"] = 0.108;
$avgrate["74-Lalbag Jacd"] = 0.130;
$avgrate["60-Lalbag patta jacd"] = 0.101; 

$avgrate150["48-Lalbag Jacd"] = 0.027;
$avgrate150["54-Lalbag Jacd"] = 0.031;
$avgrate150["60-Lalbag Jacd"] = 0.034;
$avgrate150["63-Lalbag Jacd"] = 0.036;
$avgrate150["74-Lalbag Jacd"] = 0.042;
$avgrate150["60-Lalbag patta jacd"] = 0.034;

$avgrate300["48-Lalbag Jacd"] = 0.054;
$avgrate300["54-Lalbag Jacd"] = 0.062;
$avgrate300["60-Lalbag Jacd"] = 0.067;
$avgrate300["63-Lalbag Jacd"] = 0.072;
$avgrate300["74-Lalbag Jacd"] = 0.086;
$avgrate300["60-Lalbag patta jacd"] = 0.067;

$yarnrate = yarnrate($stdate, $endate);
$poly300Data = ["300-Poly Red", "300-Poly S Blue", "300-Poly Gold", "300-Poly N Brown", "300-Poly Green"];
$poly300rate = yarnrateByPolyName($stdate, $endate, $poly300Data);
//$poly300rate = yarnrateByPolyName($stdate, $endate, $poly300Data)+yarnrateByPolyName($stdate, $endate, "300-Poly S Blue")+yarnrateByPolyName($stdate, $endate, "300-Poly Gold")+yarnrateByPolyName($stdate, $endate, "300-Poly N Brown")+yarnrateByPolyName($stdate, $endate, "300-Poly Green");
$poly150rate = yarnrateByPolyName($stdate, $endate, ["150-Poly Black"]);
$rate6 = yarnrateByName($stdate, $endate, "6-Black");
while($fetch = mysql_fetch_assoc($select)) {
	$avgwait = avgwait($fetch["id"], $stdate, $endate);
	if($avgwait != 0){
		$cottonWeight = $avgwait['avgwait']-$avgrate[$fetch["name"]];
		$couliamnt = coulirate($fetch["id"], $stdate, $endate);
	  	$cottonRate = round((round($cottonWeight,3)*$rate6),3);
		$poly300 = ($poly300rate + 6)*$avgrate300[$fetch["name"]];
		$poly150 = ($poly150rate + 6)*$avgrate150[$fetch["name"]];
		
		$totalamount = $cottonRate + $poly300 + $poly150 +($couliamnt+1.25);
		
		echo "<tr><td>{$i}</td><td>".($fetch["name"])."</td><td>".round($avgwait['avgwait'],3)."</td><td>".round($cottonWeight,3)."</td><td>".$cottonRate."</td><td>".round($poly300,2)."</td><td>".round($poly150,2)."</td><td>".round(($couliamnt+1.25),2)."</td><td>".round($totalamount,2)."</td></tr>";
		$i++;
	}
}
?>
</tbody>
</table>
</body>
</html>