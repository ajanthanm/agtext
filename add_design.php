<?php 
include('template/header.php');
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('designs', $_GET['id']);
	$edit = true;
	$thread = $data[0];
}
?>
<center>
<form  action="designs.php" method="post" id="formID">
<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<table >
<tr><td>Design name</td>
<td><input type="text" name="name" size="25" class='validate[required, ajax[ajaxNameCall]]' title="<?php if(isset($thread['id'])){ echo $thread['id'];} else {echo '0';} ?>" id='designid' value="<?php if(isset($thread['name']))echo ($thread['name']); ?>"></td></tr>
<tr><td></td><td><input type="submit" <?php echo (!$edit)?"id='submit'":''?> value="Submit" class="btn btn-primary"></td></tr>
</table>
</form>
</center>
</body>
</html>
