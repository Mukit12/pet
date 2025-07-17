<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once("shared/header.php") ?>
</head>
<body>
    <!-- navbar -->
    <?php require_once("shared/navbar.php") ?>

    <br>

    <div class="container wow fadeInDown">
        <div class="row" style="display: flex; justify-content: center;">
            <form class="form-horizontal" method="POST" action="shared/requests.php" style="margin-top: 20px;">
                <?php
                    if(isset($_GET["id"])){
                        require_once("../shared/db.php");
                        $query = $conn->prepare("SELECT * FROM `vendors` WHERE `id` = " . $_GET["id"]);
                        $query->execute();
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    }
                ?>

                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label wow fadeInDown">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control wow fadeInDown" id="name" name="name" value="<?php echo isset($res) ? $res[0]["name"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label wow fadeInDown">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control wow fadeInDown" id="email" name="email" value="<?php echo isset($res) ? $res[0]["email"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="col-sm-4 control-label wow fadeInDown">Address</label>
                    <div class="col-sm-6">
                        <input type="tel" class="form-control wow fadeInDown" id="address" name="address" value="<?php echo isset($res) ? $res[0]["address"] : "" ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact" class="col-sm-4 control-label wow fadeInDown">Contact no</label>
                    <div class="col-sm-6">
                        <input minlength="11" maxlength="11" type="text" class="form-control wow fadeInDown" id="contact" name="contact" value="<?php echo isset($res) ? $res[0]["contact"] : "" ?>" required>
                    </div>
                </div>

                <?php if(isset($res)): ?>
                    <input type="hidden" name="id" value="<?php echo $res[0]["id"] ?>">
                <?php endif; ?>

                <hr>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <center><input type="submit" class="btn btn-success wow fadeInDown" name="<?php echo isset($res) ? "update_vendor" : "add_vendor" ?>"></center>
                </div>
            </form>
        </div>
    </div>

    <br><br><br>

    <!-- footer -->
    <?php require_once("shared/footer.php") ?>

    <!-- js imports -->
    <?php require_once("shared/_js.php") ?>
</body>
</html>