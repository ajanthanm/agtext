<?php 
include('template/header.php');
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('users', $_GET['id']);
	$edit = true;
	$thread = $data[0];
}
?>
<form action="users.php"  method="post" id="formID" >
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<center>
<table  >
<tr><td width="150">Name</td><td width="150"><input class='validate[required, ajax[ajaxNameCall]]' title="<?php if(isset($thread['id'])){ echo $thread['id'];} else {echo '0';} ?>" id="userid" type="text" name="name" size="25" width="150" value="<?php if(isset($thread['name']))echo ($thread['name']); ?>"></td></tr>

<tr><td height="35">Mobileno</td>
<td><input type="text" name="mobileno" class='validate[required,custom[number]]' size="25" value="<?php if(isset($thread['mobileno']))echo ($thread['mobileno']); ?>"></td></tr>
<tr><td height="26">Address</td>
<td><textarea name="address" size="25" class='validate[required]' ><?php if(isset($thread['address']))echo ($thread['address']); ?></textarea></td></tr>
</table>
<input type="submit"  <?php echo (!$edit)?"id='submit'":''?> value="Submit" class="btn btn-primary">
</center>
</form>
</body>
</html>
