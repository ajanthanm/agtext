<?php 
mysql_connect("localhost","root","");
mysql_select_db("agtext_0819");
/* RECEIVE VALUE */
$validateValue=$_REQUEST['fieldValue'];
$validateId=$_REQUEST['fieldId'];
$validateValueId=$_REQUEST['fieldValueId'];


$validateError= "This username is already taken";
$validateSuccess= "This username is available";



	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;

if($validateId =="userid"){
	$value = getSingleDataByName("users",$validateValue, "name",$validateValueId);
	
	if(empty($value)){	
		$arrayToJs[1] = true;
	}else{
		$arrayToJs[1] = false;
	}	
	echo json_encode($arrayToJs);			
}else if($validateId =="designid"){
	$value = getSingleDataByName("designs",$validateValue, "name",$validateValueId);
	if(empty($value)){	
		$arrayToJs[1] = true;
	}else{
		$arrayToJs[1] = false;
	}	
	echo json_encode($arrayToJs);
}else if($validateId =="colorid"){
	$value = getSingleDataByName("color",$validateValue, "name",$validateValueId);
	if(empty($value)){	
		$arrayToJs[1] = true;
	}else{
		$arrayToJs[1] = false;
	}	
	echo json_encode($arrayToJs);	
}else if($validateId =="yarnid"){
	$value = getSingleDataByName("yarns",$validateValue, "name",$validateValueId);
	if(empty($value)){	
		$arrayToJs[1] = true;
	}else{
		$arrayToJs[1] = false;
	}	
	echo json_encode($arrayToJs);		
}
else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}
function getSingleDataByName($tablename, $val, $name, $validateValueId){
	$sql = "select * from {$tablename} where {$name} = '{$val}' and id != '{$validateValueId}'";
	$select=mysql_query($sql);
	$i=0;
	$data = [];
	while($fetch = mysql_fetch_assoc($select)) {
		
		$data[$i] = $fetch;
		$i++;
	}
	return $data;
}
?>
