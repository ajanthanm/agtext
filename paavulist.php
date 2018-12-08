<?php 
include('template/header.php');
?>
<?php


$select=mysql_query("SELECT * FROM `paavus` where status = 0 order by name");

//$fetch=mysql_fetch_array($select);

?>
<center><h3>Paavu details</h3></center>



<table id="example1" border="0">
<thead>
<tr>
<th>P.No</th>
<th>Design name</th>
<th>users</th>
<th>date</th>
<th>color</th>
<th>status</th>

</tr>
</thead>
<tbody>
<?php
$sno = 1;
while($fetch = mysql_fetch_assoc($select)) {
	$st = "In progress";
	if($fetch["status"] == 1){
		$st = "Closed";
	}
echo "<tr><td>".$fetch["paavuno"]."</td><td><a href='paavudetails.php?userid=".$fetch["userid"]."&paavuid=".$fetch["id"]."'>".getDataByName('designs', $fetch["name"], 'name')."</a></td><td>".getDataByName('users', $fetch["userid"], 'name')."</td><td>".date("d-m-Y",strtotime($fetch["date"]))."</td><td>".$fetch["color"]."</td><td>{$st}</td></tr>";
$sno++;
}

?>
</tbody>
</table>
<script>
$('#example1').DataTable({
			"pagingType": "full_numbers",
			"order": [[ 5, "desc" ]]
		});
</script>



</body>
<br>

</html>
