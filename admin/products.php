<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <br>

    <?php
        require_once("../shared/db.php");
        $sql = "SELECT accessories.id, accessories.name, accessories.image, accessories.description, accessories.type, accessories.pet_type, accessories.prize, accessories.qty, vendors.name as vend_name FROM `accessories` INNER JOIN `vendors` ON accessories.vendor_id=vendors.id ";
        if(isset($_GET["id"]))
            $sql .= "WHERE accessories.vendor_id=".$_GET["id"];

        $query = $conn->prepare($sql);
        $query->execute();
        
        if(isset($_GET["id"]) && ($query->rowCount() == 0)){
            $query2 = $conn->prepare("SELECT name FROM vendors WHERE id=? ");
            $query2->execute([$_GET["id"]]);
            $query2->setFetchMode(PDO::FETCH_ASSOC);
            $res2 = $query2->fetchAll();
        }
        
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $res = $query->fetchAll();
        $cnt = 0;
    ?>

    <div class="container-fluid" style="margin-top: 2rem;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if(!isset($_GET["id"])): ?>
                        <h1 style="color: black !important;" class="text-center">All products</h1>
                    <?php else: ?>
                        <h1 style="color: black !important;" class="text-center">Products from: "<?php echo isset($res2) ? $res2[0]["name"] : $res[0]["vend_name"] ?>"</h1>
                        <h2 style="color: black !important;" class="text-center"><?php echo sizeof($res) ?> product/s</h2>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                        <tr>
                            <th>S/l</th>
                            <th>Image</th>
                            <th>Vendor</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Pet type</th>
                            <th>Prize</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>

                        <?php foreach($res as $r): ?>
                        <tr>
                            <td>
                                <strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong>
                            </td>

                            <td>
                                <img style="width: 4rem;" src="../assets/images/products/<?php echo $r["image"] ?>">
                            </td>

                            <td><?php echo $r["vend_name"] ?></td>
                            <td><?php echo $r["name"] ?></td>
                            <td><?php echo $r["description"] ?></td>
                            <td><?php echo $r["type"] ?></td>
                            <td><?php echo $r["pet_type"] ?></td>
                            <td><?php echo $r["prize"] ?> TK</td>
                            <td><?php echo $r["qty"] ?></td>
                            <td>
                                <center>
                                    <a class="btn btn-success" href="product_form.php?id=<?php echo $r["id"] ?>">Edit</a>
                                    <a class="btn btn-danger" href="shared/requests.php?t=pr&id=<?php echo $r["id"] ?>">Delete</a>
                                </center>
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

    <br><br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>