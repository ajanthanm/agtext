<?php 
include('template/header.php');
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('yarns', $_GET['id']);
	$edit = true;
	$thread = $data[0];

}
?>
<form action="yarn.php"  method="post" id="formID">
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<center>
<table  >
<tr><td width="150">Name</td><td width="150"><input type="text" class='validate[required, ajax[ajaxNameCall]]' id='yarnid' name="name" size="25" width="150" title="<?php if(isset($thread['id'])){ echo $thread['id'];} else {echo '0';} ?>" value="<?php if(isset($thread['name']))echo ($thread['name']); ?>"></td></tr>

<tr><td height="26">Address</td>
<td><textarea name="address" size="25" class='validate[required]' ><?php if(isset($thread['address'])){echo $thread['address'];} ?></textarea></td></tr>
</table>
<input type="submit"  <?php echo (!$edit)?"id='submit'":''?> value="Submit" class="btn btn-primary">
</center>
</form>
</body>
</html>
