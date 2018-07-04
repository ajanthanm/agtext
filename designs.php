<?php 
include('template/header.php');
?>
<div align="right"><a href="add_design.php"><input type="submit" value="Add design" class="btn btn-primary"></a></div>

<?php

if($_POST) {
	$data['name']=$_POST["name"];
	//$data['date']=time();
	
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("designs", $data, $updateData);
		
	} else {
		$data["date"]=time();
		insertData("designs", $data);
	}

}	

$select=mysql_query("SELECT * FROM `designs`");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>Design Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$sno = 1;
while($fetch = mysql_fetch_assoc($select)) {
echo "<tr><td>{$sno}</td><td>".$fetch["name"]."</td><td>"."<a href='add_design.php?id=".$fetch["id"]."'>edit</a></td></tr>";
$sno++;
}
?>
</tbody>
</table>




</body>
</html>
