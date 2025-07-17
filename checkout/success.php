<?php
include_once("../shared/db.php");
if(!isset($_SESSION)) session_start();

$val_id = urlencode($_POST['val_id']);
$store_id = urlencode("rooki64087f61151b1");
$store_passwd = urlencode("rooki64087f61151b1@ssl");
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);

$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if ($code == 200 && !(curl_errno($handle))) {
    $result = json_decode($result);
    $ids = explode(',', $result->value_b);
    $qtys = explode(',', $result->value_c);
    forEach($ids as $index => $id){
        $query = $conn->prepare("INSERT INTO `transactions`(`username`, `prod_id`, `qty`, `trans_id`, `trans_amount`, `card_no`, `val_id`, `card_type`, `address`, `pay_type`) VALUES(?, ?, ?, ?, (? * (SELECT `prize` FROM `accessories` WHERE `id`=?)), ?, ?, ?, ?, 2); ");
        $query->execute([$result->value_a, $id, $qtys[$index], $result->tran_id, $qtys[$index], $id, $result->card_no, $result->val_id, $result->card_type, $result->value_d]);

        $query = $conn->prepare("UPDATE `accessories` SET `qty`=`qty`-? WHERE `id`=?; ");
        $query->execute([$qtys[$index], $id]);
    }
} else {
    echo "Failed to connect with SSLCOMMERZ";
}
?>
<html>
<title>Successful Purchase</title>

<body>
    <h1>Your purchase is completed.</h1>
    <p>Redirecting to dashboard in <span class="counter"></span></p>

    <script>
        localStorage.clear();
        let countDown = 5;
        setInterval(() => {
            countDown--;
            document.querySelector(".counter").innerHTML = countDown;
        }, 1000)
        setTimeout(() => {
            window.location.assign("../index.php");
        }, 5000);
    </script>
</body>

</html>