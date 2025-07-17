<?php require_once("../shared/db.php"); ?>

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
            <div class="col-md-6" style="border: solid #CFCFCF 2px; border-radius: 10px;">
                <form class="form-horizontal" method="POST" action="shared/requests.php" style="margin-top: 20px;" enctype="multipart/form-data">
                    <?php
                    if(isset($_GET["id"])){
                        $query = $conn->prepare("SELECT * FROM `accessories` WHERE `id`=?; ");
                        $query->execute([$_GET["id"]]);
                        $query->setFetchMode(PDO::FETCH_ASSOC);
                        $res = $query->fetchAll();
                    }
                    ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label wow fadeInDown">Product image</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control wow fadeInDown" name="img" <?php echo isset($res) ? "" : "required" ?> />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="vendorId" class="col-sm-4 control-label wow fadeInDown">Vendor</label>
                        <div class="col-sm-6">
                            <select class="form-control wow fadeInDown" id="vendorId" name="vendor_id" value="<?php echo isset($res) ? $res[0]["vendor_id"] : "" ?>" required>
                                <option <?php echo isset($res) ? "" : "selected" ?> disabled>Select one</option>
                                
                                <?php
                                $query = $conn->prepare("SELECT name, id FROM `vendors`; ");
                                $query->execute();
                                $query->setFetchMode(PDO::FETCH_ASSOC);
                                $res2 = $query->fetchAll();
                                ?>

                                <?php foreach ($res2 as $r): ?>
                                    <option
                                        <?php echo (isset($res) && ($res[0]["vendor_id"]==$r["id"])) ? "selected" : "" ?>
                                        value="<?php echo $r["id"] ?>"
                                    >
                                        <?php echo $r["name"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label wow fadeInDown">Product Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="name" name="name" placeholder="product name" value="<?php echo isset($res) ? $res[0]["name"] : "" ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="des" class="col-sm-4 control-label wow fadeInDown">Product description</label>
                        <div class="col-sm-6">
                            <textarea style="max-width: 100%;" class="form-control wow fadeInDown" id="des" name="description" required placeholder="Detail about the product"><?php echo isset($res) ? $res[0]["description"] : "" ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-4 control-label wow fadeInDown">Product type</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="type" name="type" placeholder="food/toy/wearing/...." value="<?php echo isset($res) ? $res[0]["type"] : "" ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pet_type" class="col-sm-4 control-label wow fadeInDown">Pet type</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control wow fadeInDown" id="pet_type" name="pet_type" value="<?php echo isset($res) ? $res[0]["pet_type"] : "" ?>" placeholder="dog/cat/fish/bird/..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="prize" class="col-sm-4 control-label wow fadeInDown">Product price</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control wow fadeInDown" id="prize" name="prize" value="<?php echo isset($res) ? $res[0]["prize"] : "" ?>" min="0"  placeholder="price per piece" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="qty" class="col-sm-4 control-label wow fadeInDown">Product quantity</label>
                        <div class="col-sm-6">
                            <input type="number" min="0" class="form-control wow fadeInDown" id="qty" name="qty" value="<?php echo isset($res) ? $res[0]["qty"] : "" ?>" placeholder="available products number" required>
                        </div>
                    </div>

                    <?php if(isset($res)): ?>
                        <input type="hidden" name="id" value="<?php echo $res[0]["id"] ?>">
                    <?php endif; ?>

                    <hr>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <center><input type="submit" class="btn btn-success wow fadeInDown" name="<?php echo isset($res) ? "update_product" : "add_product" ?>" value="<?php echo isset($res) ? "Update" : "Add" ?>"></center>
                    </div>
                </form>
                    
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