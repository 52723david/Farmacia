<?php
$id_leer= $_GET['id'];

header('Content-type: application/json');
$server = "127.0.0.1";
$username = "root";
$password = "";
$database = "farmaciadb1";
$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);
$sql = "SELECT * FROM farmacia WHERE Id=".$id_leer;
$result = mysql_query($sql) or die ("Query error: " . mysql_error());
$records = array();
while($row = mysql_fetch_assoc($result)) {
	$records[] = array_map('utf8_encode', $row);

}

mysql_close($con);
echo (json_encode($records));
?>
