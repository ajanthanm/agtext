<?php
include('template/header.php');
?>
<?php
$thread = [];
$edit = false;
if(isset($_GET['id'])){
	$data = getSingleData('color', $_GET['id']);
	$edit = true;
	$thread = $data[0];
}


?>
<center>
<form  action="color.php" method="post" id="formID">

<?php 
if($edit){
	echo "<input type='hidden' name='id' value='{$thread['id']}'>";
}
?>
<h3>Color details</h3>
<table>
<tr><td>Color</td>
<td><input type="text" class='validate[required,ajax[ajaxNameCall]]' id='colorid' title="<?php if(isset($thread['id'])){ echo $thread['id'];} else {echo '0';} ?>" name="color" value="<?php echo editData($thread, 'name'); ?>"></td>
</tr>
<tr><td></td><td><input type="submit" value="Add" <?php echo (!$edit)?"id='submit'":''?> class="btn btn-primary"></td></tr>
</table>


</form>
</center>
</body>
</html>
