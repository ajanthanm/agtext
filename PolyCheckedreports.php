<?php 
include('template/header.php');
?>
<center><h3>View reports</h3></center>



<?php


$select=mysql_query("SELECT * FROM `designs` where name like '%90-Poly Mini Check%'");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<form action="PolyCheckedreports.php"  method="get" id="formID">
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
<th>Red/Black rate</th>
<th>300 Poly rate</th>
<th>300 Black</th>
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
$avgrate["90-Poly Mini Check"] = 0.100;
//$avgrate["63-Sixer Jacd"] = 0.106;
 

$avgrate150["90-Poly Mini Check"] = 0.050;
//$avgrate150["63-Sixer Jacd"] = 0.053;


$avgrate300["90-Poly Mini Check"] = 0.050;
//$avgrate300["63-Sixer Jacd"] = 0.053;


$yarnrate = yarnrate($stdate, $endate);
$poly300Data = ["300-Poly Red"];
$poly300rate = yarnrateByPolyName($stdate, $endate, $poly300Data);
//$poly300rate = yarnrateByPolyName($stdate, $endate, "150-Poly Maroon")+yarnrateByPolyName($stdate, $endate, "150-Poly Coppie")+yarnrateByPolyName($stdate, $endate, "150-Poly R Blue")+yarnrateByPolyName($stdate, $endate, "150-Poly Red");
$poly150rate = yarnrateByPolyName($stdate, $endate, ["300-Poly Black"]);
$ratered10 = yarnrateByName($stdate, $endate, "10-Red");
$rateblack10 = yarnrateByName($stdate, $endate, "10-Black");
while($fetch = mysql_fetch_assoc($select)) {
	$avgwait = avgwait($fetch["id"], $stdate, $endate);
	if($avgwait != 0){
		$cottonWeight = $avgwait['avgwait']-$avgrate[$fetch["name"]];
		$MiniCheckDivide = round(($cottonWeight/2),3);
		$couliamnt = coulirate($fetch["id"], $stdate, $endate);
	  	$Red10Rate = round(($MiniCheckDivide*$ratered10),3);
		$black10Rate = round(($MiniCheckDivide*$rateblack10),3);
		
		$poly300 = ($poly300rate + 6)*$avgrate300[$fetch["name"]];
		$poly150 = ($poly150rate + 6)*$avgrate150[$fetch["name"]];
		
		$totalamount = $Red10Rate + $black10Rate + $poly300 + $poly150 +($couliamnt+1.25);
		
		echo "<tr><td>{$i}</td><td>".($fetch["name"])."</td><td>".round($avgwait['avgwait'],3)."</td><td>".round($cottonWeight,3)."</td><td>".$Red10Rate."/".$black10Rate."</td><td>".round($poly300,3)."</td><td>".round($poly150,3)."</td><td>".round(($couliamnt+1.25),2)."</td><td>".round($totalamount,2)."</td></tr>";
		$i++;
	}
}
?>
</tbody>
</table>
</body>
</html>