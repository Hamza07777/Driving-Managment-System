<!-- <?php 
define("DB_SERVER", "localhost");
define("DB_USERNAME", "jhamtcom_jhamtcom_license_dms");
define("DB_PASSWORD", ";1$@B4BfGVNO");
define("DB_NAME", "jhamtcom_soft_dms_license");
$mysqli=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($mysqli===false){
    die("ERROR: cannot connect".$mysqli->connect_error);
}
?> -->
<?php
    $id = $_GET['id'];
    echo $id;
?>
<?php
echo('hello');
    $verify;
	$host=request()->getHttpHost();
	$license=$request->license;
	$qry    =   "SELECT * FROM licenses WHERE key_value='$license' AND doamin='$host'";
	$result=$mysqli->query($qry);
	 $rowcount=mysqli_num_rows($result);
	if($rowcount==1){
	   
	}
	else{
	    return $verify=false;
	}

?>