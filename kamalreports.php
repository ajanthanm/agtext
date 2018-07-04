<?php 
include('template/header.php');
?>
<center><h3>View reports</h3></center>



<?php


$select=mysql_query("SELECT * FROM `designs` where name like '%kamal%'");
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
$avgrate["48-Kamal Jacd"] = 0.082;
$avgrate["54-Kamal Jacd"] = 0.086;
 

$avgrate150["48-Kamal Jacd"] = 0.041;
$avgrate150["54-Kamal Jacd"] = 0.043;


$avgrate300["48-Kamal Jacd"] = 0.041;
$avgrate300["54-Kamal Jacd"] = 0.043;


$yarnrate = yarnrate($stdate, $endate);
$poly300Data = ["150-Poly Maroon", "150-Poly Coppie", "150-Poly R Blue", "150-Poly Red"];
$poly300rate = yarnrateByPolyName($stdate, $endate, $poly300Data);
//$poly300rate = yarnrateByPolyName($stdate, $endate, "150-Poly Maroon")+yarnrateByPolyName($stdate, $endate, "150-Poly Coppie")+yarnrateByPolyName($stdate, $endate, "150-Poly R Blue")+yarnrateByPolyName($stdate, $endate, "150-Poly Red");
$poly150rate = yarnrateByPolyName($stdate, $endate, ["150-Poly Black"]);
$rate6 = yarnrateByName($stdate, $endate, "6-White-");
while($fetch = mysql_fetch_assoc($select)) {
	$avgwait = avgwait($fetch["id"], $stdate, $endate);
	if($avgwait != 0){
		$cottonWeight = $avgwait['avgwait']-$avgrate[$fetch["name"]];
		$couliamnt = coulirate($fetch["id"], $stdate, $endate);
	  	$cottonRate = round((round($cottonWeight,3)*$rate6),2);
		$poly300 = ($poly300rate + 6)*$avgrate300[$fetch["name"]];
		$poly150 = ($poly150rate + 6)*$avgrate150[$fetch["name"]];
		
		$totalamount = $cottonRate + $poly300 + $poly150 +($couliamnt+1.25);
		
		echo "<tr><td>{$i}</td><td>".($fetch["name"])."</td><td>".round($avgwait['avgwait'],3)."</td><td>".round($cottonWeight,3)."</td><td>".$cottonRate."</td><td>".round($poly300,3)."</td><td>".round($poly150,3)."</td><td>".round(($couliamnt+1.25),2)."</td><td>".round($totalamount,3)."</td></tr>";
		$i++;
	}
}
?>
</tbody>
</table>
</body>
</html>