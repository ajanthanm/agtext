
<?php 
include('template/header.php');
$colors = getData('color');
$yarns = getData('yarns');
//$designs = getData('designs');
$thread = [];
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('threads', $_GET['id']);
	$edit = true;
	$thread = $data[0];
} else{
	$thread = [];
}

?>
<div class="container">
<center>
<form  action="thread.php" method="post" id="formID">
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<div class="hr"></div>
<h3 style="margin:0px">Yarn details</h3>
<div class="hr"></div>
<table>
<tr><td>Yarn shop</td><td><select name="yarn" class='validate[required]'>
<?php
	foreach($yarns as $key=>$val){
		if($val['id'] == $thread['yarn']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td></tr>
<tr><td>Date </td><td><input id="datepicker" class='validate[required] datepicker' type="text" name="date"  value="<?php if(isset($thread['date']))echo date('d-m-Y',$thread['date']); ?>"></td></tr>
<tr><td width="150">Bill no </td><td><input type="text"  name="threadno" size="25" width="150" value="<?php if(isset($thread['threadno']))echo ($thread['threadno']); ?>"></td></tr>
<tr><td>Color/size</td><td><select name="color" class='validate[required]'>
<?php
	foreach($colors as $key=>$val){
		if($val['id'] == $thread['color']) {
			echo "<option selected ='selected' value=".$val['id'].">".$val['name']."</option>";
		} else {
			echo "<option value=".$val['id'].">".$val['name']."</option>";
		}
	}
?>
</select></td></tr>
<tr><td style="color:none">Kg</td><td><input class='validate[required,custom[number]]' type="text" name="kg" size="25" value="<?php if(isset($thread['kg']))echo $thread['kg']; ?>"></td></tr>
<tr><td>Price </td><td><input type="text" class='validate[required, custom[number]]' name="price" size="25" value="<?php if(isset($thread['price']))echo $thread['price']; ?>"></td></tr>



</table>
<input type="submit" id="submit" value="Submit" class="btn btn-primary">




</form>
</center>
</div>
</div>
</body>
</html>
