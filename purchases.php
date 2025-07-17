<div class="container-fluid" style="margin-top: 2rem; height: auto;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5 text-center" style="color: rosybrown;">Purchases</h1>

                <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                    <?php
                        require_once("shared/db.php");
                        $query = $conn->prepare("SELECT accessories.image, accessories.name as prod_name, vendors.name as vend_name, transactions.id as transac_id, transactions.qty as purchase_qty, transactions.trans_id, transactions.trans_amount, transactions.trans_date, transactions.card_type, transactions.card_no, transactions.pay_type, transactions.address, transactions.prod_id FROM `accessories` INNER JOIN `transactions` ON accessories.id=transactions.prod_id INNER JOIN `vendors` ON accessories.vendor_id=vendors.id WHERE transactions.username=?; ");
                        $query->execute([$_SESSION["user"]]);
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    ?>

                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product ID</th>
                        <th>Product name</th>
                        <th>Vendor</th>
                        <th>Quantity</th>
                        <th>Total amount</th>
                        <th>Address</th>
                        <th>Payment type</th>
                        <th>Purchase method</th>
                        <th>Transaction ID</th>
                        <th>Purchase time</th>
                        <th>Invoice</th>
                    </tr>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td>
                            <strong class="wow fadeInDown"><p style="margin-top:25px;"><?php echo $r["transac_id"] ?></p></strong>
                        </td>

                        <td>
                            <img style="width: 80px;" src="assets/images/products/<?php echo $r["image"] ?>">
                        </td>

                        <th><?php echo $r["prod_id"] ?></th>
                        <td><?php echo $r["prod_name"] ?></td>
                        <td><?php echo $r["vend_name"] ?></td>
                        <td><?php echo $r["purchase_qty"] ?></td>
                        <td><?php echo $r["trans_amount"] ?>/=</td>
                        <td><?php echo $r["address"] ?></td>
                        <td><?php echo $r["pay_type"]==1 ? "Cash On Delivery" : "Online" ?></td>
                        <td><?php echo $r["card_type"] ?></td>
                        <td><?php echo $r["trans_id"] ?></td>
                        <td><?php echo $r["trans_date"] ?></td>
                        <td>
                            <a href="invoice.php?type=Purchase&id=<?php echo $r["transac_id"] ?>">Click here</a>
                        </td>
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