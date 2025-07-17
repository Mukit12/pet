<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container-fluid" style="margin-top: 2rem; height: auto;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="my-5 text-center" style="color: rosybrown;">All orders</h1>

                    <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                        <?php
                            require_once("../shared/db.php");
                            $query = $conn->prepare("SELECT accessories.image, accessories.name as prod_name, vendors.name as vend_name, transactions.qty as purchase_qty, transactions.trans_id, transactions.trans_amount, transactions.trans_date, transactions.card_type, transactions.card_no, transactions.username, transactions.pay_type, transactions.address FROM `accessories` INNER JOIN `transactions` ON accessories.id=transactions.prod_id INNER JOIN `vendors` ON accessories.vendor_id=vendors.id; ");
                            $query->execute();
                            $query->setFetchMode(PDO::FETCH_ASSOC);
                            $res = $query->fetchAll();
                            $cnt = 0;
                        ?>

                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Image</th>
                            <th>Product name</th>
                            <th>Vendor</th>
                            <th>Quantity</th>
                            <th>Total amount</th>
                            <th>Address</th>
                            <th>Payment type</th>
                            <th>Purchase method</th>
                            <th>Transaction ID</th>
                            <th>Purchase time</th>
                        </tr>

                        <?php foreach($res as $r): ?>
                        <tr>
                            <td>
                                <strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong>
                            </td>

                            <td><?php echo $r["username"] ?></td>

                            <td>
                                <img style="width: 80px;" src="../assets/images/products/<?php echo $r["image"] ?>">
                            </td>

                            <td><?php echo $r["prod_name"] ?></td>
                            <td><?php echo $r["vend_name"] ?></td>
                            <td><?php echo $r["purchase_qty"] ?></td>
                            <td><?php echo $r["trans_amount"] ?>/=</td>
                            <td><?php echo $r["address"] ?></td>
                            <td><?php echo $r["pay_type"]==1 ? "Cash On Delivery" : "Online" ?></td>
                            <td><?php echo $r["card_type"] ?></td>
                            <td><?php echo $r["trans_id"] ?></td>
                            <td><?php echo $r["trans_date"] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>

                    <style type="text/css">
                        table, tr, th, td{ border: 1px dashed #8c8b8b; }
                    </style>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>