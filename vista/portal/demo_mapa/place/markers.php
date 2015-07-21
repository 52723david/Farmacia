<?php
//$id_leer= $_GET['id'];

$rango = 20;
if(isset($_GET['fecha'])){
	$consulta = "SELECT f.Id, f.Nombre, f.Foto, f.Direccion, f.Descripcion, f.Horario, f.Telefono, f.Zona, f.Provincia, f.Canton, f.Sector, f.Latitud, f.Longitud, f.Usuario,t.fecha_inicio,t.fecha_fin, (6371 * ACOS(SIN(RADIANS(latitud)) * SIN(RADIANS(-3.996083))+ COS(RADIANS(longitud - -79.205675)) * COS(RADIANS(latitud)) * COS(RADIANS(-3.996083)))) AS distance FROM farmacia f, turnos t WHERE  t.Farmacia = f.Id  AND t.fecha_inicio <= '".$_GET['fecha']."'AND t.fecha_fin >= '".$_GET['fecha']."' HAVING distance < ".$rango." ORDER BY distance ASC LIMIT 5";
}else{
	$consulta = "SELECT Id, Nombre, Foto, Direccion, Descripcion, Horario, Telefono, Zona, Provincia, Canton, Sector, Latitud, Longitud, Usuario, (6371 * ACOS(SIN(RADIANS(latitud)) * SIN(RADIANS(-3.996083))+ COS(RADIANS(longitud - -79.205675)) * COS(RADIANS(latitud)) * COS(RADIANS(-3.996083)))) AS distance FROM farmacia HAVING distance < ".$rango." ORDER BY distance ASC LIMIT 5";
}

header('Content-type: application/json');
$server = "127.0.0.1";
$username = "root";
$password = "";
$database = "farmaciadb1";
$con = mysql_connect($server, $username, $password) or die ("Could not connect: " . mysql_error());
mysql_select_db($database, $con);
$sql = $consulta;
$result = mysql_query($sql) or die ("Query error: " . mysql_error());
$records = array();
while($row = mysql_fetch_assoc($result)) {
	$records[] = array_map('utf8_encode', $row);

}

mysql_close($con);
//$variable = var_dump($records);
//echo var_dump($records);
//echo ('jsoncallback') . '(' . json_encode($records) . ');';
//echo ( '[{ "Banco" : '. json_encode($records).'}]' );
echo (json_encode($records));
?>
