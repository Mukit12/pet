<?php
extract($_POST);
if(isset($_POST) && isset($cart)){
	require_once("shared/db.php");
	$sql = "SELECT accessories.id, accessories.name, accessories.image, accessories.prize as price, accessories.qty, vendors.name as vend_name FROM `accessories` INNER JOIN `vendors` ON accessories.vendor_id=vendors.id WHERE accessories.id IN ($cart)";
	$query = $conn->prepare($sql);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    print_r(json_encode(["data" => $query->fetchAll()]));
}
?>