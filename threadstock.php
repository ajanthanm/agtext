<?php 
include('template/header.php');

?>
<center><h3>Yarn stock details</h3></center>




<?php


$threads = [];
$givenkg = [];
$select=mysql_query("SELECT sum(kg) as kg, color FROM `threads` group by color");
if (mysql_num_rows($select) > 0) {
    while($fetch = mysql_fetch_assoc($select)){
		$threads[$fetch['color']] = $fetch['kg'];
	}
}
$select1=mysql_query("SELECT sum(kg) as kg, color FROM `paavudetails` group by color");
if (mysql_num_rows($select1) > 0) {
    while($fetch = mysql_fetch_assoc($select1)){
		$givenkg[$fetch['color']] = $fetch['kg'];
	}
}

?>
<table id="example" border="0">
<thead>
<tr>
<th>S.no</th>
<th>Color</th>
<th>Balance (Kg)</th>
<th>Bag(s)</th>

</tr>
</thead>
<tbody>
<?php

$sn = 1;
$totalkg = 0;
foreach($threads as $k=>$v) {
	$gkg = (isset($givenkg[$k]))?$givenkg[$k]:0;
	$balnce = round($v,2) - round($gkg, 2);
	$name = getDataByName('color', $k, 'name');
	$polychk = strpos(strtolower($name), 'poly');
	
	if($balnce && $polychk === false){
		$totalkg = $totalkg + $balnce;
		echo "<tr><td>".$sn++."</td><td>".$name."</td><td>".$balnce."</td><td>".($balnce/60)."</td></tr>";
	}
}
?>
</tbody>
</table>

<br>
<br>
<div>

Total KG - <?php echo $totalkg; ?><br>
Total Bags - <?php echo ($totalkg/60); ?>
</div>




</body>
</html>