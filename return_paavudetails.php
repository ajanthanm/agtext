<?php 
include('template/header.php');
$userid =$_REQUEST["userid"];
$paavuid =$_REQUEST["paavuid"];
$designs = getData('designs');
$colors = getData('color');
$paavus = getSingleData('paavus',$paavuid);

$edit = false;
$thread = [];
if(isset($_GET['id'])){
	$edit = true;
	$data = getSingleData('returnpavudetails', $_GET['id']);
	$edit = true;
	$thread = $data[0];
	
}

?>

<div class="back"><a href="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<center>

<h3>Design Name : <?php echo getDataByName('designs', $paavus[0]['name'], 'name');  ?>, Color : <?php echo $paavus[0]['color']  ?> </h3>

<form  action="paavudetails.php?userid=<?php echo $userid; ?>&paavuid=<?php echo $paavuid; ?>" method="post" autocomplete="off" id="formID">
<input type="hidden" name="type" value="return" >
<?php if($edit){ ?>
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" >
<?php } ?>
<input type="hidden" name="paavuid" value="<?php echo $paavuid; ?>">
<table>

<tr><td>Design Name</td><td><select name="design" >
<option value="0">--select--</option>
<?php

	foreach($designs as $key=>$val){
		if($edit == true && $val['id'] == $thread['design']){
			echo "<option value=".$val['id']." selected>".$val['name']."</option>";
		} else if($val['id'] == $paavus[0]['name']) {	
			echo "<option value=".$val['id']." selected>".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
		
	}
?>
</select></td></tr>
<tr><td>Rolls</td><td><input type="text" name="roles" value="<?php echo editData($thread, 'roles'); ?>" class='validate[required,custom[number]]'></td></tr>
<tr><td>Weight</td><td><input type="text" name="weight" value="<?php echo editData($thread, 'weight'); ?>" class='validate[required,custom[number]]'></td></tr>
<tr><td>Meter </td><td><input type="text" name="meter" value="<?php echo editData($thread, 'meter'); ?>" class='validate[required,custom[number]]'></td></tr>
<tr><td>Price/Meter</td><td><input type="text" name="amount" value="<?php if($edit == true) { echo editData($thread, 'amount'); } else { echo $paavus[0]['price']; } ?>" class='validate[required,custom[number]]' ></td></tr>
<tr><td>Date </td><td><input type="text" name="date" value="<?php if(empty(editData($thread, 'date'))){echo '';}else{echo date('d-m-Y',editData($thread, 'date'));} ?>" class='validate[required] datepicker'></td></tr>
<tr><td></td><td>
<input type="submit" id="submit" value="Submit" class="btn btn-primary"></td></tr>
</table>
</form>
</center>



</body>
</html>