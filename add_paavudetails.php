<?php 
include('template/header.php');
$userid =$_REQUEST["userid"];
$paavuid =$_REQUEST["paavuid"];
$colors = getData('color');
$paavus = getSingleData('paavus',$paavuid);
$edit = false;
$editid= 0 ;
if(isset($_GET['id'])){
	$data = getSingleData('paavudetails', $_GET['id']);
	$edit = 'edit';
	$detailData = $data[0];
	$editid = $_GET['id'];
	$carryVal = $detailData['carry_paavuid'];
	$threadData = getSingleData('threads', $data[0]['threadid']);
} else {
	$edit = 'add';
	$detailData = [];
	$carryVal = 0;
	$threadData = '';
} 

$sql1 = "select sum(kg) as kg, color from threads where kg > 0 group by color ";
$sqlselect = mysql_query($sql1);
while($fetch = mysql_fetch_assoc($sqlselect)) {
	$thread[$fetch['color']] = $fetch['kg'];
}
$sql1 = "select sum(kg) as kg, color from paavudetails group by color";
$sqlselect = mysql_query($sql1);
while($fetch = mysql_fetch_assoc($sqlselect)) {
	$addpaavu[$fetch['color']] = $fetch['kg'];
}
$balanceThread = [];
foreach($thread as $k=>$v){
	if(!isset($addpaavu[$k])){
		$addpaavu[$k] = 0;
	}
	
	$balanceThread[$k] = $thread[$k] - $addpaavu[$k];
	if(!empty($detailData) && $detailData['color'] == $k){
		$balanceThread[$k] = $balanceThread[$k] + $detailData['kg'];
	}
}

$val = json_encode($balanceThread);
?>
<script>

var balanceThread = <?php echo $val; ?>;
function checkPaavu(cval){
	if(cval != 0){
		return true;
	}
	var kg = $("#kg").val();
	var color = $("#color").val();
	var selVal = $("#color option:selected").text();
	
	if(isNaN(kg) || color == ''){
		kg = 0;
		return false;
	} 
	
	var tkg = balanceThread[color]?balanceThread[color]:0;
	if(tkg < 0) {
		tkg = 0;
	}
	if(selVal.toLowerCase().indexOf('poly') > -1) {
		<?php if($edit == 'edit' && !empty($threadData) && $threadData[0]['kg'] < 0) { ?>
			var tkgVal = <?php echo $threadData[0]['kg']; ?>;
			var bthread = Number(tkg) - Number(kg) + Math.abs(tkgVal);
		<?php } else { ?>
			var bthread = Number(tkg) - Number(kg);
		<?php } ?>
	} else {
		var bthread = Number(tkg) - Number(kg);
	}
	
	bthread = bthread.toFixed(2);
	if(isNaN(bthread) || bthread < 0){
		var text;
		if(selVal.toLowerCase().indexOf('poly') > -1) {
			text = confirm("Do you add yarn stock with (-"+Math.abs(bthread)+")Kg?");
		} else {
			text = confirm("Do you want purchase yarn - "+Math.abs(bthread)+"Kg?");
		}
		
		if(selVal.toLowerCase().indexOf('poly') > -1 && text) {
			window.location.href="addyarnthread.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>&color="+color+"&yarnkg=-"+Math.abs(bthread)+"&kg="+Math.abs(kg)+"&edit=<?php echo $editid; ?>";
		} else if(text) {
			window.location.href="addyarnthread.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>&color="+color+"&yarnkg="+Math.abs(bthread)+"&kg="+Math.abs(kg)+"&edit=<?php echo $editid; ?>";
		} else {
			$("#submit").removeAttr('disabled');
		}
		return false;
	} else {	
		return true;
	}
}
</script>
<div class="back"><a href="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<center>
<form onsubmit="return checkPaavu(<?php echo $carryVal;?>);" action="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>" method="post" id="formID">
<?php if($edit == 'edit') {?>
<input type="hidden" name="id" value="<?php echo $detailData['id']; ?>" >
<?php } ?>
<input type="hidden" name="type" value="add" >
<input type="hidden" name="paavuid" value="<?php echo $paavuid; ?>">
<table >
<tr><td>Design Name</td><td><?php echo getDataByName('designs', $paavus[0]['name'], 'name'); ?></td></tr>

<?php if($carryVal == 0) { ?>
<tr><td>Color/size</td><td><select name="color" id="color" class='validate[required]'>
<option value="">--select--</option>
<?php
	foreach($colors as $key=>$val){
		if($edit == 'edit' && $val['id'] == $detailData['color']){
			echo "<option value=".$val['id']." selected>".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td></tr>
<?php } else {
	echo '<input type="hidden" name="color" value="0" >';
}
?>
<tr><td>Kg</td><td><input type="text" class='validate[required,custom[number]]' name="kg" size="25" id="kg" value="<?php echo editData($detailData, 'kg'); ?>"></td></tr>
<tr><td></td><td><input type="submit" id="submit" value="Submit" class="btn btn-primary"></td></tr>
</table>
</form>
</center>
</body>
</html>
