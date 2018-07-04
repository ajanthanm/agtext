<?php 
include('template/header.php');
$colors = getData('color');
$designs = getData('designs');
$userid = $_REQUEST['userid'];
$users = getSingleData('users',$userid);
$paavuno = getSqlData("select max(paavuno) as paavuno from paavus where userid = {$userid};");
$prtno = $paavuno[0]["paavuno"] + 1;
if(isset($_GET['id'])){
	$paavu = getSingleData('paavus',$_GET['id']);
	$paavu = $paavu[0];
	$edit = true;
}else {
	$paavu = [];
	$edit = false;
}
?>
<div class="back"><a href="paavu.php?userid=<?php echo $userid; ?>"><input type="button" value="Back" class="btn btn-info"></a></div>
<center>
<form action="paavu.php?userid=<?php echo $userid; ?>" method="post" id="formID">
<input type="hidden" name="type" > 
<?php if($edit){ ?>
<input type="hidden" name="id" value="<?php echo $paavu['id']; ?>">
<?php } else { ?>
<input type="hidden" name="paavuno" value="<?php echo $prtno; ?>">
<?php } ?>
<h3>paavu details</h3>
<table>
<tr><td>Design Name</td><td><select name="name" class='validate[required]'>
<option value="">--select--</option>
<?php
	foreach($designs as $key=>$val){
		if($val['id'] == $paavu['name']){
			echo "<option value=".$val['id']." selected >".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td></tr>
<tr><td>User</td><td> <?php echo $users[0]['name']; ?></td></tr>
<tr><td>Price Per/Meter </td><td><input type="text" name="price" class='validate[required,custom[number]]' size="25" value="<?php echo editData($paavu, 'price'); ?>"></td></tr>
<tr><td>Color</td><td><input type="text" name="color" size="25" class='validate[required]' value="<?php echo editData($paavu, 'color'); ?>"></td></tr></table>
<input type="submit" id="submit" <?php echo (!$edit)?"id='submit'":''?> value="Submit" class="btn btn-primary">



</form>
</center>
</body>
</html>
