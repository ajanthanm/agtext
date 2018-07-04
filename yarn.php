<?php 
include('template/header.php');
?>
<center><h3>Yarn details</h3></center>
<div align="right"><a href="addyarn.php"><input type="button" value="Add Yarn" class="btn btn-primary"></a></div>



<?php

if($_POST) {
	$data["name"]=$_POST["name"];
	//$emailid=$_POST["emailid"];
	//$data["mobileno"]=$_POST["mobileno"];
	$data["address"]=$_POST["address"];
	if(isset($_POST["id"])) {
		$updateData["id"] = $_POST["id"];
		updateData("yarns",$data,$updateData);
	}
	else {
		$data["date"]=time();
		
		insertData("yarns",$data);
	}
	/**
else {
	$sql="insert into users (name,mobileno,address)values('$name','$mobileno','$address')";
	$i=mysql_query($sql);

}
*/}
$select=mysql_query("SELECT * FROM `yarns`");
if (mysql_num_rows($select) > 0) {
    // output data of each row
    
  }
//$fetch=mysql_fetch_array($select);
?>
<table id="example" border="0">
<thead>
<tr>
<th>S.No</th>
<th>name</th>
<th>address</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
//print_r($fetch);
$i=1;
while($fetch = mysql_fetch_assoc($select)) {
echo "<tr><td>{$i}</td><td>".$fetch["name"]."</td><td>".$fetch["address"]."</td><td>"."<a href='addyarn.php?id=".$fetch["id"]."'>edit</a></td></tr>";
$i++;
}
?>
</tbody>
</table>
</body>
</html>