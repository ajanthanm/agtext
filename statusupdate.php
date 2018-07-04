<?php 
include('template/header.php');
$colors = getData('color');
$designs = getData('designs');
$userid = $_REQUEST['userid'];
$paavuid = $_REQUEST["paavuid"];
$users = getSingleData('users',$userid);
$paavus = getSingleData('paavus',$paavuid);
$userPaavu = getSingleDataByName('paavus', $userid, 'userid');

if(isset($_POST['type']) && $_POST['type'] == 'close'){
	$updateData["id"] = $paavuid;
	$data['status'] = 1;
	$data['statusupdate'] = "close";
	
	if(isset($_POST['amount']) && $_POST['amount']){
		$transaction["userid"] = $userid;
		$transaction["paavuid"] = $paavuid;
		if($_POST['kg'] < 0){
			$transaction["paavu_amount"] = $_POST['amount'];
		} else {
			$transaction["paavu_amount"] = -($_POST['amount']);
		}
		$transaction["date"] = time();
		insertData("transactions", $transaction);
		$data['closeamount'] = $transaction["paavu_amount"];
	}
	updateData("paavus", $data, $updateData);
	echo "updated successfully";
	
	$url = 'paavu.php?userid='.$userid;
	echo("<script>location.href = '".$url."';</script>");
} else if(isset($_POST['type']) && $_POST['type'] == 'carryforward'){
	$updateData["id"] = $paavuid;
	$data['status'] = 1;
	$data['statusupdate'] = "carryforward";
	$data["carry_paavuid"] = $_POST['userpaavuid'];
	updateData("paavus", $data, $updateData);
	if($_POST['kg'] > 0){
		$datapaavu["paavuid"] = $_POST['userpaavuid'];
		$datapaavu["carry_paavuid"] = $paavuid;
		$datapaavu["kg"] = $_POST['kg'];
		$datapaavu["date"] = time();
		insertData("paavudetails", $datapaavu);
	} else {
		$datapaavu["paavuid"] = $_POST['userpaavuid'];
		$datapaavu["carry_paavuid"] = $paavuid;
		$datapaavu["weight"] = abs($_POST['kg']);
		$datapaavu["meter"] = 0;
		$datapaavu["amount"] = 0;
		$datapaavu["date"] = time();
		insertData("returnpavudetails", $datapaavu);
		
		
	}
	echo "updated successfully";
	$url = 'paavu.php?userid='.$userid;
	echo("<script>location.href = '".$url."';</script>");
} else if(isset($_POST['type']) && $_POST['type'] == 'close'){
	$url = 'paavu.php?userid='.$userid;
	echo("<script>location.href = '".$url."';</script>");
	//header('Location:paavu.php?userid='.$userid);
}

$select=mysql_query("SELECT sum(kg) as kg FROM paavudetails where paavuid = {$paavuid}");
if (mysql_num_rows($select) > 0) {
    while($addpaavu = mysql_fetch_assoc($select)) {
		$addpaavuKg = $addpaavu['kg'];
		
	}
}
$select=mysql_query("SELECT sum(weight) as kg FROM returnpavudetails where paavuid = {$paavuid}");
if (mysql_num_rows($select) > 0) {
    while($returnpaavu = mysql_fetch_assoc($select)) {
		$returnpaavuKg = $returnpaavu['kg'];
		
	}
}

$weightDiff = $addpaavuKg - $returnpaavuKg;
$weightDiffDisplay = $returnpaavuKg - $addpaavuKg;
?>
<div class="back"><a href="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<center>
<form action="statusupdate.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>" method="post" id="formID" >

<h3>Status Update</h3>
<table>
<tr><td>Paavu Name</td><td><?php echo getDataByName('designs', $paavus[0]['name'], 'name'); ?></td></tr>
<tr><td>User</td><td> <?php echo $users[0]['name']; ?></td></tr>
<tr><td>Weight difference</td><td><?php echo $weightDiffDisplay; ?></td></tr>
<input type="hidden" name="kg" value="<?php echo $weightDiff; ?>">

<?php if($weightDiff != 0){

?>
<tr><td>Type </td><td><select name="type" onchange="updateType(this.value);" id="type" class='validate[required]'>
<option value="">--select--</option>
<option value="carryforward">carryforward</option>
<option value="close">close</option>
</select></td></tr>
<tr id="design"><td>Design Name</td><td><select name="userpaavuid" id="userpaavuid" class='validate[required]'>
<?php
	foreach($userPaavu as $key=>$val){
		if($paavuid != $val['id'] && $val['status'] == 0){
			echo "<option value=".$val['id'].">".$val['paavuno']."-".getDataByName('designs', $val['name'], 'name')."</option>";
		}
	}
?>
</select></td></tr>


<tr id="amount"><td>Amount </td><td><input type="text" name="amount" size="10" class='validate[required,custom[number]]'></td></tr>

<tr><td></td><td><input type="submit" id="submit" value="Status update" onclick="return checkData();" class="btn btn-primary"></td></tr>
<?php } else { ?>
<input type="hidden"  value="close" name="type">
<tr><td></td><td><input type="submit" id="submit" value="Close" class="btn btn-primary"></td></tr>
<?php } ?>

</table>




</form>
</center>
<script>
$("#amount").hide();
		$("#design").hide();
function updateType(value){
	if(value == 'carryforward'){
		$("#amount").hide();
		$("#design").show();
	} else if(value == 'close') {
		$("#amount").show();
		$("#design").hide();
	}
}

function checkData(){
	
	if($("#userpaavuid").val() == null && $("#type").val() == 'carryforward'){
		alert("Please select carryforward paavu id");
		return false;
	} else {
		return true;
	}
}
</script>
</body>
</html>
