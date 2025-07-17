<?php
define("DB_host", "localhost");
define("DB_name", "pet");
define("DB_usr", "root");
define("DB_pass", "");

$conn_str = "mysql:host=" . DB_host . ";dbname=" . DB_name;
try {
	$conn = new PDO($conn_str, DB_usr, DB_pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Error: {$e->getMessage()}\n";
	exit();
}
?>