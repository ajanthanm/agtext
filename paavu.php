<?php 
include('template/header.php');
?>
<?php
$userid=$_REQUEST["userid"];
if($_POST) {
	$name=$_POST["name"];
	$color=$_POST["color"];
	
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		$data['name'] = $_POST["name"];
		$data['color'] = $_POST["color"];
		$data['price'] = $_POST["price"];
		updateData("paavus",$data,$updateData);	
	} else {
		$data['paavuno']=$_POST["paavuno"];
		$data['name'] = $_POST["name"];
		$data['color'] = $_POST["color"];
		$data['price'] = $_POST["price"];
		$data['userid'] = $userid;
		insertData("paavus", $data);
		
	}
}
$select=mysql_query("SELECT * FROM `paavus` where userid = '".$userid."'");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
  $users = getSingleData('users',$userid);
//$fetch=mysql_fetch_array($select);

?>


<center><h3>Paavu details - <?php echo $users[0]['name']; ?></h3></center>
<div class="back"><a href="users.php"><input type="button" value="Back" class="btn btn-info"></a></div>
<div align="right"><a href="addpaavu.php?userid=<?php echo $userid; ?>"><input type="button" value="Addpaavu" class="btn btn-primary"></a></div>


<table id="example1" border="0">
<thead>
<tr>
<th>P.No</th>
<th>Design name</th>
<th>users</th>
<th>date</th>
<th>color</th>
<th>status</th>
<th>Action</th>
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
echo "<tr><td>".$fetch["paavuno"]."</td><td><a href='paavudetails.php?userid={$userid}&paavuid=".$fetch["id"]."'>".getDataByName('designs', $fetch["name"], 'name')."</a></td><td>".getDataByName('users', $fetch["userid"], 'name')."</td><td>".$fetch["date"]."</td><td>".$fetch["color"]."</td><td>{$st}</td><td><a href='addpaavu.php?id=".$fetch["id"]."&userid=".$userid."'>Edit</a></td></tr>";
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
<br>
<?php
$select=mysql_query("SELECT * FROM `transactions` where userid = '".$userid."' order by id desc");
$sno = 1;
$total = 0;
$paavuamnount = 0;

while($fetch = mysql_fetch_assoc($select)) {
if($fetch["paavuid"] == 0){
	$paavuid = getSingleData("returnpavudetails", $fetch["paavudetailid"]);
	$paavuid = empty($paavuid)?0:$paavuid[0]['paavuid'];
} else {
	$paavuid = $fetch["paavuid"];
}

$paavus = getSingleData('paavus',$paavuid);
if(!empty($paavus)){
	$paavuno = $paavus[0]['paavuno'].'-'.getDataByName('designs', $paavus[0]['name'], 'name');
}else{
	$paavuno = '';
}

$total += $fetch["amount"];
$paavuamnount += $fetch["paavu_amount"];

}
?>
<strong>
Voucher Amount :<?php echo $total; ?><br/>
Cooli Amount :<?php echo $paavuamnount; ?><br/>
------------------------------<br/>
Balance Amount : <?php echo  (float)$paavuamnount - (float)$total; ?>
</strong>
</html>
