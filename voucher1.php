<?php 
include('template/header.php');
$userid = $_REQUEST['userid'];
$users = getSingleData('users',$userid);
?>

<center><h3>Thread Delivery Slip</h3></center>



<fieldset style="width:300px;">

<?php
$time = strtotime('today');
$select=getSqlData("select a.name, b.date, b.color, b.kg from  paavus a, paavudetails b where a.userid = ".$userid." and a.id = b.paavuid and b.color != 0 and b.date > {$time}");

//$fetch=mysql_fetch_array($select);
?>
<!--
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Paavu name</th>
<th>Kg</th>
<th>Color/Size</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
foreach($select as $key=>$fetch) {
echo "<tr><td>{$i}</td><td>".$fetch["name"]."</td>
	      <td>".$fetch["kg"]."</td><td>".$fetch["color"]."</td><td>".$fetch["date"]."</td><td>Action</td></tr>";
$i++;
}
?>
</tbody>
</table>-->
<br/>
<?php 
if(!$select){
	echo "No data to print";
}else{
?>
<div id="print">
<style>
.tableprint tr td{
	border:1px solid #BBB;
}
</style>
<center>Agathiar textiles</center>
<div class="row" >65, Kamarajapuram, karur</div>
<div class="row" ><div style="float:left;width:100px;">No. 1 </div><div style="float:right;">Date : 30-11-2016</div></div><br/>
<div class="row" style="float:left;width:100px;" >Mr. <?php echo $users[0]['name']; ?></div>

<table class="tableprint" width="340px">
	<thead>
		<tr >
			<td>S.No</td>
			<td>Color</td>
			<td>Weight (Kg)</td>
			<td>Bag</td>
			
		</tr>
	</thead>
	<tbody>
	
	<?php
	$j = 1;	
	foreach($select as $k=>$fetch) { 
	?>
		<tr >
			<td><?php echo $j++; ?></td>
			<td><?php echo getDataByName('color', $fetch["color"], 'name'); ?></td>
			<td><?php echo $fetch["kg"]; ?></td>
			<td><?php echo $fetch["kg"]/60; ?></td>
		</tr>
	<?php } ?>	
	</tbody>
</table>
</div>
</fieldset>

<input type="button" value="Print" id="printMe"  />
<?php
}
?>

<div>

</div>
</body>

</html>