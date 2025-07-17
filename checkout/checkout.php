<?php
include_once("../shared/auth_validity.php");
include_once("../shared/db.php");
if(!isset($_SESSION)) session_start();

$query = $conn->prepare("SELECT * FROM `users` WHERE `username`=?; ");
$query->execute([$_SESSION["user"]]);
$query->setFetchMode(PDO::FETCH_ASSOC);
$user = $query->fetchAll();


extract($_POST);
$post_data = array();

// <=================products1.0.php================================>
// $query = $conn->prepare("SELECT * FROM `accessories` WHERE `id`=?; ");
// $query->execute([$_POST['id']]);
// $query->setFetchMode(PDO::FETCH_ASSOC);
// $prod = $query->fetchAll();
// $post_data['total_amount'] = ($prod[0]["prize"] * intval($_POST["qty"]));
// <=================products1.0.php================================>
if($pay_type == "cod"){
    $ids = explode(',', $ids);
    forEach($ids as $id){
        $query = $conn->prepare("INSERT INTO `transactions`(`username`, `prod_id`, `qty`, `trans_amount`, `address`, `pay_type`) VALUES(?, ?, ?, (? * (SELECT `prize` FROM `accessories` WHERE `id`=?)), ?, 1); ");
        $query->execute([$user[0]['username'], $id, $_POST[$id."_qty"], $_POST[$id."_qty"], $id, $address]);

        $query = $conn->prepare("UPDATE `accessories` SET `qty`=`qty`-? WHERE `id`=?; ");
        $query->execute([$_POST[$id."_qty"], $id]);
    }

    ?>
        <script type="text/javascript">
            localStorage.clear();
            window.location.assign("../orders.php");
        </script>
    <?php
}
else{
    $query = $conn->prepare("SELECT `prize` as 'price', `id` FROM `accessories` WHERE `id` IN ($ids); ");
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $res = $query->fetchAll();
    $post_data['total_amount'] = 0;
    foreach ($res as $data) {
        $post_data['total_amount'] += ($_POST[$data["id"]."_qty"] * $data["price"]);
    }

    $post_data['store_id'] = "rooki64087f61151b1";
    $post_data['store_passwd'] = "rooki64087f61151b1@ssl";
    $post_data['currency'] = "BDT";
    $post_data['tran_id'] = "SSLCZ_TEST_" . uniqid();
    $post_data['success_url'] = "http://localhost/caty/checkout/success.php";
    $post_data['fail_url'] = "http://localhost/caty/checkout/fail.php";
    $post_data['cancel_url'] = "http://localhost/caty/checkout/cancel.php";
    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

    # EMI INFO
    $post_data['emi_option'] = "1";
    $post_data['emi_max_inst_option'] = "9";
    $post_data['emi_selected_inst'] = "9";

    # CUSTOMER INFORMATION
    $post_data['cus_name'] = $user[0]['name'];
    $post_data['cus_email'] = $user[0]['username'];
    $post_data['cus_add1'] = $address;
    $post_data['cus_add2'] = "";
    $post_data['cus_city'] = "";
    $post_data['cus_state'] = "";
    $post_data['cus_postcode'] = "";
    $post_data['cus_country'] = "Bangladesh";
    $post_data['cus_phone'] = $user[0]["contact"];
    $post_data['cus_fax'] = $user[0]["contact"];

    # SHIPMENT INFORMATION
    $post_data['ship_name'] = "Online Pet care center Management System";
    $post_data['ship_add1 '] = "Dhaka";
    $post_data['ship_add2'] = "Dhaka";
    $post_data['ship_city'] = "Dhaka";
    $post_data['ship_state'] = "Dhaka";
    $post_data['ship_postcode'] = "1401";
    $post_data['ship_country'] = "Bangladesh";

    # OPTIONAL PARAMETERS
    $post_data['value_a'] = $user[0]['username'];
    $post_data['value_b'] = $ids;
    $post_data['value_c'] = "";
    $ids = explode(',', $ids);
    foreach($ids as $id){
        if($post_data['value_c'] == "")
            $post_data['value_c'] = $_POST[$id."_qty"];
        else
            $post_data['value_c'] .= ",".$_POST[$id."_qty"];
    }
    $post_data['value_d'] = $address;


    $post_data['product_amount'] = $post_data['total_amount'];
    $post_data['vat'] = "0";
    $post_data['discount_amount'] = "0";
    $post_data['convenience_fee'] = "0";

    # REQUEST SEND TO SSLCOMMERZ
    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


    $content = curl_exec($handle);

    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {
        curl_close($handle);
        $sslcommerzResponse = $content;
    } else {
        curl_close($handle);
        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
        exit;
    }

    # PARSE THE JSON RESPONSE
    $sslcz = json_decode($sslcommerzResponse, true);

    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
        echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
        # header("Location: ". $sslcz['GatewayPageURL']);
        exit;
    } else {
        echo "JSON Data parsing error!";
    }
}