<?php 
include('template/header.php');
?>
<div align="right"><a href="addcolor.php"><input type="button" value="Addcolor" class="btn btn-primary"></a></div>


<?php

if($_POST) {
	//echo 'ere';exit;
	$data["name"]=$_POST["color"];
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("color", $data, $updateData);
		
	} else {
		$data["date"]=time();
		insertData("color", $data);
		
	}
	
}	

$select=mysql_query("SELECT * FROM `color`");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>

<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>color</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$sno = 1;
while($fetch = mysql_fetch_assoc($select)) {
echo "<tr><td>{$sno}</td><td>".$fetch["name"]."</td><td>"."<a href='addcolor.php?id=".$fetch["id"]."'>edit</a></td></tr>";
$sno++;
}
?>
</tbody>
</table>



</body>
</html>
