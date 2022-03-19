<?php
$user= 'root';
$pwd= '';
$db='tcc';
$host = 'localhost';

//define("MYSQL_CONN_ERROR", "Unable to connect to database.");
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($host, $user, $pwd, $db);
    mysqli_query($conn,"SET NAMES 'utf8'");
} catch (Exception $e) {
	echo "Não foi possível conectar a base: ".$e;
	die();
}

?>



