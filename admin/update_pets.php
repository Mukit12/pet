<!DOCTYPE html>
<html lang="en">
<head>
    <?php $auth_check=true; require_once("shared/header.php") ?>
</head>
<body>

    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive table-hover" style="margin-top: 2rem;">
                    <?php
                        require_once("../shared/db.php");
                        $query = $conn->prepare("SELECT * FROM `pets`; ");
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                        $cnt = 0;
                    ?>

                    <tr>
                        <th>#</th>
                        <th>Pet image</th>
                        <th>Pet name</th>
                        <th>Pet age</th>
                        <th>Adopted</th>
                        <th>Actions</th>
                    </tr>

                    <?php foreach($res as $r): ?>
                    <tr>
                        <td>
                            <strong class="wow fadeInDown"><p style="margin-top:25px;">No. <?php echo ++$cnt ?></p></strong>
                        </td>

                        <td>
                            <img style="width: 100px;" src="../uploads/products/animals/<?php echo $r["pic"] ?>" />
                        </td>

                        <td>
                            <?php echo $r["name"] ?>
                        </td>

                        <td>
                            <?php
                                $age = explode('.', (string)$r["age"]);
                                echo intval($age[0])." years ";
                                if(isset($age[1]) and intval($age[1]) != 0) echo intval($age[1])." months";
                            ?>
                        </td>

                        <td>
                            <?php echo $r["status"]==0 ? "Yes" : "No" ?>
                        </td>

                        <td>
                            <center>
                                <a class="btn btn-success" href="./pet_form.php?id=<?php echo $r["id"] ?>">Edit</a>

                                <a class="btn btn-danger" href="shared/requests.php?t=pet&id=<?php echo $r["id"] ?>">Delete</a>
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

    <br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>