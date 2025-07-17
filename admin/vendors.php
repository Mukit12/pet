<!DOCTYPE html>
<html>
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
   <!-- navbar -->
   <?php require_once("shared/navbar.php") ?>

    <div class="container" style="margin-top: 2rem;">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive table-hover" style="border: 1px dashed #8c8b8b; border-top: 1px dashed #8c8b8b;">
                    <?php
                        require_once("../shared/db.php");
                        $query = $conn->prepare("SELECT * FROM `vendors`; ");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                        $cnt = 0;
                    ?>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td  style="border: 1px dashed #8c8b8b;">
                            <center><strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong></center>
                        </td>

                        <td style="border: 1px dashed #8c8b8b;"> 
                            <dl class="dl-horizontal wow fadeInDown" style="text-align:left">
                                <dt>Name:</dt> &nbsp;<?php echo $r["name"] ?><dd></dd>
                                <dt>Address:</dt> &nbsp;<?php echo $r["address"] ?><dd></dd>
                                <dt>Email:</dt> &nbsp;<?php echo $r["email"] ?><dd></dd>
                                <dt>Contact no:</dt> &nbsp;<?php echo $r["contact"] ?><dd></dd>
                            </dl>
                        </td>

                        <td>
                            <center>
                                <a href="products.php?id=<?php echo $r["id"] ?>" class="btn btn-info">See imported products</a>
                                <a href="vendor_form.php?id=<?php echo $r["id"] ?>" class="btn btn-success">Edit</a>
                                <a href="shared/requests.php?t=vendr&id=<?php echo $r["id"] ?>" class="btn btn-danger">Delete</a>
                            </center>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("../shared/_js.php") ?>
</body>
</html>